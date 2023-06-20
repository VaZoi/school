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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>week 7</title>
</head>
<body>
    <?php

    $data = $pdo->query("SELECT * FROM producten")->fetchAll();
    foreach ($data as $row) {
        echo $row['product_code'] . "<br />\n";
        echo $row['product_naam'] . "<br />\n";
        echo $row['prijs_per_stuk'] . "<br />\n";
        echo $row['omschrijving'] . "<br />\n";
    }
    ?>
<a href="delete.php">Delete</a>
</body>
</html>