<?php
require_once '../classes/Database.php';
require_once '../classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $database = new Database();
    $db = $database->connect();
    $product = new Product($db);

    $id = $_GET['id'];

    if ($product->delete($id)) {
        header('Location: ../views/dashboard.php?message=product_deleted');
        exit();
    } else {
        header('Location: ../views/dashboard.php?error=failed_to_delete');
        exit();
    }
}
?>
