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
    require_once __DIR__.'/../Floors/firstfloor.php';
    ?>
</section>

<h1 class=" text-4xl p-10">Second Floor</h1>

<section class=" p-10 w-screen grid grid-cols-3 gap-10 items-stretch">
    <?php
    require_once __DIR__.'/../Floors/secondfloor.php';
    ?>
</section>

<h1 class=" text-4xl p-10">Third Floor</h1>

<section class=" p-10 w-screen grid grid-cols-3 gap-10 items-stretch">
    <?php
    require_once __DIR__.'/../Floors/thirdfloor.php';
    ?>
</section>

<?php
$content = ob_get_clean();
include "layout.php";
?>
