<?php
include 'db_connect.php';

session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

if (isset($_POST['like']) && isset($_POST['song_id'])) {
  $songId = $_POST['song_id'];
  $userId = $_SESSION['user_id'];

  $sqlCheck = "SELECT * FROM likes WHERE song_id = ? AND user_id = ?";
  $stmtCheck = $conn->prepare($sqlCheck);
  $stmtCheck->bind_param("ii", $songId, $userId);
  $stmtCheck->execute();
  $result = $stmtCheck->get_result();

  if ($result->num_rows > 0) {
    echo "You've already liked this song.";
  } else {
    $sqlInsert = "INSERT INTO likes (song_id, user_id) VALUES (?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);

    if ($stmtInsert) {
      $stmtInsert->bind_param("ii", $songId, $userId);
      $stmtInsert->execute();
      $stmtInsert->close();

      $sqlUpdate = "UPDATE songs SET likes = likes + 1 WHERE song_id = ?";
      $stmtUpdate = $conn->prepare($sqlUpdate);

      if ($stmtUpdate) {
        $stmtUpdate->bind_param("i", $songId);
        $stmtUpdate->execute();
        $stmtUpdate->close();
      } else {
        echo "Error updating likes count: " . $conn->error;
      }

      header("Location: song-details.php?song_id=" . $songId);
      exit;
    } else {
      echo "Error preparing statement: " . $conn->error;
    }
  }
} else {
  header("Location: dashboard.php");
  exit;
}
