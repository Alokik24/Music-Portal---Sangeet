<!-- shared_header.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/logo1.jpg" type="image/x-icon">
</head>

<body>

    <header>
        <div class="site-title">
        </div>

        <form action="" method="post">
            <label for="search_query">Search:</label>
            <input type="text" id="search_query" name="search_query" placeholder="Search for songs, artists" required>
            <button type="submit">Search</button>

            <div class="search-results">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    include 'db_connect.php';

                    $searchQuery = $_POST['search_query'];

                    $sql = "SELECT song_id, title, artist FROM Songs 
                        WHERE title LIKE ? OR artist LIKE ?";
                    $stmt = $conn->prepare($sql);

                    $searchParam = "%$searchQuery%";
                    $stmt->bind_param("ss", $searchParam, $searchParam);

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        echo '<select>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="song-details.php?song_id=' . $row['song_id'] . '" target="_blank">';
                            echo $row['title'] . ' - ' . $row['artist'];
                            echo '</option>';
                        }
                        echo '</select>';
                    } else {
                        echo 'No results found.';
                    }
                }
                ?>
            </div>
        </form>
    </header>
</body>

</html>