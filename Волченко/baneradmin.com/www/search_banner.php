<?php
include("connect.php");
include("class_Banner.php");
?>
<html>
	<body>
		<a href='main.php'>Вернуться назад</a>
		<form action = "search_banner.php" method=POST>
			Имя банера <input type=text name='name' size=20><br>
			<input type=submit name="search" value="Найти">
		</form>
	</body>
</html>
<?php
	if(isset($_POST['search']))
	{
		$name = $_POST['name'];
		$ban = new Banner();
		$ban->searchBannerByName($name);
	}
?>