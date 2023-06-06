<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkel</title>
</head>

<body>
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

// 1 Hoe je alles selecteert in een query zonder variable
$data = $pdo->query("SELECT * FROM producten")->fetchAll();

foreach ($data as $row) {
    echo $row['product_code'] . "<br />\n";
    echo $row['product_naam'] . "<br />\n";
    echo $row['prijs_per_stuk'] . "<br />\n";
    echo $row['omschrijving'] . "<br />\n";
}

// 2 Hoe je een single row selecteert met placeholders?
$zoek_product_code2 = 1;
$data = $pdo->prepare("SELECT * FROM producten WHERE product_code= ?");
$data->execute([$zoek_product_code2]);
$user = $stmt->fetch();

foreach ($user as $row) {
    echo $row['product_code'] . "<br />\n";
    echo $row['product_naam'] . "<br />\n";
    echo $row['prijs_per_stuk'] . "<br />\n";
    echo $row['omschrijving'] . "<br />\n";
}

// 3 Hoe je een single row selecteert met named parameters
$zoek_product_code = 2;
$data = $pdo->prepare("SELECT * FROM producten WHERE product_code= :product_code");
$data->execute([$zoek_product_code]);
$user = $stmt->fetch();

foreach ($user as $row) {
    echo $row['product_code'] . "<br />\n";
    echo $row['product_naam'] . "<br />\n";
    echo $row['prijs_per_stuk'] . "<br />\n";
    echo $row['omschrijving'] . "<br />\n";
}


?>
</body>

</html>