<?php

$sql = "DELETE FROM producten WHERE product_code=2";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
?>