<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get" action="process.php" name="register">
        <Input type="text" id="fname" name="fname" placeholder="Voornaam" required><br>
        <input type="text" id="lname" name="lname" placeholder="Achternaam" required><br>
        <input type="number" id="leeftijd" name="leeftijd" min="18" max="120" placeholder="leeftijd"><br>
        <input type="text" id="adres" name="adres" placeholder="adres"><br>
        <input type="email" id="email" name="email" placeholder="email" required><br>
        <input type="submit" value="Verzenden">
    </form>


</body>
</html>