<?php
include 'db.php';
session_start();

$search_results = [];
$search_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];
    $username = $_SESSION['username'];

    if (isset($username)) {
        $stmt = $conn->prepare("SELECT * FROM resources WHERE (title LIKE ? OR content LIKE ?) AND user_id = (SELECT id FROM users WHERE username = ?)");
        $likeSearch = "%$search%";
        $stmt->bind_param("sss", $likeSearch, $likeSearch, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $search_results[] = $row;
            }
        } else {
            $search_message = "No results found.";
        }

        $stmt->close();
    } else {
        $search_message = "User not logged in.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Data</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Search Data</h1>
        </header>
        <form method="post" action="search.php">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter Title name to search">
            <br>
            <input type="submit" value="Search">
            <button type="button" onclick="window.location.href='index.php'" style="padding: 10px 20px; background-color: #A52A2A; color: #FFFFFF; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; transition: background-color 0.3s ease; margin-left: 10px;">
                Exit
            </button>
        </form>
        
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <section>
                <h2 style="text-align: center;">Search Results</h2>
                <?php if (!empty($search_results)): ?>
                    <ul>
                        <?php foreach ($search_results as $result): ?>
                            <li>ID: <?php echo $result['id']; ?> - Title: <?php echo htmlspecialchars($result['title']); ?> - Content: <?php echo htmlspecialchars($result['content']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p><?php echo $search_message; ?></p>
                <?php endif; ?>
            </section>
        <?php endif; ?>
    </div>
</body>
</html>
