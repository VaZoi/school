<?php

require 'user.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = htmlspecialchars($_POST['email']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                echo "CSRF token validation failed";
                exit();
            }

            unset($_SESSION['csrf_token']);

            $user->edit($email, $_POST['password'], $_GET['id']);
            header("location:user-view.php?process=update");
        } else {
            header("location:user-view.php");
            exit();
        }
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
