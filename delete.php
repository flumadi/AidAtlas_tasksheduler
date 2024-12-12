<?php
include 'db.php';
session_start();

$delete_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_SESSION['username'];

    if (isset($id) && isset($username)) {
        $sql = "SELECT * FROM resources WHERE id = '$id' AND user_id = (SELECT id FROM users WHERE username = '$username')";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $sql = "DELETE FROM resources WHERE id = '$id' AND user_id = (SELECT id FROM users WHERE username = '$username')";

            if ($conn->query($sql) === TRUE) {
                $delete_message = "Record deleted successfully";
            } else {
                $delete_message = "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $delete_message = "Record not found or you do not have permission to delete it.";
        }
    } else {
        $delete_message = "Invalid request.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Data</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Delete Data</h1>
        </header>
        <form method="post" action="delete.php">
            <label for="id">Record ID:</label>
            <input type="text" id="id" name="id" placeholder="Enter record ID to delete data" required>
            <br>
            <input type="submit" value="Delete">
            <button onclick="window.location.href='index.php'" style="padding: 10px 20px; background-color: #A52A2A; color: #FFFFFF; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; transition: background-color 0.3s ease;" aria-label="Exit">
            <span class="navbar-toggler-icon"></span> Exit
        </button>
        </form>
        <?php if ($delete_message): ?>
            <p><?php echo $delete_message; ?></p>
        <?php endif; ?>
        
    </div>
</body>
</html>
