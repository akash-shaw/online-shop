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

?>