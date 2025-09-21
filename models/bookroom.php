<?php
session_start();
require_once __DIR__ . "/../models/db.php";

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$userEmail = $_SESSION['user']['email'];
$roomId = $_POST['room_id'] ?? null;

if (!$roomId) {
    $_SESSION['error'] = "Invalid request.";
    header('Location: index.php?page=rooms');
    exit;
}

// ✅ Check if room is still Available
$stmt = $pdo->prepare("SELECT status FROM rooms WHERE id = ?");
$stmt->execute([$roomId]);
$room = $stmt->fetch();

if (!$room || $room['status'] !== 'Available') {
    $_SESSION['error'] = "This room is not available for booking.";
    header('Location: index.php?page=rooms');
    exit;
}

// ✅ Insert booking
$stmt = $pdo->prepare("INSERT INTO bookings (user_email, room_id) VALUES (?, ?)");
$stmt->execute([$userEmail, $roomId]);

// ✅ Update room status to Booked
$stmt = $pdo->prepare("UPDATE rooms SET status='Booked' WHERE id = ?");
$stmt->execute([$roomId]);

$_SESSION['success'] = "Room booked successfully!";
header('Location: index.php?page=mybookings');
exit;
?>
