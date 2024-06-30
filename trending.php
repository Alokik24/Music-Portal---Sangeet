<?php include 'shared_header.php'; ?>

<?php
include 'db_connect.php';

$sql = "SELECT s.song_id, s.title, s.artist, s.thumbnail, s.likes 
        FROM Songs s
        ORDER BY s.likes DESC";
$result = $conn->query($sql);

$trendingSongsByLikes = [];

if ($result->num_rows > 0) {
    while ($song = $result->fetch_assoc()) {
        $trendingSongsByLikes[] = $song;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trending Songs - Sangeet</title>
    <link rel="icon" href="images/logo1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">

    <style>

        .container {
            margin: 20px;
        }

        .section {
            margin-bottom: 30px;
        }

        .trending-song {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .trending-song img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }

        .song-details-link {
            text-decoration: none;
            color: #333;
            transition: color 0.3s ease;
        }

        .song-details-link:hover {
            color: #555;
        }

        .song-info {
            margin-left: 10px;
        }

        .likes-count {
            margin-top: 5px;
            color: #888;
        }
        .logo{
            height: 100px;
        }
    </style>
</head>

<body>
    <header>
        <img src="images/logo1.jpg" alt="Logo" class="logo">
        <div class="header-content">
            <h1>Spotlight</h1>
            <nav>
                <a href="listener_account.php">Listener Account</a>
                <a href="dashboard.php">Dashboard</a>
                <a href="index.html">Logout</a>
                <a href="search.php">Search</a>

            </nav>
        </div>
    </header>
    <div class="container">
        <h1>Trending Songs</h1>

        <div class="section">
            <h2>Songs by Likes</h2>
            <?php foreach ($trendingSongsByLikes as $song) : ?>
                <div class="trending-song">
                    <img src="<?php echo $song['thumbnail']; ?>" alt="Song Thumbnail">
                    <div class="song-info">
                        <a href="song-details.php?song_id=<?php echo $song['song_id']; ?>" class="song-details-link" target="_blank">
                            <p><?php echo $song['title']; ?> - <?php echo $song['artist']; ?></p>
                        </a>
                        <p class="likes-count">Likes: <?php echo $song['likes']; ?></p>
                    </div>
                </div>

            <?php endforeach; ?>

            <?php if (empty($trendingSongsByLikes)) : ?>
                <p>No trending songs found based on likes.</p>
            <?php endif; ?>
        </div>


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
    <script>

    </script>
</body>

</html>