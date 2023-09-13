<?php

include("sessions.php");
session_start();
echo $_SESSION["naam"] . $_SESSION["email"];
echo $_SESSION['product_code'] . "<br>" . $_SESSION['product_naam'] . "<br>" . $_SESSION['prijs_per_stuk'] . "<br>" . $_SESSION['omschrijving'];
?>