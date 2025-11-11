<?php

include 'config.php';

// Clear persistent login tokens and cookie if present
clear_remember_me($conn);

// Also optionally remove all tokens for this user for safety
ensure_auth_tokens_table($conn);
if(isset($_SESSION['user_id'])){
	$uid = (int)$_SESSION['user_id'];
	@mysqli_query($conn, "DELETE FROM `auth_tokens` WHERE user_id = $uid");
}
if(isset($_SESSION['admin_id'])){
	$aid = (int)$_SESSION['admin_id'];
	@mysqli_query($conn, "DELETE FROM `auth_tokens` WHERE user_id = $aid");
}

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
session_unset();
session_destroy();

header('location:login.php');

?>