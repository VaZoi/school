<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkel</title>
</head>
<?php

$host = 'localhost:3307';
$db = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected to database (Winkel)";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

if ($_SERVER["REQUEST_METHOD"])

?>
<body>
<form method="post">
    <input type="text" id="product_naam" name="product_naam" placeholder="product_naam"><br>
    <input type="number" id="prijs_per_stuk" name="prijs_per_stuk" placeholder="prijs_per_stuk"><br>
    <input type="text" id="omschrijving" name="omschrijving" placeholder="omschrijving"><br>
    <input type="button" placeholder="product toevoegen">

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $product_naam = $_POST['product_naam'];
        $prijs_per_stuk = $_POST['prijs_per_stuk'];
        $omschrijving = $_POST['omschrijving'];

        $gegevensformulier = array($product_naam, $prijs_per_stuk, $omschrijving);

    $stmt = $pdo->prepare("UPDATE producten SET (product_naam, prijs_per_stuk, omschrijving)WHERE product_code = 2; VALUES (?,?,?)");

    $resultaat = $stmt->execute($gegevensformulier);

}

?>

</body>
</html>