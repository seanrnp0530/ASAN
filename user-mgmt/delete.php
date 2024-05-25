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
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

// Check if form is submitted for deletion
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute query to set is_deleted to 1
    $stmt = $pdo->prepare("UPDATE users SET is_deleted = 1 WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect back to the main page after deletion
    header("Location: user-mgmt.php");
    exit();
}
?>