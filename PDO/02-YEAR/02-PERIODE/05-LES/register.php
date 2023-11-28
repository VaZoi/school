<?php
include("db.php");
$db = new Database;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["username"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"])
    ) {
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $db->registerUser($username, $email, $password);

        header("Location: login.php");
        exit;
    } else {
        echo "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="register.css">

</head>
<body>
    <h1>User Registration</h1>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="email">Email:</label>
        <input type="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button><br>
        <a href="login.php">Login here</a>
    </form>
</body>
</html>
