<?php
$title = "View Room Details";
ob_start();
require "header.php";
?>

<?php
$content = ob_get_clean();
include "layout.php";
?>