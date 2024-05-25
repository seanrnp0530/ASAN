<?php
// Database connection and other configurations

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';
$db = 'asan wms';
$user = 'root';
$pass = '';

// Establish database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID and status from the POST request
$id = $_POST['id'];
$status = $_POST['status'];

// Update the verification status
$query = "UPDATE users SET verification_status = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $status, $id);
$stmt->execute();

// Redirect back to the previous page or another page
header("Location: applications.php"); // Replace 'previous_page.php' with the actual page you want to redirect to

// Close connection
$conn->close();

