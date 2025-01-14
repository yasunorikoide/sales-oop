<?php
require_once '../classes/Database.php';
require_once '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // パスワード確認
    if ($password !== $confirm_password) {
        header('Location: ../views/register.php?error=password_mismatch');
        exit();
    }

    // データベース接続とユーザー登録
    $database = new Database();
    $db = $database->connect();
    $user = new User($db);

    // 登録処理
    if ($user->register($first_name, $last_name, $username, $password)) {
        header('Location: ../views/index.php?message=registration_success');
        exit();
    } else {
        header('Location: ../views/register.php?error=registration_failed');
        exit();
    }
}
?>
