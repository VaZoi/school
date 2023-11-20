<?php
$servername = "localhost";
$port = "3307";
$username = "root";
$password = "";
$db = "test";
$conn;

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Failed to open the database connection.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "INSERT INTO `users` (`username`, `password`) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $password]);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
