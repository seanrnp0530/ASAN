<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json'); // Set content type to JSON

    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "asan wms"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        echo json_encode(array("error" => "Connection failed: " . $conn->connect_error));
        exit;
    }

    // Get username and password from POST request
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Prepare SQL statement to select user with provided credentials
    $stmt = $conn->prepare("SELECT * FROM superadmin WHERE username = ?");
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

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, redirect to the login page
    header("Location: login-authentication.html");
    exit;
}

