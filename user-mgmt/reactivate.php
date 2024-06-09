<?php
// Include your database connection script here

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Example:
$host = 'localhost';
$db = 'asan_wms';
$user = 'root';
$pass = '';

// Establish database connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Function to log audit actions
function log_action($mysqli, $admin_username, $action_type, $target_user_id, $description) {
    if ($stmt = $mysqli->prepare("INSERT INTO audit_logs (username, action_type, target_user_id, description) VALUES (?, ?, ?, ?)")) {
        $stmt->bind_param("ssss", $admin_username, $action_type, $target_user_id, $description);
        $stmt->execute();
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
}

// Check if form is submitted for reactivation
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute query to set is_deleted to 0
    if ($stmt = $mysqli->prepare("UPDATE users SET is_deleted = 0 WHERE id = ?")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Get the username of the admin from session
        session_start();
        if (isset($_SESSION['username'])) {
            $admin_username = $_SESSION['username'];
        } else {
            // Handle case when admin username is not available
            $admin_username = "Unknown";
        }

        // Log the reactivation action
        log_action($mysqli, $admin_username, 'REACTIVATE_USER', $id, "Reactivated user with ID $id");
    }

    // Redirect back to the main page after reactivation
    header("Location: user-mgmt.php");
    exit();
}

// Close the database connection
$mysqli->close();
?>
