<?php
require_once '../classes/Database.php';
require_once '../classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->connect();
    $product = new Product($db);

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if ($product->add($product_name, $price, $quantity)) {
        header('Location: ../views/dashboard.php?message=product_added');
        exit();
    } else {
        header('Location: ../views/add-product.php?error=failed_to_add');
        exit();
    }
}
?>
