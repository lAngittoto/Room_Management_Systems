<?php 
$title = "Rooms";
ob_start();
require_once 'header.php';
require_once 'filter.php';
?>

<h1 class=" text-4xl p-10">First Floor</h1>

<section class=" p-10">
<?php 
require_once 'Floors/firstfloor.php'
?>
</section>

<?php
$content = ob_get_clean();
include "layout.php";
?>