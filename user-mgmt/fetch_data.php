<?php
// Database connection and other configurations

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database credentials
$host = 'localhost';
$db = 'asan_api';
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

// Prepare and execute query to fetch limited rows for the current page
$stmt = $mysqli->prepare("SELECT * FROM users LIMIT ? OFFSET ?");
if ($stmt === false) {
    die("Prepare failed: " . $mysqli->error);
}

// Bind the parameters
$stmt->bind_param('ii', $rows_per_page, $offset);

// Execute the query
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Get the result
$result = $stmt->get_result();

// Check if there are results
if ($result->num_rows > 0) {
    // Fetch data
    while ($row = $result->fetch_assoc()) {
        // Determine user status
        $user_status = $row['is_deleted'] == 1 ? 'Deactivated' : 'Active';
        $verification_status = $row['verification_status'] == 0 ? 'Denied' : ($row['verification_status'] == 1 ? 'Pending' : 'Verified');

        // Display the user data
        echo "<tr class='text-center'>";
        echo "<td class='px-8 py-2 flex justify-center items-center'><img src='" . htmlspecialchars($row['profile_image'] ?? '', ENT_QUOTES, 'UTF-8') . "' class='w-20 h-20'></td>";
        echo "<td class='px-12 py-2'>" . htmlspecialchars($row['fullname'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td class='px-12 py-2'>" . htmlspecialchars($row['user_type'] ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td class='px-8 py-2'>" . htmlspecialchars($user_status ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td class='px-8 py-2'>" . htmlspecialchars($verification_status ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td class='px-12 py-2'>
                <form method='post' action='reactivate.php' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to reactivate this user?\");'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row['id'] ?? '', ENT_QUOTES, 'UTF-8') . "'>
                    <button type='submit' class='bg-green-500 hover:bg-green-900 text-white font-bold py-2 px-2 rounded'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24'>
                        <path fill='white' d='M21.5 9h-5l1.86-1.86A7.99 7.99 0 0 0 12 4c-4.42 0-8 3.58-8 8c0 1.83.61 3.5 1.64 4.85c1.22-1.4 3.51-2.35 6.36-2.35s5.15.95 6.36 2.35A7.95 7.95 0 0 0 20 12h2c0 5.5-4.5 10-10 10S2 17.5 2 12S6.5 2 12 2c3.14 0 5.95 1.45 7.78 3.72L21.5 4zM12 7c1.66 0 3 1.34 3 3s-1.34 3-3 3s-3-1.34-3-3s1.34-3 3-3'/>    
                        </svg>
                    </button>
                </form>
                <form method='post' action='deactivate.php' style='display:inline-block;' onsubmit='return confirm(\"Are you sure you want to deactivate this user?\");'>
                    <input type='hidden' name='id' value='" . htmlspecialchars($row['id'] ?? '', ENT_QUOTES, 'UTF-8') . "'>
                    <button type='submit' class='bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-2 rounded'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24'>
                        <path fill='white' d='M7.616 20q-.672 0-1.144-.472T6 18.385V6H5V5h4v-.77h6V5h4v1h-1v12.385q0 .69-.462 1.153T16.384 20zM17 6H7v12.385q0 .269.173.442t.443.173h8.769q.23 0 .423-.192t.192-.424zM9.808 17h1V8h-1zm3.384 0h1V8h-1zM7 6v13z'/>
                        </svg>
                    </button>
                </form>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>No users found.</td></tr>";
}

// Close statement and connection
$stmt->close();
$mysqli->close();
