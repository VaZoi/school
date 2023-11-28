<?php
include("db.php");
$db = new Database;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST["product_id"];
    $new_product_naam = $_POST["new_product_naam"];
    $new_product_beschrijving = $_POST["new_product_beschrijving"];

    $db->editProduct($product_id, $new_product_naam, $new_product_beschrijving);

    header("Location: home.php");
    exit;
}

if (isset($_GET["id"])) {
    $product_id = $_GET["id"];

    $productDetails = $db->selectProducten($product_id);

    if ($productDetails !== null && !empty($productDetails)) {
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
    <form method="post" action="">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        
        <label for="new_product_naam">New Product Naam:</label>
        <input type="text" name="new_product_naam" value="<?php echo $product_naam; ?>" required>
        
        <label for="new_product_beschrijving">New Product Beschrijving:</label>
        <input type="text" name="new_product_beschrijving" value="<?php echo $product_beschrijving; ?>" required>
        
        <button type="submit">Save Changes</button>
    </form>
</body>
</html>
