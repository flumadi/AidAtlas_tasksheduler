<?php
session_start();
include 'db.php';

// Check if user is logged in
$username = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Fetch user records if logged in
$records = [];
if ($username) {
    $sql = "SELECT * FROM resources WHERE user_id = (SELECT id FROM users WHERE username = '$username')";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AidAtlas</title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to AidAtlas</h1>
        </header>
        <nav>
            <ul>
                <li><a href="http://localhost/AidAtlas/save_data.php">Save Data</a></li>
                <li><a href="http://localhost/AidAtlas/delete.php">Delete Data</a></li>
                <li><a href="http://localhost/AidAtlas/search.php">Search</a></li>
                <li><a href="login.php">Log out</a></li>
            </ul>
</nav>
        
        <main>
            <section>
                <h2>Get on track with AidAtlas!!</h2>
                <p> Manage Time and resources effectively by<br>
                using AidAtlas functionalities to save, search,<br>
                and delete data!!</p>
            </section>
            
            <?php if ($username): ?>
            <section>
                <h2>Your Records</h2>
                <?php if (count($records) > 0): ?>
                    <ul>
                        <?php foreach ($records as $record): ?>
                            <li>-ID: <?php echo $record['id']; ?>- Title: <?php echo htmlspecialchars($record['title']); ?>- Content: <?php echo htmlspecialchars($record['content']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No records found.</p>
                <?php endif; ?>
            </section>
            <?php else: ?>
            <section>
                <h2>Please Log In</h2>
                <p>You need to log in to view your records. <a href="login.php">Login here</a></p>
            </section>
            <?php endif; ?>
        </main>
        
        <footer>
            <p>&copy; 2024 AidAtlas. All rights reserved.</p>
        </footer>
    </div>
    

    <script src="scripts/scripts.js"></script>
</body>
</html>
