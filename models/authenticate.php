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

if ($user && $password === $user['password']) {
    $_SESSION['user'] = $user; // buong user data i-save sa session
    
    if ($user['role'] === 'admin') {
        header('Location: index.php?page=dashboard'); // admin dashboard
    } else {
        header('Location: index.php?page=rooms'); // normal user
    }
    exit;
} else {
    $_SESSION['error'] = "Invalid email or password";
    header('Location: index.php?page=login');
    exit;
}

} else {
    header('Location: index.php?page=login');
    exit;
}
