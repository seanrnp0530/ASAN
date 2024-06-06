<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include session file to get admin username
include 'C:\xampp\htdocs\ASAN\public\session.php';

// Database connection details
$host = 'localhost';
$db = 'asan wms'; // Ensure there is no space in the database name
$user = 'root';
$pass = '';

// Establish database connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Set the connection charset to utf8mb4
$mysqli->set_charset("utf8mb4");

// Function to log audit actions
function log_action($mysqli, $admin_username, $action_type, $target_user_id = null, $description = null) {
    if ($stmt = $mysqli->prepare("INSERT INTO audit_logs (username, action_type, target_user_id, description) VALUES (?, ?, ?, ?)")) {
        $stmt->bind_param("ssss", $admin_username, $action_type, $target_user_id, $description);
        if (!$stmt->execute()) {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }
}

// Check if form is submitted for deletion
if (isset($_POST['id']) && isset($username)) { // Assuming $username is set in session.php
    $id = $_POST['id'];
    $admin_username = $username;  // Get admin username from session

    // Prepare and execute query to set is_deleted to 1
    if ($stmt = $mysqli->prepare("UPDATE users SET is_deleted = 1 WHERE id = ?")) {
        $stmt->bind_param("s", $id);
        if (!$stmt->execute()) {
            echo "Error executing statement: " . $stmt->error;
        } else {
            // Log the deletion action
            log_action($mysqli, $admin_username, 'DEACTIVATE_USER', $id, "Deactivated user with ID $id");
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $mysqli->error;
    }

    // Redirect back to the main page after deletion
    header("Location: user-mgmt.php");
    exit();
} else {
    echo "Required parameters are missing.";
}

// Close the database connection
$mysqli->close();
?>
