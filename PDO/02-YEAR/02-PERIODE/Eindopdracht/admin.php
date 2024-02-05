<?php 

include("db.php");
$db = new database;

$rentcount = 0;
$usercount = 0;
$autocount = 0;
$locatiecount = 0;

$counts = $db->admin($usercount, $rentcount, $autocount, $locatiecount);

$usercount = $counts['user_count'];
$rentcount = $counts['rent_count'];
$autocount = $counts['auto_count'];
$locatiecount = $counts['locatie_count'];
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
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="admin_bookings.php">All Bookings</a></li>
        <li><a href="admin_medewerkers.php">Medewerkers</a></li>
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
        <li class="active"><a href="admin.php">Dashboard</a></li>
        <li><a href="admin_bookings.php">All Bookings</a></li>
        <li><a href="admin_medewerkers.php">Medewerkers</a></li>
        <li><a href="admin_klanten.php">Klanten</a></li>
        <li><a href="admin_autos.php">Auto's</a></li>
        <li><a href="admin_locaties.php">Locaties</a></li>
        <li><a href="home.php">Home Page</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul><br>
    </div>
    <br>
    
    <div class="col-sm-9">
      <div class="well">
        <h4>Dashboard</h4>
        <p>Welkom admin!</p>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="well">
            <h4>Klanten</h4>
            <p><?php echo $usercount; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Gehuurd</h4>
            <p><?php echo $rentcount; ?></p> 
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Auto's</h4>
            <p><?php echo $autocount; ?></p>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="well">
            <h4>Locaties</h4>
            <p><?php echo $locatiecount; ?></p> 
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>
</div>
</body>
</html>