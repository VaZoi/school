<?php 

include("db.php");
$db = new database;


$klanten = $db->selectklanten();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $geboortedatum = $_POST['geboortedatum'];
    $adres = $_POST['adres'];
    $telefoonnummer = $_POST['telefoonnummer'];
    $rijbewijsnummer = $_POST['rijbewijsnummer'];

    $db->addKlant($voornaam, $achternaam, $email, $geboortedatum, $adres, $telefoonnummer, $rijbewijsnummer);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dasboard</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="home.php"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">Dashboard</a></li>
        <li><a href="admin_bookings.php">All Bookings</a></li>
        <li><a href="admin_medewerkers.php">Medewerkers</a></li>
        <li class="active"><a href="admin_klanten.php">Klanten</a></li>
        <li><a href="admin_autos.php">Auto's</a></li>
        <li><a href="admin_locaties.php">Locaties</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav hidden-xs">
      <img src="logometbackground.png" alt="Logo" width="100%" height="150px">
      <ul class="nav nav-pills nav-stacked">
        <li><a href="admin.php">Dashboard</a></li>
        <li><a href="admin_bookings.php">All Bookings</a></li>
        <li><a href="admin_medewerkers.php">Medewerkers</a></li>
        <li class="active"><a href="admin_klanten.php">Klanten</a></li>
        <li><a href="admin_autos.php">Auto's</a></li>
        <li><a href="admin_locaties.php">Locaties</a></li>
      </ul><br>
    </div>
    <br>
  </div>
</div>

<div class="form">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="voornaam">Voornaam:</label>
                <input type="text" name="voornaam" required><br>

                <label for="achternaam">Achternaam:</label>
                <input type="text" name="achternaam" required><br>

                <label for="email">E-mail:</label>
                <input type="email" name="email" required><br>

                <label for="geboortedatum">Geboortedatum:</label>
                <input type="date" name="geboortedatum" required><br>

                <label for="adres">Adres:</label>
                <input type="text" name="adres" required><br>

                <label for="telefoonnummer">Telefoonnummer:</label>
                <input type="tel" name="telefoonnummer" required><br>

                <label for="rijbewijsnummer">Rijbewijsnummer:</label>
                <input type="number" name="rijbewijsnummer" required><br>

                <input type="submit" value="Voeg Klant Toe">
            </form>
</div>

<table>
        <tr>
            <th>Klant ID</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>email</th>
            <th>Geboortedatum</th>
            <th>Adres</th>
            <th>Telefoonnummer</th>
            <th>Rijbewijsnummer</th>
            <th>Reserveringsgeschiedenis</th>
            <th>Aanmaakdatum</th>
        </tr>
        <?php foreach ($klanten as $row): ?>
            <tr>
                <td><?php echo $row['klant_id']; ?></td>
                <td><?php echo $row['Voornaam']; ?></td>
                <td><?php echo $row['Achternaam']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Geboortedatum']; ?></td>
                <td><?php echo $row['Adres']; ?></td>
                <td><?php echo $row['Telefoonnummer']; ?></td>
                <td><?php echo $row['Rijbewijsnummer']; ?></td>
                <td><a href="reserveringsgeschiedenis.php?klant_id=<?php echo $row['klant_id']; ?>">Bekijk</a></td>
                <td><?php echo $row['Aanmaakdatum']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>