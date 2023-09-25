<?php
$host = "3307";
$gebruikersnaam = "root";
$database = "webwinkel";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $gebruikersnaam);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gegevens toevoegen</title>
</head>
<body>
    <h2>Voeg gegevens toe aan de database</h2>
    <form method="POST" action="verwerken.php">
        <label for="naam">Naam:</label>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefoon">Telefoonnummer:</label>
        <input type="text" id="telefoon" name="telefoon"><br><br>

        <input type="submit" value="Toevoegen">
    </form>
</body>
</html>
