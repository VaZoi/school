<?php

include("db.php");
$db = new Database;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="rent.css">
    <script src="home.js"></script>
</head>

<header>
        <img src="logometbackground.png" class="img" alt="VZRent" width="200px" height="50px">
        <a href="home.php">Home</a>
        <a href="rent.php" class="active">Rent</a>
        <a href="autos.php">Auto's</a>
        <a href="booked.php">My Bookings</a>
        <a class="login" href="login.php">Login | Register</a>
    </header>

    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <h2>Login Form</h2>
    <div class="container">
            <label for="Email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="Email" required>

            <label for="Password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="Password" required>

            <button type="submit" name="login">Login</button>

            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <a class="register" href="Register.php">Register here</a>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
    </form>
    </div>

    <div class="rentcar">

    </div>

<body>

    <div class="prices">

<div class="columns">
  <ul class="price">
    <li class="header" style="background-color:gold">Day</li>
    <li class="grey">&euro; 120 / day</li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="header">Month</li>
    <li class="grey">&euro; 3500 / month</li>
  </ul>
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

