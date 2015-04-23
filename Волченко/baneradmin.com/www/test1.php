<?php
/**
* Test page for showing banners
*/
include("connect.php");
include("class_Banner.php");
include("query.php");

$current_page = cutPage($_SERVER['REQUEST_URI']);

echo "<html>";
echo "<body>";
$ban = new Banner();
$ban->showThatBanner($current_page);
echo "</body>";
echo "</html>";
?>