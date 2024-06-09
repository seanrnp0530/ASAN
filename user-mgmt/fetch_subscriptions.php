<?php
header('Content-Type: application/json');

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

$sql = "SELECT subscription_status, users.fullname 
        FROM subscriptions 
        JOIN users ON subscriptions.client_id = users.id";
$result = $mysqli->query($sql);

$data = array();
$total_rows = 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $total_rows = $result->num_rows;
}
$mysqli->close();

echo json_encode(array("data" => $data, "total_rows" => $total_rows));
