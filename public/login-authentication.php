<?php
session_start();

// Enable error reporting
ini_set('display_errors', 0); // Do not display errors to the user
ini_set('log_errors', 1); // Log errors
error_reporting(E_ALL);
$log_file = 'error_log.txt';
ini_set('error_log', $log_file);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json'); // Set content type to JSON

    // Database connection parameters
    $host = 'localhost';
    $db = 'asan_api';
    $user = 'root';
    $pass = '';

    // Establish database connection
    $mysqli = new mysqli($host, $user, $pass, $db);

    // Check connection
    if ($mysqli->connect_error) {
        error_log("Connection failed: " . $mysqli->connect_error);
        echo json_encode(array("error" => "Connection failed. Please check the server logs for more details."));
        exit;
    }

    // Get username and password from POST request
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Prepare SQL statement to select user with provided credentials
    $stmt = $mysqli->prepare("SELECT * FROM superadmin WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            // User exists, verify password
            $user = $result->fetch_assoc();
            if (password_verify($input_password, $user['password'])) {
                // Password is correct, login successful
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $input_username;
                echo json_encode(array("success" => "Login successful, will redirect you to the superadmin panel now."));
            } else {
                // Password is incorrect
                echo json_encode(array("error" => "Invalid password, please try again."));
            }
        } else {
            // User does not exist
            echo json_encode(array("error" => "User not found, please try again."));
        }

        // Close statement
        $stmt->close();
    } else {
        error_log("Failed to prepare statement: " . $mysqli->error);
        echo json_encode(array("error" => "Failed to prepare statement. Please check the server logs for more details."));
    }

    // Close connection
    $mysqli->close();
} else {
    // If the request method is not POST, redirect to the login page
    header("Location: login-authentication.html");
    exit;
}
?>
