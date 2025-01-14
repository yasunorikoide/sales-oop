<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // ログイン処理
    public function login($username, $password) {
        $sql = "SELECT * FROM Users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // 登録処理
    public function register($first_name, $last_name, $username, $password) {
        // ユーザー名がすでに存在するか確認
        $sql = "SELECT * FROM Users WHERE username = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return false; // ユーザー名が既に存在
        }

        // パスワードをハッシュ化して保存
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO Users (first_name, last_name, username, password) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $first_name, $last_name, $username, $hashed_password);

        return $stmt->execute();
    }
}
?>
