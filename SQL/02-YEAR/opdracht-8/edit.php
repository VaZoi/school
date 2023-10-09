<?php

include("database.php");

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $newUsername = $_POST["newUsername"];
    $newPassword = $_POST["newPassword"];

    if (empty($newUsername) || empty($newPassword)) {
        echo "Fout: Gebruikersnaam en wachtwoord zijn verplicht.";
    } else {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("UPDATE gebruikers SET username = :username, password = :password WHERE id = :id");
        $stmt->bindParam(":username", $newUsername);
        $stmt->bindParam(":password", $hashedPassword);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            echo "Gebruikersgegevens zijn succesvol bijgewerkt.";
        } else {
            echo "Fout bij het bijwerken van gebruikersgegevens.";
        }
    }
}

$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM gebruikers WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="nav">
    <h2>User Aanpassen</h2>
    <a href="opdracht_8.php">Terug naar start</a>
    </div>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="text" name="newUsername" value="<?php echo $user['username']; ?>" required><br><br>
        <input type="password" name="newPassword" placeholder="Password" required><br><br>
        <input type="submit" class="submit" value="Opslaan">
    </form>
</body>
</html>
