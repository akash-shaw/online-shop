<?php
// Central app configuration
// Prefer environment variables with sensible defaults for local/dev.

$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
// Default to the new merch store DB name
$DB_NAME = getenv('DB_NAME') ?: 'merch_store';

// Store branding
$STORE_NAME = getenv('STORE_NAME') ?: 'MerchHub';
$CURRENCY_PREFIX = getenv('CURRENCY_PREFIX') ?: 'Rs';

$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) or die('connection failed');

// ------------------------
// Session & Remember-Me
// ------------------------

// Ensure session started with safer cookie params
if (session_status() === PHP_SESSION_NONE) {
	$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
	// Set cookie params (session cookie by default)
	if (PHP_VERSION_ID >= 70300) {
		session_set_cookie_params([
			'lifetime' => 0, // session cookie
			'path' => '/',
			'domain' => '',
			'secure' => $secure,
			'httponly' => true,
			'samesite' => 'Lax'
		]);
	} else {
		// Best effort for older PHP
		session_set_cookie_params(0, '/');
		ini_set('session.cookie_httponly', '1');
		if ($secure) ini_set('session.cookie_secure', '1');
	}
	session_start();
}

// Create auth_tokens table if not exists (id, user_id, selector, hashed_validator, expires_at)
function ensure_auth_tokens_table($conn) {
	static $done = false;
	if ($done) return;
	$sql = "CREATE TABLE IF NOT EXISTS `auth_tokens` (
		`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
		`user_id` INT NOT NULL,
		`selector` VARCHAR(255) NOT NULL,
		`hashed_validator` CHAR(64) NOT NULL,
		`expires_at` DATETIME NOT NULL,
		PRIMARY KEY (`id`),
		UNIQUE KEY `selector_unique` (`selector`),
		KEY `user_lookup` (`user_id`),
		KEY `expires_idx` (`expires_at`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
	@mysqli_query($conn, $sql);
	$done = true;
}

function random_bytes_hex($length) {
	return bin2hex(random_bytes($length));
}

function set_remember_me($conn, $user_id, $days = 30) {
	ensure_auth_tokens_table($conn);
	$selector = random_bytes_hex(9);   // 18 hex chars
	$validator = random_bytes_hex(32); // 64 hex chars
	$hashed_validator = hash('sha256', $validator);
	$expires = date('Y-m-d H:i:s', time() + ($days * 24 * 60 * 60));

	$selector_esc = mysqli_real_escape_string($conn, $selector);
	$hashed_esc = mysqli_real_escape_string($conn, $hashed_validator);
	$user_id_int = (int)$user_id;
	$expires_esc = mysqli_real_escape_string($conn, $expires);

	mysqli_query($conn, "INSERT INTO `auth_tokens` (user_id, selector, hashed_validator, expires_at) VALUES ($user_id_int, '$selector_esc', '$hashed_esc', '$expires_esc')");

	$cookie_value = base64_encode($selector) . ':' . base64_encode($validator);
	$cookie_params = [
		'expires' => time() + ($days * 24 * 60 * 60),
		'path' => '/',
		'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
		'httponly' => true,
		'samesite' => 'Lax'
	];
	setcookie('remember_me', $cookie_value, $cookie_params);
}

function clear_remember_me($conn) {
	// Ensure table exists to avoid errors in strict mysqli modes
	ensure_auth_tokens_table($conn);
	if (!empty($_COOKIE['remember_me'])) {
		$parts = explode(':', $_COOKIE['remember_me'], 2);
		if (count($parts) === 2) {
			$selector = base64_decode($parts[0], true);
			if ($selector !== false) {
				$selector_esc = mysqli_real_escape_string($conn, $selector);
				@mysqli_query($conn, "DELETE FROM `auth_tokens` WHERE selector = '$selector_esc'");
			}
		}
	}
	// Clear cookie in browser
	$cookie_params = [
		'expires' => time() - 3600,
		'path' => '/',
		'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
		'httponly' => true,
		'samesite' => 'Lax'
	];
	setcookie('remember_me', '', $cookie_params);
}

function autologin_from_cookie($conn) {
	if ((isset($_SESSION['user_id']) && $_SESSION['user_id']) || (isset($_SESSION['admin_id']) && $_SESSION['admin_id'])) {
		return; // already logged in
	}
	if (empty($_COOKIE['remember_me'])) return;

	ensure_auth_tokens_table($conn);
	$parts = explode(':', $_COOKIE['remember_me'], 2);
	if (count($parts) !== 2) return;
	$selector = base64_decode($parts[0], true);
	$validator = base64_decode($parts[1], true);
	if ($selector === false || $validator === false) return;

	$selector_esc = mysqli_real_escape_string($conn, $selector);
	$now = date('Y-m-d H:i:s');
	$res = mysqli_query($conn, "SELECT user_id, hashed_validator, expires_at FROM `auth_tokens` WHERE selector = '$selector_esc' LIMIT 1");
	if (!$res || mysqli_num_rows($res) === 0) return;
	$row = mysqli_fetch_assoc($res);
	if ($row['expires_at'] < $now) {
		// expired
		@mysqli_query($conn, "DELETE FROM `auth_tokens` WHERE selector = '$selector_esc'");
		return;
	}

	$calc = hash('sha256', $validator);
	if (!hash_equals($row['hashed_validator'], $calc)) {
		// invalid
		@mysqli_query($conn, "DELETE FROM `auth_tokens` WHERE selector = '$selector_esc'");
		return;
	}

	// Valid token — hydrate session from users table
	$uid = (int)$row['user_id'];
	$user_res = mysqli_query($conn, "SELECT id, name, email, user_type FROM `users` WHERE id = $uid LIMIT 1");
	if ($user_res && mysqli_num_rows($user_res) > 0) {
		$u = mysqli_fetch_assoc($user_res);
		if ($u['user_type'] === 'admin') {
			$_SESSION['admin_name'] = $u['name'];
			$_SESSION['admin_email'] = $u['email'];
			$_SESSION['admin_id'] = $u['id'];
		} else {
			$_SESSION['user_name'] = $u['name'];
			$_SESSION['user_email'] = $u['email'];
			$_SESSION['user_id'] = $u['id'];
		}

		// Rotate validator to prevent replay
		$new_validator = random_bytes_hex(32);
		$new_hashed = hash('sha256', $new_validator);
		$new_hashed_esc = mysqli_real_escape_string($conn, $new_hashed);
		@mysqli_query($conn, "UPDATE `auth_tokens` SET hashed_validator = '$new_hashed_esc' WHERE selector = '$selector_esc'");
		$cookie_value = base64_encode($selector) . ':' . base64_encode($new_validator);
		$cookie_params = [
			'expires' => time() + (30 * 24 * 60 * 60),
			'path' => '/',
			'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
			'httponly' => true,
			'samesite' => 'Lax'
		];
		setcookie('remember_me', $cookie_value, $cookie_params);
	}
}

// Attempt autologin on every request early
autologin_from_cookie($conn);

?>