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

// Define the number of rows per page
$rows_per_page = 5;

// Get the current page number from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting row for the query
$offset = ($current_page - 1) * $rows_per_page;

// Get the total number of rows
$result = $mysqli->query("SELECT COUNT(*) AS total FROM users WHERE is_deleted = 0");
$total_rows = $result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $rows_per_page);

// Display pagination controls only if total rows are more than rows per page
if ($total_rows > $rows_per_page) {
    echo '<div class="pagination flex justify-center mt-5 mb-5 space-x-2 w-full">';
    if ($current_page > 1) {
        echo '<a href="?page=' . ($current_page - 1) . '" class="bg-gray-300 text-green-dark px-3 py-1 mx-1 rounded">&laquo; Previous</a>';
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            echo '<span class="current-page bg-green-dark text-white px-3 py-1 mx-1 rounded">' . $i . '</span>';
        } else {
            echo '<a href="?page=' . $i . '" class="bg-gray-300 text-green-dark px-3 py-1 mx-1 rounded">' . $i . '</a>';
        }
    }
    if ($current_page < $total_pages) {
        echo '<a href="?page=' . ($current_page + 1) . '" class="bg-gray-300 text-green-dark px-3 py-1 mx-1 rounded">Next &raquo;</a>';
    }
    echo '</div>';
}

// Close connection
$mysqli->close();
?>
