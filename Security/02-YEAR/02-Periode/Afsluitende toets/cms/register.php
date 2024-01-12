<?php

require 'user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // prevent xss
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                echo "CSRF token validation failed";
                exit();
            }
        
            unset($_SESSION['csrf_token']);
        
            $lastId = $user->add($email, $pass);
            header("location:user-view.php?process=$lastId");
        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage();
        }        
    }

    
}

$csrfToken = $user->generateCsrfToken();
$_SESSION['csrf_token'] = $csrfToken;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Systeem</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        Email: <input type="text" name="email" placeholder="email" required><br>
        Wachtwoord: <input type="password" name="password" placeholder="password" required><br>
        <input type="submit">
    </form>
</body>
</html>