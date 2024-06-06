<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login-authentication.html');
    exit;
}

// Get the username of the currently logged in admin
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // If username is not set, redirect to login page
    header('Location: login-authentication.html');
    exit;
}
