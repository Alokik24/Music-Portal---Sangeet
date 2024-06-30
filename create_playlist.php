<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $playlistName = mysqli_real_escape_string($conn, $_POST['playlistName']);

  $insertPlaylistQuery = "INSERT INTO Playlists (user_id, playlist_name, description) VALUES (DEFAULT, '$playlistName', '')";
  if ($conn->query($insertPlaylistQuery) === TRUE) {
    echo "Playlist created successfully";
    header("Location: dashboard.php");
  } else {
    echo "Error creating playlist: " . $conn->error;
  }
}
?>