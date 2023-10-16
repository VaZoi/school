<?php
include("database.php");

if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    $stmt = $pdo->prepare("DELETE FROM producten WHERE id = :id");
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
        header("Location: index.php?success=1&id=$id");
        exit();
    }
}
?>