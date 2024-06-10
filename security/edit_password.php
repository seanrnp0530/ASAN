<?php
// Database connection
$host = 'localhost';
$db = 'asan_api';
$user = 'root';
$pass = '';

// Establish database connection
$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($username) || empty($old_password) || empty($new_password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit();
    }

    if ($new_password !== $confirm_password) {
        echo "<script>alert('New password and confirm password do not match.'); window.history.back();</script>";
        exit();
    }

    // Fetch the user's current password hash from the database
    $sql = "SELECT password FROM superadmin WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param("s", $username);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    $stmt->bind_result($stored_password_hash);
    if (!$stmt->fetch()) {
        echo "<script>alert('No user found with the provided username.'); window.history.back();</script>";
        exit();
    }
    $stmt->close();

    // Verify the old password
    if (!password_verify($old_password, $stored_password_hash)) {
        echo "<script>alert('Old Password is incorrect.'); window.history.back();</script>";
        exit();
    }

    // Hash the new password
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE superadmin SET password = ? WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $mysqli->error);
    }

    $stmt->bind_param("ss", $new_password_hash, $username);
    if ($stmt->execute()) {
        echo "<script>alert('Password successfully changed.'); window.location.href = 'security.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }
    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <script>
        function confirmDetails() {
            const username = document.getElementById('username').value;
            const oldPassword = document.getElementById('old_password').value;
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;

            if (username === "" || oldPassword === "" || newPassword === "" || confirmPassword === "") {
                alert("All fields are required.");
                return false;
            }

            if (newPassword !== confirmPassword) {
                alert("New password and confirm password do not match.");
                return false;
            }

            return confirm("Are you sure the entered details are correct?");
        }
    </script>
</head>
<body>
    <form method="POST" onsubmit="return confirmDetails();">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="old_password">Old Password:</label>
        <input type="password" id="old_password" name="old_password" required><br>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required><br>
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <button type="submit">Change Password</button>
    </form>
</body>
</html>
