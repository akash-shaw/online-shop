<?php
// Root routing: redirect based on session/remember-me status
include 'config.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

// If admin logged in, go to admin dashboard
if (!empty($_SESSION['admin_id'])) {
   header('Location: admin_page.php');
   exit;
}

// If user logged in, go to home
if (!empty($_SESSION['user_id'])) {
   header('Location: home.php');
   exit;
}

// Otherwise, show login page
header('Location: login.php');
exit;
?>