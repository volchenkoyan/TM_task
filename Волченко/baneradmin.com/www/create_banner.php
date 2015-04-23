<?php
include("class_Banner.php");
include("connect.php");
/**
*Form for creating banner
*/
?>
<html>
	<body>
		<a href='main.php'>Вернуться назад</a>
		<form action="create_banner.php" method=POST>
		<h1>Создание банера</h1>
			<table>
				<tr>
					<td>Имя банера</td>
					<td><input type="text" name="banner_name" size="40">
				</tr>
				<tr>
					<td>Путь к файлу</td>
					<td><input type="text" name="image_path" size="40">
				</tr>
				<tr>
					<td>Ширина</td>
					<td><input type="text" name="height" size="40">
				</tr>
				<tr>
					<td>Высота</td>
					<td><input type="text" name="width" size="40">
				</tr>
				<tr>
					<td>Страницы для отображения</td>
					<td><textarea rows="10" cols="42" name="link"></textarea>
				</tr>
				<tr>
					<td>Ссылка</td>
					<td><input type="text" name="target_page" size="40">
				</tr>
				<tr>
					<td><input type="submit" value="Создать" name="create"></td>
				</tr>
		</form>
	</body>
</html>

<?php
/**
* Creating banner using data from form 
*/
if(isset($_POST['create']))
{
	$name = $_POST['banner_name'];
	$image_path = $_POST['image_path'];
	$height = $_POST['height'];
	$width = $_POST['width'];
	$link = $_POST['link'];
	$target_page =$_POST['target_page'];
	$ban = new Banner();
	$ban->createBanner($name, $image_path, $height, $width, $link, $target_page);
}
?>