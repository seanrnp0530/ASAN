<?php
// Include your database connection script here

// Database connection and other configurations
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

// Fetch audit logs data
$query = "SELECT * FROM audit_logs";
$result = $mysqli->query($query);

// Display audit logs data in table rows
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='text-center'>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['action_type'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No audit logs found</td></tr>";
}

// Close database connection
$mysqli->close();

