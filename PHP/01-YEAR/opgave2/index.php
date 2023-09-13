<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <form method="POST">
        <label for="Username">Username</label>
        <input type="text" placeholder="Enter Username" name="Username" required>

        <label for="Password">Password</label>
        <input type="password" placeholder="Enter Password" name="Password" required>

        <input type="submit" name="knopje" value="submit"></button>
    </form>

    <?php
    $a = "Verzonden";
    $b = "Niet Verzonden";
    if (isset($_POST['knopje'])) {

        echo $a;
    } else {
        echo $b;
    }

    ?>
    
</body>


</html>