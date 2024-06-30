<?php
session_start();

include 'db_connect.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

$userDataQuery = "SELECT * FROM Users WHERE username = '$username'";
$result = $conn->query($userDataQuery);

if ($result && $result->num_rows > 0) {
    $userData = $result->fetch_assoc();
    echo "<h1>Welcome, {$userData['username']}!</h1>";
    echo "<p>Email: {$userData['email_id']}</p>";
    echo "<p>Phone Number: {$userData['phone_no']}</p>";
} else {
    echo "User data not found.";
}

$conn->close();
?>
