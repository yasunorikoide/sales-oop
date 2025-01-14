<?php
session_start();
require_once '../classes/Database.php';
require_once '../classes/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loggedInUser = $user->login($username, $password);

    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['id'];
        $_SESSION['username'] = $loggedInUser['username'];
        header("Location: ../views/dashboard.php");
        exit();
    } else {
        header("Location: ../views/index.php?error=invalid_credentials");
        exit();
    }
}
?>
