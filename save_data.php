<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];

    if (isset($username)) {
        $sql = "SELECT id FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $user_id = $user['id'];

            $sql = "INSERT INTO resources (title, content, user_id) VALUES ('$title', '$content', '$user_id')";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php?msg=save_success");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "User not logged in.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Save Data</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Save Data</h1>
        </header>
        <form method="post" action="save_data.php">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Title">
            <br>
            <label for="content">Content:</label>
            <textarea id="content" name="content" placeholder="Content" required></textarea>
            <br>
            <input type="submit" value="Save">
            <button onclick="window.location.href='index.php'" 
        style="padding: 10px 20px; 
               background-color: #A52A2A; 
               color: #FFFFFF; 
               border: none; 
               border-radius: 4px; 
               cursor: pointer; 
               font-weight: bold; 
               transition: background-color 0.3s ease;" aria-label="Exit">
            <span class="navbar-toggler-icon"></span> Exit
        </button>
        </form>
    </div>
</body>
</html>
