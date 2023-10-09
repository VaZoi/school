<?php

include("database.php");

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function getUsers($pdo) {
    $stmt = $pdo->query("SELECT * FROM gebruikers");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$successMessage = "";

if (isset($_GET["success"]) && $_GET["success"] == 1) {
    $deletedUserId = $_GET["id"];
    $successMessage = "Gebruiker met ID $deletedUserId is succesvol verwijderd.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT * FROM gebruikers WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Fout: Gebruikersnaam bestaat al.";
    } else {
        $hashedPassword = hashPassword($password);

        try {
            $stmt = $pdo->prepare("INSERT INTO gebruikers (username, password) VALUES (:username, :password)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $hashedPassword);

            $stmt->execute();

            echo "Gebruiker succesvol toegevoegd aan de database.";
        } catch (PDOException $e) {
            echo "Fout bij het toevoegen van de gebruiker: " . $e->getMessage();
        }
    }
}
$users = getUsers($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if (!empty($successMessage)) {
    echo "<p class='success-message'>$successMessage</p>";
}
if (count($users) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Gebruikersnaam</th><th>Wachtwoord</th></tr>";
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['username']}</td>";
        echo "<td>{$user['password']}<td>";
        echo "<td><a href='edit.php?id={$user['id']}' class='edit-button'>Bewerken</a></td>";
        echo "<td><a href='delete.php?id={$user['id']}' class='delete-button'>Verwijderen</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Er zijn geen gebruikers beschikbaar in de database.";
}
?>
    <h2>User Toevoegen</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" class="submit" value="Toevoegen">
    </form>
</body>
</html>