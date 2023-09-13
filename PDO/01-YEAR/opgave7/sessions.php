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

//opdracht 1

$naam = "Julie";
$email = "2165220@talnet.nl";

$_SESSION['naam'] = $naam;
$_SESSION['email'] = $email;

// opdracht 2
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkel</title>
</head>
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

        $stmt = $pdo->prepare("INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving) VALUES (?,?,?)");

        $resultaat = $stmt->execute($gegevensformulier);

    }

    ?>

    </body>

    </html>
    <?php
    $data = $pdo->query("SELECT * FROM producten")->fetchAll();

    foreach ($data as $row) {
        echo $row['product_code'] . "<br />\n";
        echo $row['product_naam'] . "<br />\n";
        echo $row['prijs_per_stuk'] . "<br />\n";
        echo $row['omschrijving'] . "<br />\n";
    }

    $_SESSION['product_code'];
    $_SESSION['product_naam'];
    $_SESSION['prijs_per_stuk'];
    $_SESSION['omschrijving'];
?>