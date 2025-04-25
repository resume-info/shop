<?php
// Bootstrap application
require_once __DIR__ . '/../config/autoload.php';

// Start session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Logout user
$user = new App\User();
$user->logout();

// Redirect to login page
header('Location: login.php');
exit; 