<?php
include("db.php");
$db = new Database;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $user_id = $db->loginUser($username, $password);

        if ($user_id !== false) {
            $_SESSION['user_id'] = $user_id;
            header("Location: home.php");
            exit;
        } else {
            echo "Login failed. Please check your username and password." . PHP_EOL;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <h2>User Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button><br>
        <a href="register.php">Register here</a>
    </form>
</body>
</html>
