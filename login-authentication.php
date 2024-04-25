<?php
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
$stmt = $conn->prepare("SELECT * FROM login_auth WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
  // User exists, login successful
  echo json_encode(array("message" => "Login successful"));
} else {
  // User does not exist or wrong credentials provided
  echo json_encode(array("error" => "Invalid credentials"));
}

// Close connection
$stmt->close();
$conn->close();
?>
