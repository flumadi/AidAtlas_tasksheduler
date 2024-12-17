<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?msg=registration_success");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles/forms.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Sign Up</h1>
        </header>
        <form method="post" action="signup.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="password" required>
            <br>
            <input type="submit" value="Sign Up">
        </form>
        <p>Already signed up? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
