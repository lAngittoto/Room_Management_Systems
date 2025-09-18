<?php 
$title = "Rooms";
ob_start();
require_once 'header.php';
require_once 'filter.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}
?>

<h1 class="text-4xl p-10">First Floor</h1>

<!-- 🔥 FIXED: ginawang grid para equal height -->
<section class="p-10 w-screen grid grid-cols-3 gap-10 items-stretch">
    <?php 
    require_once 'Floors/firstfloor.php';
    ?>
</section>

<?php
$content = ob_get_clean();
include "layout.php";
?>
