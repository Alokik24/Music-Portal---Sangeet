<?php
include 'db_connect.php';

$songsDirectory = "songs/"; 
$thumbnailsDirectory = "thumbnails/"; 

$files = array_diff(scandir($songsDirectory), array('..', '.'));

foreach ($files as $file) {
  $filePath = $songsDirectory . $file;

  if (pathinfo($file, PATHINFO_EXTENSION) === 'mp3') {
    $fileNameWithoutExtension = pathinfo($file, PATHINFO_FILENAME);
    $songDetails = explode(' - ', $fileNameWithoutExtension);

    if (count($songDetails) === 2) {
      $songArtist = $songDetails[0];
      $songTitle = $songDetails[1];

      $songURL = $songsDirectory . $file; 

      $thumbnailFile = $thumbnailsDirectory . $fileNameWithoutExtension . ".jpg";

      $sql = "INSERT INTO songs (title, artist, file_path, thumbnail) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);

      if ($stmt) {
        $stmt->bind_param("ssss", $songTitle, $songArtist, $songURL, $thumbnailFile);
        $stmt->execute();
      } else {
        echo "Error preparing statement: " . $conn->error;
      }
    } else {
      echo "Incorrectly named song file: " . $file;
    }
  } else {
    echo "File is not an MP3: " . $file;
  }
}

$conn->close();
