<?php
// add_record.php

// Include the UUID library
require_once 'C:\xampp\htdocs\ASAN\vendor\autoload.php';

// Import the UUID class
use Ramsey\Uuid\Uuid;


// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asan wms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $picture = $_POST['picture'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $uuid = Uuid::uuid1()->toString();

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (id, profile_image, fullname, email, user_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $uuid, $picture, $name, $email, $role);

    if ($stmt->execute()) {
        // Record added successfully, redirect to a page (e.g., index.php)
        header("Location: user-mgmt.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

