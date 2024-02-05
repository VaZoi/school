<?php

session_start();
include("db.php");
$db = new Database;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $wachtwoord = $_POST["wachtwoord"];

    $user = $db->getUserByEmail($email);

    if ($user && $db->loginUser($email, $wachtwoord)) {
        $_SESSION['user_role'] = $user['type'];
        echo "Inloggen geslaagd!";
        $_SESSION['user_id'] = $user['gebruiker_id'];

        if ($user['type'] == 'klant') {
            header("Location: home.php");
            exit();
        } elseif ($user['type'] == 'medewerker' || $user['type'] == 'admin') {
            header("Location: admin.php");
            exit();
        }
    } else {
        echo "Inloggen mislukt. Controleer uw gebruikersnaam en wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="id01" class="modal">
        <form class="modal-content animate" action="" method="post">
            <h2>Login Form</h2>
            <div class="container">
                <label for="Email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="Password"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="wachtwoord" required>

                <button type="submit" name="login">Login</button>

                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                <a class="register" href="Register.php">Register here</a>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <a href="home.php" class="cancelbtn">Cancel</a>
            </div>
            
            <?php
            if (isset($error_message)) {
                echo '<div class="error-message">' . $error_message . '</div>';
            }
            ?>
        </form>
    </div>
</body>
</html>
