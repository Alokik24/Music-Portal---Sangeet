<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Search Music</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="images/logo1.jpg" type="image/x-icon">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: gray;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    form {
      display: flex;
      margin-bottom: 20px;
      padding: 30px;
    }

    label {
      margin-right: 10px;
    }

    input[type="text"] {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      padding: 8px 15px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #555;
    }

    .search-results {
      width: 80%;
      max-width: 600px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      overflow-y: auto;
      max-height: 70vh;
    }

    .search-result {
      margin-bottom: 10px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ccc;
      display: flex;
      align-items: center;
    }

    .search-result img {
      width: 50px;
      height: 50px;
      margin-right: 15px;
      border-radius: 4px;
    }

    .search-result p {
      margin: 0;
      font-size: 16px;
      color: #333;
    }

    .search-result a {
      text-decoration: none;
      color: #333;
    }

    .search-result a:hover {
      text-decoration: underline;
    }

    .no-results {
      text-align: center;
      color: #f00;
      font-size: 18px;
    }

    .logo {
      height: 100px;
    }
  </style>
</head>

<body>
  <header>
    <img src="images/logo1.jpg" alt="Logo" class="logo">
    <div class="header-content">
      <nav>
        <a href="listener_account.php">Listener Account</a>
        <a href="trending.php">Trending</a>
        <a href="index.html">Logout</a>
        <a href="dashboard.php">Dashboard</a>

      </nav>
    </div>
  </header>
  <form method="post">
    <label for="search_query">Search:</label>
    <input type="text" id="search_query" name="search_query" placeholder="Search for songs, artists, or albums" required>
    <button type="submit">Search</button>
  </form>

  <div class="search-results">
    <?php
    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_query'])) {
      $searchQuery = $_POST['search_query'];

      $sql = "SELECT song_id, title, artist, thumbnail FROM Songs 
                    WHERE title LIKE ? OR artist LIKE ?";
      $stmt = $conn->prepare($sql);

      $searchParam = "%$searchQuery%";
      $stmt->bind_param("ss", $searchParam, $searchParam);

      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        // Display search results with links to song-details.php
        while ($row = $result->fetch_assoc()) {
          echo '<div class="search-result">';
          echo '<a href="song-details.php?song_id=' . $row['song_id'] . '" target="_blank">';

          echo '<img src="' . $row['thumbnail'] . '" alt="Thumbnail">';
          echo '<p>' . $row['title'] . ' - ' . $row['artist'] . '</p>';
          echo '</a>';
          echo '</div>';
        }
      } else {
        echo '<p class="no-results">No results found.</p>';
      }
    }
    ?>
  </div>
</body>

</html>