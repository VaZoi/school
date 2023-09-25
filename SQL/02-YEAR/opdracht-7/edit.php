<?php
include "database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $naam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $geboortedatum = $_POST['geboortedatum'];
        $email = $_POST['email'];
        $telefoon = $_POST['telefoonnummer'];

        $query = "UPDATE Contacts SET voornaam=?, achternaam=?, geboortedatum=?, email=?, telefoonnummer=? WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$naam, $achternaam, $geboortedatum, $email, $telefoon, $id]);

        header("Location: Contacten.php");
        exit();
    }

    $query = "SELECT * FROM Contacts WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: Contacten.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact bewerken</title>
    <link rel="stylesheet" href="Contacten.css">
</head>
<body>
    <header>
        <h3>Contact bewerken</h3>
    </header>

    <section>
        <h2>Contactgegevens bewerken</h2>
        <form method="POST">
            <input type="text" name="voornaam" id="naam" placeholder="naam" value="<?php echo $contact['voornaam']; ?>"><br>
            <input type="text" name="achternaam" id="achternaam" placeholder="achternaam" value="<?php echo $contact['achternaam']; ?>"><br>
            <input type="date" name="geboortedatum" id="geboortedatum" placeholder="geboortedatum" value="<?php echo $contact['geboortedatum']; ?>"><br>
            <input type="email" name="email" id="email" placeholder="email" value="<?php echo $contact['email']; ?>"><br>
            <input type="tel" name="telefoonnummer" id="telefoonnummer" placeholder="telefoonnummer" value="<?php echo $contact['telefoonnummer']; ?>"><br>
            <button type="submit" value="Submit">Opslaan</button>
        </form>
    </section>
</body>
</html>
