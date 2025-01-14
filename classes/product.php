<?php
class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM Products";
        return $this->conn->query($sql);
    }

    public function add($product_name, $price, $quantity) {
        $sql = "INSERT INTO Products (product_name, price, quantity) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdi", $product_name, $price, $quantity);
        return $stmt->execute();
    }
}
?>
