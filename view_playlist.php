<?php include 'shared_header.php'; ?>

<?php
include 'db_connect.php';

if (isset($_GET['playlist_id'])) {
  $playlistId = $_GET['playlist_id'];

  $playlistQuery = "SELECT * FROM Playlists WHERE playlist_id = $playlistId";
  $playlistResult = $conn->query($playlistQuery);

  if ($playlistResult->num_rows > 0) {
    $playlistData = $playlistResult->fetch_assoc();
    $playlistName = htmlspecialchars($playlistData['playlist_name']);

    $songsQuery = "SELECT s.song_id, s.title, s.artist, s.thumbnail 
        FROM Songs s
        INNER JOIN Playlist_Songs ps ON s.song_id = ps.song_id
        WHERE ps.playlist_id = $playlistId";


    $songsResult = $conn->query($songsQuery);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>View Playlist</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="images/logo1.jpg" type="image/x-icon">

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      display: flex;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #ccc;
    }

    li img {
      width: 50px;
      height: 50px;
      margin-right: 10px;
    }

    li a {
      text-decoration: none;
      color: #333;
    }

    li a:hover {
      text-decoration: underline;
    }

    .logo {
      height: 150px;
    }
  </style>
</head>

<body>
  <header>
    <img src="images/logo1.jpg" alt="Logo" class="logo">
    <div class="header-content">
      <h1>Playlist: <?php echo isset($playlistName) ? $playlistName : ''; ?></h1>
      <nav>
        <a href="listener_account.php">Listener Account</a>
        <a href="trending.php">Trending</a>
        <a href="index.html">Logout</a>
      </nav>
    </div>
  </header>

  <main>

    <div class="playlist-songs">
      <?php
      if (isset($songsResult) && $songsResult->num_rows > 0) {
        echo '<ul>';
        while ($song = $songsResult->fetch_assoc()) {
          echo '<li>';
          echo '<img src="' . $song['thumbnail'] . '" alt="Thumbnail">';
          echo '<a href="song-details.php?song_id=' . $song['song_id'] . '">' . $song['title'] . ' - ' . $song['artist'] . '</a>';
          echo '</li>';
        }
        echo '</ul>';
      } else {
        echo '<p>No songs in this playlist.</p>';
      }
      ?>
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

</body>

</html>