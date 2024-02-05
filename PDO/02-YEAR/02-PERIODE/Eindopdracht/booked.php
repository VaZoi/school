<?php
session_start();
include("db.php");
$db = new Database;

if (!isset($_SESSION['user_role'])) {
    header("Location: rent.php");
    exit();
}

if (isset($_GET['Boeking_ID'])) {
    $booking_id = isset($_GET['Boeking_ID']) ? $_GET['Boeking_ID'] : null;
    
    $carDetails = $db->selectcarID();
    $customerDetails = $db->selectklanten();
    $pickupLocationDetails = $db->selectlocaties();
    $returnLocationDetails = $db->selectlocaties();
    $bookingDetails = $db->selectbookings($booking_id);

    var_dump($booking_id);
    var_dump($bookingDetails);

    if (!$bookingDetails) {
        die("Boeking niet gevonden.");
    }
} else {
    header("Location: booked.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boekingsdetails</title>
    <link rel="styesheet" href="rent.css">
</head>
<body>

<header>
        <img src="logometbackground.png" class="img" alt="VZRent" width="200px" height="50px">
        <a href="home.php">Home</a>
        <a href="rent.php" class="active">Rent</a>
        <a href="autos.php">Auto's</a>
        <a href="booked.php">My Bookings</a>
        <?php
        if (isset($_SESSION['type']) && ($_SESSION['type'] == 'medewerker' || $_SESSION['type'] == 'admin')) {
            echo '<a href="admin.php">Admin Page</a>';
        }

        if (isset($_SESSION['type'])) {
            echo '<a class="login" href="logout.php">Logout</a>';
        } else {
            echo '<a class="login" href="login.php">Login | Register</a>';
        }
        ?>
    </header>

<section>
    <h2>Boekingsdetails</h2>

    <div>
    <p><strong>Boekings-ID:</strong> <?php echo $bookingDetails['Boekings_ID']; ?></p>

        <!-- Autoinformatie -->
        <h3>Autoinformatie</h3>
        <?php foreach ($carDetails as $carDetail): ?>
            <p><strong>Merk van de auto:</strong> <?php echo $carDetail['Merk']; ?></p>
            <p><strong>Automodel:</strong> <?php echo $carDetail['Model']; ?></p>
            <p><strong>Kleur van de auto:</strong> <?php echo $carDetail['Kleur']; ?></p>
            <p><strong>Zitcapaciteit van de auto:</strong> <?php echo $carDetail['Zitcapaciteit']; ?></p>
            <p><strong>Brandstoftype van de auto:</strong> <?php echo $carDetail['Brandstoftype']; ?></p>
            <p><strong>Kilometerstand van de auto:</strong> <?php echo $carDetail['Kilometerstand']; ?> km</p>
            <p><strong>Bouwjaar van de auto:</strong> <?php echo $carDetail['Bouwjaar']; ?></p>
            <p><strong>Kenteken van de auto:</strong> <?php echo $carDetail['Kenteken']; ?></p>
        <?php endforeach; ?>

        <!-- Klantinformatie -->
        <h3>Klantinformatie</h3>
        <?php foreach ($customerDetails as $customerDetail): ?>
            <p><strong>Naam van de klant:</strong> <?php echo $customerDetail['Voornaam'] . ' ' . $customerDetail['Achternaam']; ?></p>
            <p><strong>E-mail van de klant:</strong> <?php echo $customerDetail['Email']; ?></p>
            <p><strong>Telefoonnummer van de klant:</strong> <?php echo $customerDetail['Telefoonnummer']; ?></p>
            <p><strong>Adres van de klant:</strong> <?php echo $customerDetail['Adres']; ?></p>
        <?php endforeach; ?>

        <!-- Locatie-informatie -->
        <h3>Locatie voor ophalen</h3>
        <?php foreach ($pickupLocationDetails as $pickupLocationDetail): ?>
            <p><strong>Locatienaam:</strong> <?php echo $pickupLocationDetail['naam']; ?></p>
            <p><strong>Locatieadres:</strong> <?php echo $pickupLocationDetail['Adres']; ?></p>
            <p><strong>Telefoonnummer van de locatie:</strong> <?php echo $pickupLocationDetail['telefoonnummer']; ?></p>
        <?php endforeach; ?>

        <h3>Locatie voor inleveren</h3>
        <?php foreach ($returnLocationDetails as $returnLocationDetail): ?>
            <p><strong>Locatienaam:</strong> <?php echo $returnLocationDetail['naam']; ?></p>
            <p><strong>Locatieadres:</strong> <?php echo $returnLocationDetail['Adres']; ?></p>
            <p><strong>Telefoonnummer van de locatie:</strong> <?php echo $returnLocationDetail['telefoonnummer']; ?></p>
        <?php endforeach; ?>

        <!-- Boekingsdetails -->
        <h3>Boekingsdetails</h3>
        <?php foreach ($bookingDetails as $bookingDetail): ?>
            <p><strong>Ophaaldatum:</strong> <?php echo $bookingDetail['Ophaaldatum']; ?></p>
            <p><strong>Inleverdatum:</strong> <?php echo $bookingDetail['Inleverdatum']; ?></p>
            <p><strong>Status:</strong> <?php echo $bookingDetail['Status']; ?></p>
            <p><strong>Totaalbedrag:</strong> &euro;<?php echo $bookingDetail['Kosten']; ?></p>
        <?php endforeach; ?>

    </div>

    <a href="booked.php">Terug naar Mijn Boekingen</a>
</section>

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
