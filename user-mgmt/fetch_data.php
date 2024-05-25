<?php
// Database connection and other configurations

error_reporting(E_ALL); 
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';
$db = 'asan wms';
$user = 'root';
$pass = '';

// Establish database connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the number of rows per page
$rows_per_page = 5;

// Get the current page number from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting row for the query
$offset = ($current_page - 1) * $rows_per_page;

// Prepare and execute query to fetch limited rows for the current page
$stmt = $conn->prepare("SELECT * FROM users WHERE is_deleted = 0 LIMIT ? OFFSET ?");
$stmt->bind_param('ii', $rows_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Fetch data
while ($row = $result->fetch_assoc()) {
    echo "<tr class='text-center'>";
    echo "<td class='px-12 py-2'><img src='" . htmlspecialchars($row['profile_image']) . "' class='w-20 h-20'></td>";
    echo "<td class='px-12 py-2'>" . htmlspecialchars($row['fullname']) . "</td>";
    echo "<td class='px-12 py-2'>" . htmlspecialchars($row['email']) . "</td>";
    echo "<td class='px-12 py-2'>" . htmlspecialchars($row['user_type']) . "</td>";
    echo "<td class='px-12 py-2'>
            <form method='post' action='delete.php' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to delete this row?\");'>
                <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                <button type='submit' class='bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-2 rounded'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24'>
                        <path fill='white' d='M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z'/>
                    </svg>
                </button>
            </form>
        </td>";
    echo "</tr>";
}

// Close statement and connection
$stmt->close();
$conn->close();

