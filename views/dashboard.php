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

$products = $product->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="dashboard.php" class="navbar-brand"><i class="fas fa-home"></i></a>
            <span class="navbar-text text-white">Welcome, <?= htmlspecialchars($_SESSION['username']) ?></span>
            <a href="../actions/logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </nav>
    <div class="container mt-4">
        <h2 class="text-center">Product List</h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="add-product.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
            <a href="add-product.php" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>

        </div>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($products->num_rows > 0): ?>
                    <?php while ($row = $products->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['product_name']) ?></td>
                            <td>$<?= $row['price'] ?></td>
                            <td><?= $row['quantity'] ?></td>
                            <td>
                                <a href="edit-product.php?id=<?= $row['id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="../actions/delete-product.php?id=<?= $row['id'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-danger">No Records Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
