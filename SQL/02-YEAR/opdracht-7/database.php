<?php
$host = "localhost";
$port = "3307";
$gebruikersnaam = "root";
$database = "webwinkel";

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $gebruikersnaam);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}
?>