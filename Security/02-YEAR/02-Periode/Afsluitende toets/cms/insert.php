<?php

require 'user.php';

$userId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$myDb = new DB();

$csrfToken = $user->generateCsrfToken();
$_SESSION['csrf_token'] = $csrfToken;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="user-insert.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $csrfToken; ?>">
        <input type="text" name="email" placeholder="Email"> <br><br>
        <input type="text" name="password" placeholder="Password"><br><br>
        <input type="submit">
    </form>
</body>
</html>