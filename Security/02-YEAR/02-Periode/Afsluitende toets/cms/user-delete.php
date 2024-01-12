<?php
require 'user.php';

try {
    if (isset($_GET['id'])) {
        if (!isset($_GET['csrf_token']) || $_GET['csrf_token'] !== $_SESSION['csrf_token']) {
            echo "CSRF token validation failed";
            exit();
        }

        unset($_SESSION['csrf_token']);

        $user->delete($_GET['id']);
        header("location:user-view.php?process=delete");
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
