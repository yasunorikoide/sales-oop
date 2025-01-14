<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once '../classes/Database.php';
require_once '../classes/Product.php';

$database = new Database();
$db = $database->connect();
$product = new Product($db);

$id = $_GET['id'];
$currentProduct = $product->getById($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-warning"><i class="fas fa-edit"></i> Edit Product</h2>
        <form method="POST" action="../actions/edit-product.php" class="mt-4">
            <input type="hidden" name="id" value="<?= $currentProduct['id'] ?>">
            <div class="mb-3">
                <label for="product_name" class="form-label">Product Name</label>
                <input type="text" id="product_name" name="product_name" class="form-control" value="<?= $currentProduct['product_name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" id="price" name="price" step="0.01" class="form-control" value="<?= $currentProduct['price'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="number" id="quantity" name="quantity" class="form-control" value="<?= $currentProduct['quantity'] ?>" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Save Changes</button>
            <a href="dashboard.php" class="btn btn-secondary w-100 mt-3">Back to Dashboard</a>
        </form>
    </div>
</body>
</html>
