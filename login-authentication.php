<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "login"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from POST request
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to select user with provided credentials
    $stmt = $conn->prepare("SELECT * FROM login_auth WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // User exists, verify password
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            // Password is correct, login successful
            echo json_encode(array("message" => "Login successful"));
        } else {
            // Password is incorrect
            echo json_encode(array("error" => "Invalid password"));
        }
    } else {
        // User does not exist
        echo json_encode(array("error" => "User not found"));
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, redirect to the login page
    header("Location: login-authentication.html");
    exit;
}
?>