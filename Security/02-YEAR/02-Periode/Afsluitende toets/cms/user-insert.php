<?php

require 'user.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars($_POST['email']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                echo "CSRF token validation failed";
                exit();
            }

            unset($_SESSION['csrf_token']);

            $lastId = $user->add($_POST['email'], $_POST['password']);
            header("location:user-view.php?process=$lastId");
        } catch (\Exception $e) {
            echo "Fout bij het toevoegen" . $e->getMessage();
            die();
        }
    } else {
        header("location:user-view.php");
        exit();
    }
} 
?>
