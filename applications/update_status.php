<?php
// Database connection and other configurations

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';
$db = 'asan_wms';
$user = 'root';
$pass = '';

// Establish database connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Function to log audit actions
function log_audit_action($mysqli, $admin_username, $action_type, $target_user_id, $description) {
    $query = "INSERT INTO audit_logs (username, action_type, target_user_id, description) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssss", $admin_username, $action_type, $target_user_id, $description);
    $stmt->execute();
    $stmt->close();
}

// Get the ID and status from the POST request
$id = $_POST['id'];
$status = $_POST['status'];

// Update the verification status
$query = "UPDATE users SET verification_status = ? WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $status, $id);
$stmt->execute();
$stmt->close();

// Get the admin username from the session (assuming it's set in session)
session_start();
if (isset($_SESSION['username'])) {
    $admin_username = $_SESSION['username'];
} else {
    // If admin username is not available, use "Unknown"
    $admin_username = "Unknown";
}

// Log audit action based on verification status
if ($status == 2) {
    // Approved
    $action_type = 'APPROVE_VERIFICATION';
    $description = "Approved verification for user with ID $id";
} elseif ($status == 0) {
    // Declined
    $action_type = 'DECLINE_VERIFICATION';
    $description = "Declined verification for user with ID $id";
}

// Log the audit action
log_audit_action($mysqli, $admin_username, $action_type, $id, $description);

// Redirect back to the previous page or another page
header("Location: applications.php"); // Replace 'applications.php' with the actual page you want to redirect to

// Close connection
$mysqli->close();
?>
