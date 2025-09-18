<?php 
$title = "My Bookings";
ob_start();
require_once 'header.php';
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}
?>

<h1>
    Current room
</h1>

<?php
$content = ob_get_clean();
include "layout.php";
?>