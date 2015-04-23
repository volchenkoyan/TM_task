<?php
include("connect.php");
include("class_Banner.php");
include("query.php");
/**
* Buuton which load form for creating banner
*/
?>
<html>
	<body>
		<form action="create_banner.php">
			<input type="submit" name="create_button" value="Создать банер">
		</form>
		<form action="search_banner.php">
			<input type="submit" name="search_banner" value="Найти">
		</form>
	</body>
</html>
<?php
/**
* Show all banners
*/
$ban = new Banner();
$ban->showBanner();	

if(isset($_POST['search_banner']))
{
	$bann = new Banner();
	$bann->searchBanner($_POST['name']);
}		
?>