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
$pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);

// Define the number of rows per page
$rows_per_page = 5;

// Get the current page number from the query string, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the starting row for the query
$offset = ($current_page - 1) * $rows_per_page;

// Prepare and execute query to fetch limited rows for the current page
$stmt = $pdo->prepare("SELECT * FROM users WHERE is_deleted = 0 LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $rows_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

// Fetch data
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $row) {
    echo "<tr class='text-center'>";
    echo "<td class='px-12 py-1'><img src='" . htmlspecialchars($row['profile_image']) . "' class='w-20 h-20'></td>";
    echo "<td class='px-12 py-1'>" . htmlspecialchars($row['fullname']) . "</td>";
    echo "<td class='px-12 py-1'>" . htmlspecialchars($row['email']) . "</td>";
    echo "<td class='px-12 py-1'>" . htmlspecialchars($row['user_type']) . "</td>";
    echo "<td class='px-12 py-1'>
            <button class='bg-green-dark hover:bg-xanadu-800 text-white font-bold py-2 px-2 rounded mr-2' onclick='editRecord(\"" . htmlspecialchars($row['id']) . "\", \"" . htmlspecialchars($row['profile_image']) . "\", \"" . htmlspecialchars($row['fullname']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['user_type']) . "\")'>
                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24'>
                    <path fill='white' d='M5 19h1.098L16.796 8.302l-1.098-1.098L5 17.902zm-1 1v-2.52L17.18 4.288q.155-.137.34-.212T17.907 4t.39.064q.19.063.35.228l1.067 1.074q.165.159.226.35q.06.19.06.38q0 .204-.068.39q-.069.185-.218.339L6.519 20zM19.02 6.092l-1.112-1.111zm-2.782 1.67l-.54-.558l1.098 1.098z' />
                </svg>
            </button>
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

