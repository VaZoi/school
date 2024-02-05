<?php
session_start();
$displayPrice = null;
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

    <div class="rentcar">

    </div>

<body>

    <div class="prices">
      <div class="columns">
        <ul class="price">
          <li class="header" style="background-color:gold">Day</li>
          <li class="grey">&euro; 65 / Day</li>
        </ul>
      </div>

    </div>

<section class="rentpicture">
  
  <div class="rentform">
  <h2>Rent a Car</h2>

        <form action="" method="post">
            <label for="auto_id">Selecteer auto:</label>
            <select name="auto_id" id="auto_id">
                <?php
                $autos = $db->selectautos();
                foreach ($autos as $auto) {
                    echo "<option value=\"{$auto['Auto_ID']}\">{$auto['Merk']} {$auto['Model']}</option>";
                }
                ?>
            </select>

            <label for="ophaaldatum">Ophaal Datum:</label>
            <input type="date" name="ophaaldatum" required>

            <label for="inleverdatum">Inlever Datum:</label>
            <input type="date" name="inleverdatum" required>

            <label for="ophaallocatie">Ophaal Locatie:</label>
            <select name="ophaallocatie" id="ophaallocatie">
                <?php
                $ophaallocaties = $db->selectInleverlocatie();
                foreach ($ophaallocaties as $locatie) {
                    echo "<option value=\"{$locatie['naam']}\">{$locatie['naam']}</option>";
                }
                ?>
            </select>

            <label for="inleverlocatie">Inlever Locatie:</label>
            <select name="inleverlocatie" id="inleverlocatie">
                <?php
                $inleverlocaties = $db->selectInleverlocatie();
                foreach ($inleverlocaties as $locatie) {
                    echo "<option value=\"{$locatie['naam']}\">{$locatie['naam']}</option>";
                }
                ?>
            </select>

                <?php
                  if ($displayPrice !== null) {
                      echo "<p>Total Price: &euro;{$displayPrice}</p>";
                  }
                ?>

            <input type="hidden" name="status" value="In behandeling">

            <button type="submit" name="rent">Boek Nu</button>
        </form>
  </div>
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
</section>

<footer>
      <a href="About_Us.html">About US</a>
      <a href="privacypolicy.html">Privacy Policy</a>
      <a href="Algemene_huurvoorwaarden.html">Algemene Huurvoorwaarden</a>
      
    </footer>
</body>
</html>

