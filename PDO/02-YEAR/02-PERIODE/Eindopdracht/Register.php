<?php

include("db.php");
$db = new Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['voornaam']) && isset($_POST['achternaam']) && isset($_POST['email']) &&
        isset($_POST['password']) && isset($_POST['geboortedatum']) && isset($_POST['adres']) &&
        isset($_POST['telefoonnummer']) && isset($_POST['rijbewijs'])
    ) {
        $db->registerUser(
            $_POST['voornaam'],
            $_POST['achternaam'],
            $_POST['email'],
            $_POST['password'],
            $_POST['geboortedatum'],
            $_POST['adres'],
            $_POST['telefoonnummer'],
            $_POST['rijbewijs']
        );

        header('Location: home.php');
        exit();
    } else {
        $error_message = "Vul alle vereiste velden in.";
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<header>
        <img src="logometbackground.png" class="img" alt="VZRent" width="200px" height="50px">
        <a href="home.php">Home</a>
        <a href="rent.php" onclick="return checkLogin()">Rent</a>
        <a href="autos.php" onclick="return checkLogin()">Auto's</a>
        <a href="booked.php" onclick="return checkLogin()">My Bookings</a>
    </header>

    <h2>Registratieformulier</h2>

    <?php if (isset($error_message)) : ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post" action="register.php">
        Voornaam: <input type="text" name="voornaam" required><br>
        Achternaam: <input type="text" name="achternaam" required><br>
        E-mail: <input type="email" name="email" required><br>
        Wachtwoord: <input type="password" name="password" required><br>
        Geboortedatum: <input type="date" name="geboortedatum" required><br>
        Adres: <input type="text" name="adres" required><br>
        Telefoonnummer: <input type="tel" name="telefoonnummer" required><br>
        Rijbewijsnummer: <input type="text" name="rijbewijs" required><br>

        <input type="submit" value="Registreren">
    </form>

</body>
</html>
