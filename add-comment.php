<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId && isset($_POST['song_id']) && isset($_POST['comment'])) {
        $songId = $_POST['song_id'];
        $comment = $_POST['comment'];

        $sql = "INSERT INTO comments (user_id, song_id, comment) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $userId, $songId, $comment);

        if ($stmt->execute()) {
            header("Location: song-details.php?song_id=" . $songId);
            exit;
        } else {
            echo "Failed to add comment. Please try again.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Method not allowed.";
}
?>
