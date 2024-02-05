<?php

include("db.php");
$db = new Database;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Voornaam'], $_POST['Achternaam'], $_POST['Email'], $_POST['Telefoonnummer'], $_POST['Geboortedatum'], $_POST['Adres'], $_POST['Wachtwoord'])) {
    $voornaam = htmlspecialchars($_POST['Voornaam']);
    $achternaam = htmlspecialchars($_POST['Achternaam']);
    $email = htmlspecialchars($_POST['Email']);
    $telefoonnummer = htmlspecialchars($_POST['Telefoonnummer']);
    $geboortedatum = htmlspecialchars($_POST['Geboortedatum']);
    $adres = htmlspecialchars($_POST['Adres']);
    $Password = htmlspecialchars($_POST['Wachtwoord']);

    $db->registerUser($voornaam, $achternaam, $email, $telefoonnummer, $geboortedatum, $adres, $Password);
    
    header('Location: home.php');
    exit();
} else {
    $error_message = "Vul alle vereiste velden in.";
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
        Voornaam: <input type="text" name="Voornaam" required><br>
        Achternaam: <input type="text" name="Achternaam" required><br>
        E-mail: <input type="email" name="Email" required><br>
        Wachtwoord: <input type="password" name="Wachtwoord" required><br>
        Geboortedatum: <input type="date" name="Geboortedatum" required><br>
        Adres: <input type="text" name="Adres" required><br>
        Telefoonnummer: <input type="tel" name="Telefoonnummer" required><br>

        <input type="submit" value="Registreren">
    </form>

</body>
</html>
