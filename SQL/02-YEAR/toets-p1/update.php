<?php

include("database.php");
// in deze pagina ga je hetzelfde formulier gebruiken dat je in index.php hebt.

// Hier zorg je ervoor dat de user de informatie van de geselecteerde rij aan te kunnen passen.
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $naam = $_POST["naam"];
    $merk = $_POST["merk"];
    $prijs = $_POST["prijs"];
    $beschrijving = $_POST["beschrijving"];

    $stmt = $pdo->prepare("UPDATE producten SET naam = :naam, merk = :merk, prijs = :prijs, beschrijving = :beschrijving WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->bindParam(":naam", $naam);
    $stmt->bindParam(":merk", $merk);
    $stmt->bindParam(":prijs", $prijs);
    $stmt->bindParam(":beschrijving", $beschrijving);

    if ($stmt->execute()) {
        echo "Succesvol bijgewerkt.";
    } else {
        echo "Fout bij het updaten.";
    }
}


$id = $_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM producten WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="nav">
    <h2>Laptop Aanpassen</h2>
    <a href="index.php">Terug naar start</a>
    </div>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <input type="text" name="naam" value="<?php echo $user['naam']; ?>" required><br><br>
        <input type="text" name="merk" placeholder="merk" required><br><br>
        <input type="decimal" name="prijs" placeholder="prijs" required><br><br>
        <input type="text" name="beschrijving" placeholder="beschrijving" required><br><br>
        <input type="submit" class="submit" value="Opslaan">
    </form>
</body>
</html>
