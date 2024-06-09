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

// Prepare and execute query to fetch limited rows for the current page
$query = "SELECT * FROM users WHERE verification_status = 1 LIMIT ? OFFSET ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ii", $rows_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Fetch data
$data = $result->fetch_all(MYSQLI_ASSOC);

foreach ($data as $row) {
    echo "<tr class='text-center'>";
    echo "<td class='px-12 py-1 flex justify-center items-center'><img src='" . htmlspecialchars($row['profile_image']) . "' class='w-20 h-20'></td>";
    echo "<td class='px-12 py-1'>" . htmlspecialchars($row['fullname']) . "</td>";
    echo "<td class='px-12 py-1'>" . htmlspecialchars($row['id_submitted_date']) . "</td>";
    echo "<td class='px-12 py-1'>
            <button class='bg-yellow-500 hover:bg-yellow-900 text-white font-bold py-2 px-2 rounded mr-2 flex-1' onclick='redirectToReviewPage(\"" . htmlspecialchars($row['id']) . "\", \"" . htmlspecialchars($row['fullname']) . "\", \"" . htmlspecialchars($row['email']) . "\", \"" . htmlspecialchars($row['profile_image']) . "\", \"" . htmlspecialchars($row['date_of_birth']) . "\", \"" . htmlspecialchars($row['id_type']) . "\", \"" . htmlspecialchars($row['id_image']) . "\", \"" . htmlspecialchars($row['id_address']) . "\")'>
                <p>REVIEW</p>
            </button>

            <form method='post' action='update_status.php' class= 'flex-1' style='display:inline-block;'>
                <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                <input type='hidden' name='status' value='2'>
                <button type='submit' class='bg-green-500 hover:bg-green-900 text-white font-bold py-2 px-2 rounded mr-2'>
                <p>APPROVE</p>
                </button>
            </form>
            <form method='post' action='update_status.php' class= 'flex-1' style='display:inline-block;'>
                <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                <input type='hidden' name='status' value='0'>
                <button type='submit' class='bg-red-500 hover:bg-red-900 text-white font-bold py-2 px-2 rounded'>
                <p>DECLINE</p>
                </button>
            </form>
        </td>";
    echo "</tr>";
}

// Close connection
$mysqli->close();
?>

<script>
function redirectToBlankPage(id) {
    window.location.href = 'blank_page.php?id=' + id;
}


function redirectToReviewPage(id, fullname, email, profile_image, date_of_birth, id_type, id_image, id_address) {
    window.location.href = 'review_user.php?id=' + id + '&fullname=' + fullname + '&email=' + email + '&profile_image=' + profile_image + '&date_of_birth=' + date_of_birth + '&id_type=' + id_type + '&id_image=' + id_image + '&id_address=' + id_address;
}


</script>
