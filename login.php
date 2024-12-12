<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $username;
            header("Location: index.php?msg=login_success");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles/forms.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Login</h1>
        </header>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <br>
            <input type="submit" value="Login">
        </form>
        <p>New here? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>
