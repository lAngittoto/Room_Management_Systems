<?php 
$title = "My Bookings";
ob_start();
require_once 'header.php';
?>
<h1>
    Current room
</h1>

<?php
$content = ob_get_clean();
include "layout.php";
?>