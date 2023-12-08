<?php 

include("db.php");
$db = new database;

$autos = $db->selectautos();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $merk = $_POST['merk'];
    $model = $_POST['model'];
    $bouwjaar = $_POST['bouwjaar'];
    $kenteken = $_POST['kenteken'];
    $kleur = $_POST['kleur'];
    $zitcapaciteit = $_POST['zitcapaciteit'];
    $brandstoftype = $_POST['brandstoftype'];
    $kilometerstand = $_POST['kilometerstand'];
    $beschikbaarheid = $_POST['beschikbaarheid'];
    $afbeelding = $_POST['afbeelding'];

    $db->addauto($merk, $model, $bouwjaar, $kenteken, $kleur, $zitcapaciteit, $brandstoftype, $kilometerstand, $beschikbaarheid, $afbeelding);
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
        <li class="active"><a href="admin_autos.php">Auto's</a></li>
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
        <li><a href="admin_klanten.php">Klanten</a></li>
        <li class="active"><a href="admin_autos.php">Auto's</a></li>
        <li><a href="admin_locaties.php">Locaties</a></li>
      </ul><br>
    </div>
    <br>
    
    
  </div>
</div>

<div class="form">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="merk">Merk:</label>
                <input type="text" name="merk" required><br>

                <label for="model">Model:</label>
                <input type="text" name="model" required><br>

                <label for="bouwjaar">Bouwjaar:</label>
                <input type="number" name="bouwjaar" min="1900" max="2099" step="1" required>

                <label for="kenteken">Kenteken:</label>
                <input type="text" name="kenteken" required><br>

                <label for="kleur">Kleur:</label>
                <input type="text" name="kleur" required><br>

                <label for="zitcapaciteit">Zitcapaciteit:</label>
                <select name="zitcapaciteit" required>
                <option value="2 Personen">2 Personen</option>
                <option value="4 Personen">4 Personen</option>
                <option value="5 Personen">5 Personen</option>
                </select><br>

                <label for="brandstoftype">Brandstoftype:</label>
                <select name="brandstoftype" required>
                <option value="Benzine">Benzine</option>
                <option value="Elektrisch">Elektrisch</option>
                <option value="Diesel">Diesel</option>
                </select><br>

                <label for="kilometerstand">Kilometerstand:</label>
                <input type="number" name="kilometerstand" required><br>

                <label for="beschikbaarheid">Beschikbaarheid:</label>
                <input type="number" name="beschikbaarheid" required><br>

                <label for="afbeelding">Afbeelding:</label>
                <input type="file" name="afbeelding" required><br>

                <input type="submit" value="Voeg Auto Toe">
            </form>
</div>

<table>
        <tr>
            <th>Auto ID</th>
            <th>Merk</th>
            <th>Model</th>
            <th>Bouwjaar</th>
            <th>Kenteken</th>
            <th>Kleur</th>
            <th>Zitcapaciteit</th>
            <th>Brandstoftype</th>
            <th>Kilometerstand</th>
            <th>Beschikbaarheid</th>
            <th>Afbeelding</th>
        </tr>
        <?php foreach ($autos as $row): ?>
            <tr>
                <td><?php echo $row['Auto_ID']; ?></td>
                <td><?php echo $row['Merk']; ?></td>
                <td><?php echo $row['Model']; ?></td>
                <td><?php echo $row['Bouwjaar']; ?></td>
                <td><?php echo $row['Kenteken']; ?></td>
                <td><?php echo $row['Kleur']; ?></td>
                <td><?php echo $row['Zitcapaciteit']; ?></td>
                <td><?php echo $row['Brandstoftype']; ?></td>
                <td><?php echo $row['Kilometerstand']; ?></td>
                <td><?php echo $row['Beschikbaarheid']; ?></td>
                <td><img src="<?php echo $row['Afbeelding']; ?>" alt="Car Image"></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>