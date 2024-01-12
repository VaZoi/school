<?php

require 'user.php';

if (isset($_GET['process'])) {
    echo "<h1>Successfully</h1>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2><a href="insert.php">Insert User</a></h2>
    <h2><a href="logout.php">Logout</a></h2>

    <?php
    $csrfToken = $user->generateCsrfToken();
    $_SESSION['csrf_token'] = $csrfToken;
    ?>

    <table border="1">
        <tr>
            <th>id</th>
            <th>email</th>
            <th>password</th>
            <th colspan="2">action</th>
        </tr>

        <tr>
        <?php
        try {
            $result = $user->all();
            if ($result) {
                foreach ($result as $row) {
                    echo "<tr>
                            <td>". $row['id']."</td>
                            <td>". $row['email']."</td>
                            <td>". $row['password']."</td>
                            <td><a href=\"user-edit-form.php?id=". $row['id']. "\">Edit</a></td>
                            <td><a href=\"user-delete.php?id=" . $row['id'] . "&csrf_token=" . $csrfToken . "\">Delete</a></td>
                        </tr>";
                }
            }
        } catch (\Exception $e) {
            // Better to log the error instead of echoing it directly
            echo 'Error: ' . $e->getMessage();
        }
        ?>
    </table>
</body>
</html>
