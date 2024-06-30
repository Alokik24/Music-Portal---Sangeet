<?php include 'shared_header.php'; ?>

<?php
session_start();
include 'db_connect.php';

if (isset($_GET['song_id'])) {
    $songId = $_GET['song_id'];

    $sql = "SELECT title, artist, file_path, thumbnail FROM songs WHERE song_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $songId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $songDetails = [
            'title' => $row['title'],
            'artist' => $row['artist'],
            'file_path' => $row['file_path'],
            'thumbnail' => $row['thumbnail']
        ];
    } else {
        echo "Song not found.";
        exit;
    }
} else {
    header("Location: dashboard.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Play Song</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="player.css">
    <link rel="icon" href="images/logo1.jpg" type="image/x-icon">
    <style>
        .left-section {
            padding: 100px;
        }

        .comment-section {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
        }

        .comment-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .comment-section textarea {
            width: 100%;
            height: 80px;
            margin-bottom: 10px;
        }

        .comment-section input[type="submit"] {
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .comment-section input[type="submit"]:hover {
            background-color: #444;
        }

        .comment {
            margin-bottom: 10px;
        }

        .comment p {
            margin: 0;
        }

        .comment p strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <img src="images/logo1.jpg" alt="Logo" height="100px">
        </div>

        <div class="site-title">
            <h1>Sangeet - Your Melodic Journey</h1>
        </div>

        <nav>
            <ul>
                <a href="dashboard.php" target="_blank">Home</a>
                <a href="trending.php" target="_blank">Trending</a>
                <a href="listener_account.php" target="_blank">Account</a>
                <a href="search.php" target="_blank">Search</a>

            </ul>
        </nav>
    </header>
    <main>
        <div class="left-section">
            <?php if (isset($songDetails)) : ?>
                <div class="song-details-container">
                    <div class="song-thumbnail">
                        <img src="<?php echo $songDetails['thumbnail']; ?>" alt="Song Thumbnail" style="width: 500px; height: 250px; border: 1px solid #ccc;">
                    </div>


                    <div class="song-details">
                        <h2><?php echo $songDetails['title']; ?></h2>
                        <p><?php echo $songDetails['artist']; ?></p>
                        <audio controls style="width: 100%; max-width: 400px; margin-top: 10px;">
                            <source src="<?php echo $songDetails['file_path']; ?>" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>

                    <!-- Liked Songs -->
                    <?php
                    $userId = $_SESSION['user_id'] ?? null;

     

                    function checkIfLiked($conn, $songId, $userId)
                    {
                        $sql = "SELECT * FROM likes WHERE song_id = ? AND user_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $songId, $userId);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        return $result->num_rows > 0;
                    }
                    if ($userId) {
                        $liked = checkIfLiked($conn, $songId, $userId);
                        if ($liked) {
                            echo "<p>You've already liked this song.</p>";
                        } else {
                            echo '
                                <form action="like-song.php" method="post">
                                    <input type="hidden" name="song_id" value="' . $songId . '">
                                    <input type="submit" name="like" value="Like">
                                </form>
                            ';
                        }
                    } else {
                        echo "<p>Login required to like songs.</p>";
                    }

                    ?>
                    <!-- Comment section -->
                    <div class="comment-section">
                        <h3>Comments</h3>
                        <form action="add-comment.php" method="post">
                            <input type="hidden" name="song_id" value="<?php echo $songId; ?>">
                            <textarea name="comment" placeholder="Add your comment..." required></textarea>
                            <input type="submit" value="Add Comment">
                        </form>

                        <!-- Display existing comments -->
                        <?php
                        $sqlComments = "SELECT c.comment, u.username 
                    FROM comments c 
                    JOIN users u ON c.user_id = u.user_id 
                    WHERE c.song_id = ?";
                        $stmt = $conn->prepare($sqlComments);
                        $stmt->bind_param("i", $songId);
                        $stmt->execute();
                        $resultComments = $stmt->get_result();

                        if ($resultComments->num_rows > 0) {
                            while ($comment = $resultComments->fetch_assoc()) {
                                echo '<div class="comment">';
                                echo '<p><strong>' . $comment['username'] . ':</strong> ' . $comment['comment'] . '</p>';
                                echo '</div>';
                            }
                        } else {
                            echo "<p>No comments yet.</p>";
                        }
                        ?>
                    </div>


                </div>
        </div>
    <?php else : ?>
        <p>No song selected. <a href="dashboard.php">Go back to Dashboard</a></p>
    <?php endif; ?>
    </div>

    <div class="right-section">
        <div class="trending-songs-section">
            <h2>Trending Songs</h2>
            <?php
            $sql = "SELECT s.song_id, s.title, s.artist, s.thumbnail 
                FROM Songs s
                ORDER BY s.likes DESC, s.song_id DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($song = $result->fetch_assoc()) {
                    echo '<div class="trending-song">';
                    echo '<img src="' . $song['thumbnail'] . '" alt="Song Thumbnail" style="width: 50px; height: 50px;">';
                    echo '<a href="song-details.php?song_id=' . $song['song_id'] . '">';
                    echo '<p>' . $song['title'] . ' - ' . $song['artist'] . '</p>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo "No trending songs found.";
            }
            ?>
        </div>
    </div>
    </main>

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

    <script src="script.js"></script>
    <script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const player = new Plyr('#player');
        });
    </script>
</body>

</html>