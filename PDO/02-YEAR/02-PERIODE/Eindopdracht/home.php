<?php
session_start();
include "db.php";
$db = new Database();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <script src="home.js"></script>
</head>
<body>
  
<header>
    <img src="logometbackground.png" class="img" alt="VZRent" width="200px" height="50px">
    <a href="home.php" class="active">Home</a>
    <a href="rent.php">Rent</a>
    <a href="autos.php">Auto's</a>
    <a href="booked.php">My Bookings</a>

    <?php
    if (isset($_SESSION['user_role']) && ($_SESSION['user_role'] == 'medewerker' || $_SESSION['user_role'] == 'admin')) {
        echo '<a href="admin.php">Admin Page</a>';
    }

    if (isset($_SESSION['user_role'])) {
        echo '<a class="login" href="logout.php">Logout</a>';
    } else {
        echo '<a class="login" href="login.php">Login | Register</a>';
    }
    ?>
</header>
</body>
</html>


    <div class="bg-image"></div>

    <div class="bg-text">
      <h2>Rent A Car</h2>
      <h1 style="font-size:50px">We Are VZRent</h1>
      <p>Rent a car nearby in a minute!</p>
    </div>

    <div class="location">
      <div class="left">
        <h2>40+</h>
        <h3>Vestigingen</h3>
      </div>

      <div class="middle">
        <h2>VZRent's Vestigingen</h2>
        <img src="Ontwerp zonder titel.png" alt="locations">
      </div>

      <div class="right">
        <h2>Nederland</h2>
      </div>
      
    </div>

    <footer>
      <a href="About_Us.html">About US</a>
      <a href="privacypolicy.html">Privacy Policy</a>
      <a href="Algemene_huurvoorwaarden.html">Algemene Huurvoorwaarden</a>
      <div class="allfooter">
        <div class="time">
          <h2>Openingstijden:</h2>
          <p>Maandag: 8.00-22.00</p>
          <p>Dinsdag: 8.00-22.00</p>
          <p>Woensdag: 8.00-22.00</p>
          <p>Donderdag: 8.00-22.00</p>
          <p>Vrijdag: 8.00-22.00</p>
          <p>Zaterdag: 9.00-22.00</p>
          <p>Zondag: 10.00-20.00</p>
        </div>
        <div class="contact">
          <h2>Contact Us</h2>
          <p><i class="fa fa-phone"></i>(+31)6 75 75 75 7
          <br/><br/><i class="fa fa-envelope"></i>info@vzrent.nl</p>
        </div>
      </div>
    </footer>

</body>
</html>