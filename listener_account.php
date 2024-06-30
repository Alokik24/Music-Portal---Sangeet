<?php include 'shared_header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Listener Account - Sangeet</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/logo1.jpg" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            height: 100%;
            overflow-y: auto;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        .user-info {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .user-info h2 {
            margin-top: 0;
        }

        .user-info table {
            width: 100%;
            border-collapse: collapse;
        }

        .user-info th,
        .user-info td {
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }

        .liked-songs,
        .playlists,
        .comments {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
             max-height: calc(100vh - 260px); 
            overflow-y: auto;
        }

        header .logo {
            width: 100px;
        }

        .liked-songs h2,
        .playlists h2,
        .comments h2 {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <header>
        <img src="images/logo1.jpg" alt="Logo" class="logo">
        <div class="header-content">
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
                echo "<nav>";
                echo "<a href='dashboard.php'>Dashboard</a>";
                echo "<a href='trending.php'>Trending</a>";
                echo "<a href='index.html'>Logout</a>";
                echo "<a href='search.php'>Search</a>";

                echo "</nav>";
                echo "<div class='user-info'>";
                echo "<h2>User Information</h2>";
                echo "<table>";
                echo "<tr><th>User ID</th><td>{$userData['user_id']}</td></tr>";
                echo "<tr><th>Email ID</th><td>{$userData['email_id']}</td></tr>";
                echo "<tr><th>Phone Number</th><td>{$userData['phone_no']}</td></tr>";
                echo "<tr><th>Registration Date</th><td>{$userData['registration_date']}</td></tr>";
                echo "<tr><th>User Type</th><td>{$userData['user_type']}</td></tr>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "User data not found.";
            }

            $conn->close();
            ?>
        </div>
    </header>
</body>

<div class="liked-songs">
    <h2>Liked Songs</h2>
    <?php
  
    ?>
</div>

<div class="playlists">
    <h2>Playlists</h2>
    <?php

    ?>
</div>

<div class="comments">
    <h2>Comments</h2>
    <?php

    ?>
</div>

<footer>
    <div class="footer-content">
        <p>&copy; 2023 Your Music Dashboard. All rights reserved.</p>
        <div class="footer-links">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
            <a href="#">Contact Us</a>
        </div>
    </div>
</footer>

<script src="scripts.js"></script>
</body>

</html>