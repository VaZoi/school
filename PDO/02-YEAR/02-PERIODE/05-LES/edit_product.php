<?php
include("db.php");
$db = new Database;

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $new_product_naam = $_POST["new_product_naam"];
    $new_product_beschrijving = $_POST["new_product_beschrijving"];

    $targetDirectory = "uploads/";
    $new_product_image = $_FILES["new_product_image"]["name"];
    $targetFile = $targetDirectory . basename($new_product_image);

    if (move_uploaded_file($_FILES["new_product_image"]["tmp_name"], $targetFile)) {
        $db->editProduct($product_id, $new_product_image, $new_product_naam, $new_product_beschrijving);

        header("Location: home.php");
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];

    $productDetails = $db->selectProducten($product_id);

    if ($productDetails !== null && !empty($productDetails)) {
        $product_image = $productDetails[0]['image'];
        $product_naam = $productDetails[0]['naam'];
        $product_beschrijving = $productDetails[0]['beschrijving'];
    } else {
        echo "Product not found";
        exit;
    }
} else {
    echo "Product ID not provided";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit.css">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

        <label for="new_product_image">Current Product Image:</label>
        <img src="uploads/<?php echo $product_image; ?>" alt="Current Product Image" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
        <input type="file" name="new_product_image" required>

        
        <label for="new_product_naam">New Product Naam:</label>
        <input type="text" name="new_product_naam" value="<?php echo $product_naam; ?>" required>
        
        <label for="new_product_beschrijving">New Product Beschrijving:</label>
        <input type="text" name="new_product_beschrijving" value="<?php echo $product_beschrijving; ?>" required>
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
