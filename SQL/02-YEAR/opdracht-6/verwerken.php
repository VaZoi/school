<?php
include("opdracht_6.php");

$naam = $_POST['naam'];
$email = $_POST['email'];
$telefoon = $_POST['telefoon'];

$naam = trim($naam);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Ongeldig e-mailadres! ";
    exit;
}

if (!preg_match("/^[a-zA-Z-' ]*$/", $naam)) {
}

try {
    $sql = "INSERT INTO klanten (naam, email, telefoon) VALUES (:naam, :email, :telefoon)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':naam', $naam);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefoon', $telefoon);
    $stmt->execute();
} catch (PDOException $e) {
    $e->getMessage();
}
?>
