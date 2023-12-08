<?php 

include("db.php");
$db = new database;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Boeking_klantID = $_POST['Boeking_klantID'];
  $Boeking_autoID = $_POST['Boeking_autoID'];
  $Boeking_Opdatum = $_POST['Boeking_Opdatum'];
  $Boeking_Indatum = $_POST['Boeking_Indatum'];
  $Boeking_Oplocatie = $_POST['Boeking_Oplocatie'];
  $Boeking_Inlocatie = $_POST['Boeking_Inlocatie'];
  $Boeking_Status = $_POST['Boeking_Status'];

  $Boeking_Kost = isset($_POST['Boeking_Kost']) ? $_POST['Boeking_Kost'] : 0;

  $pickupDate = new DateTime($Boeking_Opdatum);
  $returnDate = new DateTime($Boeking_Indatum);
  $durationHours = $pickupDate->diff($returnDate)->h;

  $hourlyRate = 20;
  $dailyRate = 120;
  $monthlyRate = 3500;

  $cost = 0;
  if ($durationHours < 24) {
      $cost = $durationHours * $hourlyRate;
  } elseif ($durationHours >= 24 && $durationHours < (24 * 30)) {
      $cost = ceil($durationHours / 24) * $dailyRate;
  } else {
      $cost = $monthlyRate;
  }

  $db->insertbooking($Boeking_klantID, $Boeking_autoID, $Boeking_Opdatum, $Boeking_Indatum, $Boeking_Oplocatie, $Boeking_Inlocatie, $Boeking_Status, $Boeking_Kost);
}

$boekings = $db->selectbookings();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | All Bookings</title>
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
        <li><a href="admin.php">Dashboard</a></li>
        <li class="active"><a href="admin_bookings.php">All Bookings</a></li>
        <li><a href="admin_medewerkers.php">Medewerkers</a></li>
        <li><a href="admin_klanten.php">Klanten</a></li>
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
        <li class="active"><a href="admin_bookings.php">All Bookings</a></li>
        <li><a href="admin_medewerkers.php">Medewerkers</a></li>
        <li><a href="admin_klanten.php">Klanten</a></li>
        <li><a href="admin_autos.php">Auto's</a></li>
        <li><a href="admin_locaties.php">Locaties</a></li>
      </ul><br>
    </div>
    <br>
  </div>
</div>
<div class="form">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="Boeking_klantID">Klant ID:</label>
    <select name="Boeking_klantID" required>
    <?php
    $klantIDs = $db->selectklantID();
    
    foreach ($klantIDs as $klantID) {
        echo "<option value='" . $klantID['Klant_ID'] . "'>" . $klantID['Klant_ID'] . "</option>";
    }
    ?>
    </select><br>

    <label for="Boeking_autoID">Auto ID:</label>
<select name="Boeking_autoID" required>
    <?php
    $carIDs = $db->selectcarID();
    foreach ($carIDs as $carID) {
        echo "<option value='" . $carID['Auto_ID'] . "'>" . $carID['Auto_ID'] . "</option>";
    }
    ?>
</select><br>

    <label for="Boeking_Opdatum">Ophaaldatum:</label>
    <input type="date" name="Boeking_Opdatum" required><br>

    <label for="Boeking_Indatum">Inleverdatum:</label>
    <input type="date" name="Boeking_Indatum" required><br>

    <label for="Boeking_Oplocatie">Ophaallocatie:</label>
<select name="Boeking_Oplocatie" required>
<?php
    $inleverlocaties = $db->selectInleverlocatie();
    
    foreach ($inleverlocaties as $inleverlocatie) {
        echo "<option value='" . $inleverlocatie['naam'] . "'>" . $inleverlocatie['naam'] . "</option>";
    }
    ?>
</select><br>

<label for="Boeking_Inlocatie">Inleverlocatie:</label>
<select name="Boeking_Inlocatie" required>
    <?php
    $inleverlocaties = $db->selectInleverlocatie();
    
    foreach ($inleverlocaties as $inleverlocatie) {
        echo "<option value='" . $inleverlocatie['naam'] . "'>" . $inleverlocatie['naam'] . "</option>";
    }
    ?>
</select><br>

    <label for="Boeking_Status">Status:</label>
    <select name="Boeking_Status" required>
        <option value="in behandeling">In behandeling</option>
        <option value="Afgerond">Afgerond</option>
        <option value="Geannuleerd">Geannuleerd</option>
    </select><br>

    <input type="submit" value="Boeking Toevoegen">
</form>
</div>

<table>
        <tr>
            <th>Boekings ID</th>
            <th>Klant ID</th>
            <th>Auto ID</th>
            <th>Ophaaldatum</th>
            <th>Inleverdatum</th>
            <th>Ophaallocatie</th>
            <th>Inleverlocatie</th>
            <th>Status</th>
            <th>Kosten</th>
            <th>Aanmaakdatum</th>
        </tr>
        <?php foreach ($boekings as $row): ?>
            <tr>
                <td><?php echo $row['Boekings_ID']; ?></td>
                <td><?php echo $row['Klant_ID']; ?></td>
                <td><?php echo $row['Auto_ID']; ?></td>
                <td><?php echo $row['Ophaaldatum']; ?></td>
                <td><?php echo $row['Inleverdatum']; ?></td>
                <td><?php echo $row['Ophaallocatie']; ?></td>
                <td><?php echo $row['Inleverlocatie']; ?></td>
                <td><?php echo $row['Status']; ?></td>
                <td><?php echo $row['Kosten']; ?></td>
                <td><?php echo $row['Aanmaakdatum']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>