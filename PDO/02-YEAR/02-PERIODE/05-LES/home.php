<?php

include("db.php");
$db = new Database;

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['logout'])) {
    $db->logoutUser();
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["product_image"]["name"]) && isset($_POST["product_naam"]) && isset($_POST["product_beschrijving"])) {
        $product_image_name = $_FILES["product_image"]["name"];
        $product_naam = $_POST["product_naam"];
        $product_beschrijving = $_POST["product_beschrijving"];

        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($product_image_name);

        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            $db->insertProduct($product_image_name, $product_naam, $product_beschrijving);

            header("Location: home.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Please fill in all required fields.";
    }
}


$data = $db->selectProducten();

if (isset($_POST['delete_product_id'])) {
    $product_id = $_POST['delete_product_id'];

    $db->deleteProduct($product_id);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Home</title>
</head>
<body>
    <form method="post" action="">
        <h2>Product List</h2>
        <button type="submit" class="logout" name="logout">Logout</button>
    </form>
    <form class="form" method="post" action="" enctype="multipart/form-data">
        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" required>
        <label for="product_naam">Product Naam:</label>
        <input type="text" name="product_naam" required>
        <label for="product_beschrijving">Product Beschrijving:</label>
        <input type="text" name="product_beschrijving" required>
        <button type="submit">Insert Product</button>
    </form>

    <table>
        <tr>
            <th class="id">ID</th>
            <th class="im">image</th>
            <th>Naam</th>
            <th>Beschrijving</th>
            <th class="act">Action</th>
        </tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
                <td>
                    <?php
                    $imagePath = "uploads/" . $row['image'];
                    echo "<img src='$imagePath' alt='Product Image' style='max-width: 100px; max-height: 100px;'>";
                    ?>
                </td>
                <td><?php echo $row['naam']; ?></td>
                <td><?php echo $row['beschrijving']; ?></td>
                <td class="action">
                    <button type="submit"><a href="edit_product.php?id=<?php echo $row['ID']; ?>" class="button-edit">Edit</a></button>
                    <form method="post" action="">
                        <input type="hidden" name="delete_product_id" value="<?php echo $row['ID']; ?>">
                        <button type="submit" class="button-delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
