<?php

include("db.php");
$db = new Database;

$product_naam = "Kauwgom";
$product_beschrijving = "6 stuks, meloensmaak";

$db->insert($product_naam, $product_beschrijving);

?>