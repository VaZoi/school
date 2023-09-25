<?php
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $geboortedatum = $_POST['geboortedatum'];
    $email = $_POST['email'];
    $telefoon = $_POST['telefoonnummer'];

    $query = "INSERT INTO Contacts (voornaam, achternaam, geboortedatum, email, telefoonnummer) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$naam, $achternaam, $geboortedatum, $email, $telefoon]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "DELETE FROM Contacts WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacten</title>
    <link rel="stylesheet" href="Contacten.css">
</head>
<body>
    <header>
        <h3>Contacten</h3>
    </header>

    <section>
        <h2>Contactenlijst</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Achternaam</th>
                <th>Geboortedatum</th>
                <th>Email</th>
                <th>Telefoon</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php
            $query = "SELECT * FROM Contacts";
            $stmt = $pdo->query($query);

            while ($rij = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $rij['id'] . "</td>";
                echo "<td>" . $rij['voornaam'] . "</td>";
                echo "<td>" . $rij['achternaam'] . "</td>";
                echo "<td>" . $rij['geboortedatum'] . "</td>";
                echo "<td>" . $rij['email'] . "</td>";
                echo "<td>" . $rij['telefoonnummer'] . "</td>";
                echo "<td><a href='edit.php?id=" . $rij['id'] . "'>Edit</a></td>";
                echo "<td><a href='delete.php?id=" . $rij['id'] . "'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </section>

    <div class="contact_toevoegen">
        <h2>Contact toevoegen</h2>
        <form method="POST">
            <input type="text" name="voornaam" id="naam" placeholder="naam" required>
            <input type="text" name="achternaam" id="achternaam" placeholder="achternaam" required>
            <input type="date" name="geboortedatum" id="geboortedatum" placeholder="geboortedatum" required>
            <input type="email" name="email" id="email" placeholder="email" required>
            <input type="tel" name="telefoonnummer" id="telefoon" placeholder="telefoonnummer">
            <button type="submit" value="Submit">Toevoegen</button>
        </form>
    </div>
</body>
</html>
