<?php include 'shared_header.php'; ?>
<?php
session_start();
include 'db_connect.php';

function fetchSongsFromDatabase($conn)
{
    $sql = "SELECT * FROM songs";
    $result = $conn->query($sql);

    $songs = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $songs[] = $row;
        }
    }
    return $songs;
}

function fetchPlaylistsForUser($conn, $userId)
{
    $sql = "SELECT * FROM Playlists WHERE user_id = $userId";
    $result = $conn->query($sql);

    $playlists = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $playlists[] = $row;
        }
    }
    return $playlists;
}
//for testing purposes
$playlists = ["Playlist 1", "Playlist 2", "Playlist 3"];

$songs = fetchSongsFromDatabase($conn);
$userId = 1; // Example user ID

$userPlaylists = fetchPlaylistsForUser($conn, $userId);

$sqlLikedSongsPlaylist = "SELECT * FROM Playlists WHERE user_id = $userId AND playlist_name = 'Liked Songs'";
$resultLikedSongsPlaylist = $conn->query($sqlLikedSongsPlaylist);

if ($resultLikedSongsPlaylist->num_rows > 0) {

    $sqlLikedSongs = "SELECT s.* FROM Likes l INNER JOIN Songs s ON l.song_id = s.song_id WHERE l.user_id = $userId";
    $resultLikedSongs = $conn->query($sqlLikedSongs);

    if ($resultLikedSongs->num_rows > 0) {
        while ($likedSong = $resultLikedSongs->fetch_assoc()) {
        }
    } else {
    }
} else {
    $insertLikedSongsPlaylist = "INSERT INTO Playlists (user_id, playlist_name, description) VALUES ($userId, 'Liked Songs', 'Auto-generated Liked Songs')";
    $conn->query($insertLikedSongsPlaylist);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard - Music Recommendations</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/logo1.jpg" type="image/x-icon">
    <style>
        
        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
            width: 100px;
            height: auto;
        }

        main {
            display: flex;
        }

      
        aside {
            width: 35%;
            padding: 20px;
            border-right: 1px solid #ccc;
            box-sizing: border-box;
        }

        aside h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        aside a {
            display: block;
            color: #333;
            text-decoration: none;
            padding: 8px 0;
            transition: color 0.3s ease;
        }

        aside a:hover {
            color: #000;
            font-weight: bold;
        }

        aside form {
            margin-top: 20px;
        }

        aside label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        aside input[type="text"],
        aside input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        aside input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        aside input[type="submit"]:hover {
            background-color: #444;
        }
    </style>
</head>

<body>
    <header>
        <img src="images/logo1.jpg" alt="Logo" class="logo">
        <div class="header-content">
            <h1>Welcome to Your Music Dashboard</h1>
            <nav>
                <a href="listener_account.php">Listener Account</a>
                <a href="trending.php">Trending</a>
                <a href="index.html">Logout</a>
                <a href="search.php">Search</a>

            </nav>
        </div>
    </header>
    <main>
        <aside>
            <h2>Playlists</h2>
            <?php
            $userPlaylists = fetchPlaylistsForUser($conn, $userId);

            foreach ($userPlaylists as $playlist) {
                $playlistId = $playlist['playlist_id'];
                $playlistName = htmlspecialchars($playlist['playlist_name']);
                echo '<a href="view_playlist.php?playlist_id=' . $playlistId . '">' . $playlistName . '</a>';
            }
            ?>

            <form action="create_playlist.php" method="post">
                <label for="playlistName">New Playlist:</label>
                <input type="text" id="playlistName" name="playlistName" required>
                <input type="submit" value="Create Playlist">
            </form>

        </aside>


        <section class="recommendations">
            <h2>Recommendations</h2>
            <div id="songList">
                <?php
                foreach ($songs as $song) {
                    echo '<div class="recommendation-item">';
                    echo '<img src="' . $song['thumbnail'] . '" alt="Thumbnail">';
                    echo '<a href="song-details.php?song_id=' . $song['song_id'] . '" target="_blank">' . $song['title'] . ' - ' . $song['artist'] . '</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
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
    <script src="scripts.js"></script>
</body>

</html>

<script>
    function loadSongDetails(songId) {
        fetch(`song-details.php?song_id=${songId}`)
            .then(response => response.json())
            .then(song => {
                const audioPlayer = new Audio();
                audioPlayer.src = song.file_path;

                document.getElementById('currentSongTitle').textContent = song.title;
                document.getElementById('currentSongArtist').textContent = song.artist;

            })
            .catch(error => console.error('Error loading song details:', error));
    }

    function loadSongList() {
        fetch('fetch_songs.php')
            .then(response => response.json())
            .then(songs => {
                const songListContainer = document.getElementById('songList');

                songs.forEach(song => {
                    const songElement = document.createElement('div');
                    songElement.classList.add('recommendation-item');
                    songElement.innerHTML = `
                            <img src="${song.thumbnail}" alt="Thumbnail">
                            <a href="#" class="song" data-song-id="${song.id}" onclick="loadSongDetails(${song.id})">
                                ${song.title} - ${song.artist}
                            </a>`;
                    songListContainer.appendChild(songElement);
                });
            })
            .catch(error => console.error('Error loading song list:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        loadSongList();
    });
</script>
</body>

</html>