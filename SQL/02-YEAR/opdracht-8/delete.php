<?php
include("database.php");

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $pdo->prepare("DELETE FROM gebruikers WHERE id = :id");
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        header("Location: opdracht_8.php?success=1&id=$id");
        exit();
    } else {
        echo "Fout bij het verwijderen van de gebruiker.";
    }
}
?>
