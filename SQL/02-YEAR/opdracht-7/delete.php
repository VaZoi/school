<?php
require("database.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']))
    $id = $_GET['id'];

    $query = "DELETE FROM Contacts WHERE id = ?";
    $stmt = $pdo->prepare($query);

    if ($stmt->execute([$id])) {
        header("Location: Contacten.php");
        exit();
    }
?>
