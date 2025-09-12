<?php
session_start();
require 'config.php';  // Connect to DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Fetch user from DB
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Correct password
        $_SESSION['user'] = $user['email'];
        header('Location: dashboard.php');
        exit;
    } else {
        // Invalid login
        echo 'Invalid email or password.';
    }
} else {
    header('Location: login.php');
    exit;
}
?>
