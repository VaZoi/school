<?php

include("db.php");
$db = new Database;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["product_naam"]) && isset($_POST["product_beschrijving"])) {
        $product_naam = $_POST["product_naam"];
        $product_beschrijving = $_POST["product_beschrijving"];

        $db->insertProduct($product_naam, $product_beschrijving);

        header("Location: home.php");
        exit();
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
    <h2>Product List</h2>
    <form class="form" method="post" action="">
        <label for="product_naam">Product Naam:</label>
        <input type="text" name="product_naam" required>
        <label for="product_beschrijving">Product Beschrijving:</label>
        <input type="text" name="product_beschrijving" required>
        <button type="submit">Insert Product</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>Beschrijving</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo $row['ID']; ?></td>
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
