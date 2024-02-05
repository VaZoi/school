<?php 
include("db.php");
$db = new database;

$medewerkers = $db->selectmedewerkers();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $voornaam = htmlspecialchars($_POST['voornaam']);
  $achternaam = htmlspecialchars($_POST['achternaam']);
  $email = htmlspecialchars($_POST['email']);
  $password = htmlspecialchars($_POST['password']);
  $telefoonnummer = htmlspecialchars($_POST['telefoonnummer']);
  $adres = htmlspecialchars($_POST['adres']);
  $geboortedatum = htmlspecialchars($_POST['geboortedatum']);

    $db->addMedewerker($voornaam, $achternaam, $email, $password, $functie, $salaris, $telefoonnummer, $adres, $geboortedatum, $toegangsrechten);

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
        <li><a href="admin_medewerkers.php">All Bookings</a></li>
        <li class="active"><a href="#">Medewerkers</a></li>
        <li><a href="admin_klanten.php">Klanten</a></li>
        <li><a href="admin_autos.php">Auto's</a></li>
        <li><a href="admin_locaties.php">Locaties</a></li>
        <li><a href="home.php">Home Page</a></li>
        <li><a href="logout.php">Logout</a></li>
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
        <li class="active"><a href="admin_medewerkers.php">Medewerkers</a></li>
        <li><a href="admin_klanten.php">Klanten</a></li>
        <li><a href="admin_autos.php">Auto's</a></li>
        <li><a href="admin_locaties.php">Locaties</a></li>
        <li><a href="home.php">Home Page</a></li>
        <li><a href="logout.php">Logout</a></li>
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

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required><br>

        <label for="functie">Functie:</label>
        <input type="text" name="functie" required><br>

        <label for="salaris">Salaris:</label>
        <input type="decimal" name="salaris" required><br>

        <label for="telefoonnummer">Telefoonnummer:</label>
        <input type="tel" name="telefoonnummer" required><br>

        <label for="adres">Adres:</label>
        <input type="text" name="adres" required><br>

        <label for="geboortedatum">Geboortedatum:</label>
        <input type="date" name="geboortedatum" required><br>

        <label for="toegangsrechten">Toegangsrechten:</label>
        <input type="number" name="toegangsrechten" required><br>

        <input type="submit" value="Medewerker Toevoegen">
    </form>
</div>

<table>
        <tr>
            <th>Medewerker ID</th>
            <th>Voornaam</th>
            <th>Achternaam</th>
            <th>email</th>
            <th>Functie</th>
            <th>Salaris</th>
            <th>Telefoonnummer</th>
            <th>Adres</th>
            <th>Geboortedatum</th>
            <th>Aanmaakdatum</th>
            <th>Toegangsrechten</th>
        </tr>
        <?php foreach ($medewerkers as $row): ?>
            <tr>
                <td><?php echo $row['Medewerker_ID']; ?></td>
                <td><?php echo $row['Voornaam']; ?></td>
                <td><?php echo $row['Achternaam']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Functie']; ?></td>
                <td><?php echo $row['Salaris']; ?></td>
                <td><?php echo $row['Telefoonnummer']; ?></td>
                <td><?php echo $row['Adres']; ?></td>
                <td><?php echo $row['Geboortedatum']; ?></td>
                <td><?php echo $row['Aanmaakdatum']; ?></td>
                <td><?php echo $row['Toegangsrechten']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>