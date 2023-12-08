<?php

include("db.php");
$db = new database;


if (isset($_GET['klant_id'])) {
    $klant_id = $_GET['klant_id'];

    $bookingHistory = $db->getBookingHistory($klant_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link rel="stylesheet" href="reservering.css">
</head>
<body>

<nav>
<h1>Booking History for Klant ID <?php echo $klant_id; ?></h1>
<a href="admin_klanten.php"><h2>Terug naar klanten page</h2></a>
</nav>


<?php
    if (empty($bookingHistory)) {
        echo "<p>No booking history found for the specified customer.</p>";
    } else {
        echo "<table border='1'>
                <tr>
                <th>Boekings ID</th>
                <th>Auto ID</th>
                <th>Ophaaldatum</th>
                <th>Inleverdatum</th>
                <th>Ophaallocatie</th>
                <th>Inleverlocatie</th>
                <th>Status</th>
                <th>Kosten</th>
                <th>Aanmaakdatum</th>
                </tr>";

        foreach ($bookingHistory as $booking) {
            echo "<tr>
                    <td>" . $booking['Boekings_ID'] . "</td>
                    <td>" . $booking['Auto_ID'] . "</td>
                    <td>" . $booking['Ophaaldatum'] . "</td>
                    <td>" . $booking['Inleverdatum'] . "</td>
                    <td>" . $booking['Ophaallocatie'] . "</td>
                    <td>" . $booking['Inleverlocatie'] . "</td>
                    <td>" . $booking['Status'] . "</td>
                    <td>" . $booking['Kosten'] . "</td>
                    <td>" . $booking['Aanmaakdatum'] . "</td>
                </tr>";
        }

        echo "</table>";
    }
} else {
    echo "<p>Klant ID not provided.</p>";
}
?>

</body>
</html>
