<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asan wms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT subscription_status, users.fullname 
        FROM subscriptions 
        JOIN users ON subscriptions.client_id = users.id";
$result = $conn->query($sql);

$data = array();
$total_rows = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $total_rows = $result->num_rows;
}
$conn->close();

echo json_encode(array("data" => $data, "total_rows" => $total_rows));
