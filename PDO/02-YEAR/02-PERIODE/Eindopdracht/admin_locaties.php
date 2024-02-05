<?php 
include("db.php");
$db = new database;


$locaties = $db->selectlocaties();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = htmlspecialchars($_POST['naam']);
    $adres = htmlspecialchars($_POST['adres']);
    $telefoonnummer = htmlspecialchars($_POST['telefoonnummer']);

    $db->insertLocatie($naam, $adres, $telefoonnummer);
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
        <li><a href="admin_klanten.php">Klanten</a></li>
        <li><a href="admin_autos.php">Auto's</a></li>
        <li class="active"><a href="admin_locaties.php">Locaties</a></li>
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
        <li><a href="admin_medewerkers.php">Medewerkers</a></li>
        <li><a href="admin_klanten.php">Klanten</a></li>
        <li><a href="admin_autos.php">Auto's</a></li>
        <li class="active"><a href="admin_locaties.php">Locaties</a></li>
        <li><a href="home.php">Home Page</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul><br>
    </div>
    <br>
  </div>
</div>

<div class="form">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="naam">Naam:</label>
        <input type="text" name="naam" required><br>

        <label for="adres">Adres:</label>
        <input type="text" name="adres" required><br>

        <label for="telefoonnummer">Telefoonnummer:</label>
        <input type="text" name="telefoonnummer" required><br>

        <input type="submit" value="Locatie Toevoegen">
    </form>
</div>

<table>
        <tr>
            <th>Locatie ID</th>
            <th>Naam</th>
            <th>Adres</th>
            <th>Telefoonnummer</th>
        </tr>
        <?php foreach ($locaties as $row): ?>
            <tr>
                <td><?php echo $row['LocationID']; ?></td>
                <td><?php echo $row['naam']; ?></td>
                <td><?php echo $row['Adres']; ?></td>
                <td><?php echo $row['telefoonnummer']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>