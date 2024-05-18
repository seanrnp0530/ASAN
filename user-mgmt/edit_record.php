<?php
// edit_record.php

// Database connection and other configurations
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$db = 'asan wms';
$user = 'root';
$pass = '';

// Establish database connection
$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $mysqli->real_escape_string($_POST['id']);
    $picture = $mysqli->real_escape_string($_POST['picture']);
    $name = $mysqli->real_escape_string($_POST['name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $role = $mysqli->real_escape_string($_POST['role']);

    // Update the record
    $stmt = $mysqli->prepare("UPDATE users SET profile_image = ?, fullname = ?, email = ?, user_type = ? WHERE id = ?");
    $stmt->bind_param('ssssi', $picture, $name, $email, $role, $id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the main page
    header("Location: user-mgmt.php");
    exit();
}

$mysqli->close();

