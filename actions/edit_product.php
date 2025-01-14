<?php
require_once '../classes/Database.php';
require_once '../classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->connect();
    $product = new Product($db);

    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if ($product->update($id, $product_name, $price, $quantity)) {
        header('Location: ../views/dashboard.php?message=product_updated');
        exit();
    } else {
        header('Location: ../views/edit-product.php?id=' . $id . '&error=failed_to_update');
        exit();
    }
}
?>
