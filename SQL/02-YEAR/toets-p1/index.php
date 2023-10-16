<?php

include("database.php");
// dit is je homepagina. Hier heb jij een formulier waar je aan de user een mogelijkheid geeft om
// een laptop toe te voegen in je tabel.

// Vervolgens moet je ervoor zorgen dat alle data in deze pagina in een tabel wordt getoond.

// Je hebt nog 1 knopje waar je de user een mogelijkheid geeft om een row aan te kunnen passen.
// de user wordt verwezen naar update.php.

function getLaptops($pdo) {
    $stmt = $pdo->query("SELECT * FROM producten");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$successMessage = "";

if (isset($_GET["success"]) && $_GET["success"] == 1) {
    $deletedUserId = $_GET["id"];
    $successMessage = "Laptop met ID $deletedUserId is succesvol verwijderd.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST["naam"];
    $merk = $_POST["merk"];
    $prijs = $_POST["prijs"];
    $beschrijving = $_POST["beschrijving"];

    $stmt = $pdo->prepare("SELECT * FROM producten WHERE naam = :naam");
    $stmt->bindParam(":naam", $naam);
    $stmt->execute();

    try {
            $stmt = $pdo->prepare("INSERT INTO producten (naam, merk, prijs, beschrijving) VALUES (:naam, :merk, :prijs, :beschrijving)");
            $stmt->bindParam(":naam", $naam);
            $stmt->bindParam(":merk", $merk);
            $stmt->bindParam(":prijs", $prijs);
            $stmt->bindParam(":beschrijving", $beschrijving);

            $stmt->execute();

            echo "Laptop succesvol toegevoegd.";
        } catch (PDOException $e) {
            echo "Fout bij het toevoegen van de Laptop: " . $e->getMessage();
        }
    }
$Laptops = getLaptops($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toets</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php
if (!empty($successMessage)) {
    echo "<p class='success-message'>$successMessage</p>";
}
if (count($Laptops) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>naam</th><th>merk</th><th>prijs</th><th>beschrijving</th></tr>";
    foreach ($Laptops as $Laptop) {
        echo "<tr>";
        echo "<td>{$Laptop['id']}</td>";
        echo "<td>{$Laptop['naam']}</td>";
        echo "<td>{$Laptop['merk']}</td>";
        echo "<td>{$Laptop['prijs']}<td>";
        echo "<td>{$Laptop['beschrijving']}<td>";
        echo "<td><a href='update.php?id={$Laptop['id']}' class='update-button'>Bewerken</a></td>";
        echo "<td><a href='delete.php?id={$Laptop['id']}' class='delete-button'>Verwijderen</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Er zijn geen Laptops beschikbaar in de database.";
}
?>

<h2>Laptop Toevoegen</h2>
    <form method="post">
        <input type="text" name="naam" placeholder="naam" required><br><br>
        <input type="text" name="merk" placeholder="merk" required><br><br>
        <input type="decimal" name="prijs" placeholder="prijs" required><br><br>
        <input type="text" name="beschrijving" placeholder="beschrijving" required><br><br>
        <input type="submit" class="submit" value="Toevoegen">
    </form>
</body>
</html>