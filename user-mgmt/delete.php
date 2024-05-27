<?php
// Include your database connection script here

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Example:
$host = 'localhost';
$db = 'asan wms';
$user = 'root';
$pass = '';

// Establish database connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if form is submitted for deletion
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute query to set is_deleted to 1
    if ($stmt = $mysqli->prepare("UPDATE users SET is_deleted = 1 WHERE id = ?")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect back to the main page after deletion
    header("Location: user-mgmt.php");
    exit();
}

// Close the database connection
$mysqli->close();
?>
