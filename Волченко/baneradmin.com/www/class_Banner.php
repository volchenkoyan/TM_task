<?php
include('connect.php');
class Banner
{
	/**
	* Inserts banner's data into database
	*/
	function createBanner($name, $image_path, $height, $width, $link, $target_page)
	{
		global $mysqli;
		$now = date("y.m.d");
		if(mysqli_query($mysqli,"INSERT INTO banner (name, path, height, width, link, target_page, creation_date) VALUES
		('$name', '$image_path', $height, $width, '$link', '$target_page', '$now')") === TRUE)
		{
			echo "Вставлено успешно";
		}
		else
		{
			echo "Ошибка";
		}
	}
	
	/**
	* Updates information about banner
	*/
	
	function updateBanner($name, $image_path, $height, $width, $link, $target_page, $index, $visible)
	{
		global $mysqli;
		$now = date("y.m.d");
		
		$query = "UPDATE banner SET name = '$name', path = '$image_path',
		height = $height, width = $width, link = '$link', target_page = '$target_page', creation_date = '$now', visible = $visible WHERE id = $index";
		if(mysqli_query($mysqli,$query) === TRUE)
		{
			echo "Обновлено успешно";
			
		}
		else
		{
		  echo "Ошибка";
		}
		
	}
	
	/**
	* Selectes banner with some name
	*/
	function searchBannerByName($name)
	{
		global $mysqli;
		$query = "SELECT * FROM banner WHERE name LIKE '%$name%'";
		if($result = mysqli_query($mysqli, $query))
		{
			echo "<table border=1>";
			echo "<tr><td>id</td><td>Имя</td><td>Изображение</td><td>Высота</td><td>Ширина</td><td>Страницы для отображения</td><td>Ссылка</td><td>Дата создания</td><td></td><td></td><td>Видимость</td></tr>";
			while( $row = mysqli_fetch_assoc($result))
			{ 
				echo "<tr>";
				$temp = $row['id'];
				echo "<td>".$row['id']."</td>";
				echo "<td>".$row['name']."</td>";
				echo "<td><img src = '".$row['path']."' width = '".$row['width']."' height = '".$row['height']."'></td>";
				echo "<td>".$row['height']."</td>";
				echo "<td>".$row['width']."</td>";
				echo "<td>".$row['link']."</td>";
				echo "<td>".$row['target_page']."</td>";
				echo "<td>".$row['creation_date']."</td>";
				echo "<td><input type='submit' value='Редактировать' name='but_".$temp."'></td>";
				echo "<td><input type='submit' value='Удалить' name='del_".$temp."'></td>";
				if($row['visible']==1)
				{
					echo "<td><input type='checkbox' name='visible_".$temp."' checked disabled readonly></td>";
				}
				else
				{
					echo "<td><input type='checkbox' name='visible_".$temp."' disabled readonly></td>";
				}
				echo "</tr>";
			
			} 
				echo "</table>";
		}
		else
		{
			echo "Баннер с таким именем не найден";
		}
	}
	
	
	/**
	* Shows all banners at some page
	*/
	
	function showThatBanner($link)
	{
		global $mysqli;
		$query = "SELECT id, path, width, height, target_page FROM banner WHERE link LIKE '%$link%' and visible='1'";
		$result = mysqli_query($mysqli, $query);
		$ids = array();
		while( $row = mysqli_fetch_assoc($result))
		 { 			
			array_push($ids,$row['id']);			
		 }

		 $random_id = array_rand($ids);
		 $select = "SELECT path, width, height, target_page FROM banner WHERE link LIKE '%$link%' and visible='1' and id=$ids[$random_id]";
		 $res = mysqli_query($mysqli, $select);
		 while( $row = mysqli_fetch_assoc($res))
		 { 			
			echo "<a href='".$row['target_page']."' target=_blank><img src='".$row['path']."' 
			border='0' title='Текст' width='".$row['width']."' 
			height='".$row['height']."'></a><br>";			
		 }
		 
	}
	
	/**
	* Shows all banners on one page
	*/
	function showBanner()
	{
		global $mysqli;
		if($result = mysqli_query($mysqli, "SELECT * FROM banner"))
		{
			echo "<h2>Банеры</h2>";
		}
		echo "<form action='main.php' method=POST>";
		echo "<table border=1>";
		echo "<tr><td>id</td><td>Имя</td><td>Изображение</td><td>Высота</td><td>Ширина</td><td>Страницы для отображения</td><td>Ссылка</td><td>Дата создания</td><td></td><td></td><td>Видимость</td></tr>";
		 while( $row = mysqli_fetch_assoc($result))
		 { 
			echo "<tr>";
			$temp = $row['id'];
			echo "<td>".$row['id']."</td>";
			echo "<td>".$row['name']."</td>";
			echo "<td><img src = '".$row['path']."' width = '".$row['width']."' height = '".$row['height']."'></td>";
			echo "<td>".$row['height']."</td>";
			echo "<td>".$row['width']."</td>";
			echo "<td>".$row['link']."</td>";
			echo "<td>".$row['target_page']."</td>";
			echo "<td>".$row['creation_date']."</td>";
			echo "<td><input type='submit' value='Редактировать' name='but_".$temp."'></td>";
			echo "<td><input type='submit' value='Удалить' name='del_".$temp."'></td>";
			if($row['visible']==1)
			{
				echo "<td><input type='checkbox' name='visible_".$temp."' checked disabled readonly></td>";
			}
			else
			{
				echo "<td><input type='checkbox' name='visible_".$temp."' disabled readonly></td>";
			}
			echo "</tr>";
			
		 } 
		 echo "</table>";
		 echo "</form>";
		 
		 for($index=0; $index<100; $index++)
		 {	
			$i = $index;
			global $i;
			
			//If button 'Change' pressed - load the form to update it
			if(isset($_POST["but_$index"]))
			{
				 $result = mysqli_query($mysqli, "SELECT * FROM banner WHERE id = $index");
				  while( $row = mysqli_fetch_assoc($result))
					{ 
						echo "<form action= 'main.php' method = POST>";
						echo"<h1>Обновление банера</h1>
						<table>
							<input type='text' name='index' value=$i hidden>
							<tr>
								<td>Имя банера</td>
								<td><input type='text' name='banner_name' value = '".$row['name']."' size='40'>
							</tr>
							<tr>
								<td>Путь к файлу</td>
								<td><input type='text' name='image_path' value = '".$row['path']."' size='40'>
							</tr>
							<tr>
								<td>Ширина</td>
								<td><input type='text' name='height' value = '".$row['height']."' size='40'>
							</tr>
							<tr>
								<td>Высота</td>
								<td><input type='text' name='width' value = '".$row['width']."' size='40'>
							</tr>
							<tr>
								<td>Страницы для отображения</td>
								<td><textarea rows='10' cols='42' name='link'>".$row['link']."</textarea>
							</tr>
							<tr>
								<td>Ссылка</td>
								<td><input type='text' name='target_page' value = '".$row['target_page']."' size='40'>
							</tr>
							<tr>
								<td>Видимость банера</td>";
								if($row['visible']==1)
								{
									echo "<td><input type='checkbox' name='visible' checked></td>";
									
								}
								else
								{
									echo "<td><input type='checkbox' name='visible'></td>";
								}								
							echo "</tr>

							<tr>
								<td><input type='submit' value='Обновить' name='update'></td>
							</tr>
						</table>";
						echo "</form>";
						
						
					} 
			}
			
			/**
			* Deletes banner
			*/
			if(isset($_POST["del_$index"]))
			{
				$delete = mysqli_query($mysqli, "DELETE FROM banner WHERE id = $index");
			}
			
		 }
						/**
						* Updates information about banner if buttob 'update' pressed
						*/
						if(isset($_POST['update']))
						{	
							$name = $_POST['banner_name'];
							$image_path = $_POST['image_path'];
							$height = $_POST['height'];
							$width = $_POST['width'];
							$link = $_POST['link'];
							$index = $_POST['index'];
							$target_page = $_POST['target_page'];
							if(isset($_POST['visible']))
							{
								$visible=1;
							}
							else
							{
								$visible=0;
							}
							$ban = new Banner();
							$ban -> updateBanner($name, $image_path, $height, $width, $link, $target_page, $index, $visible);
						}
						
						
						
						
		
		 		
	}

}
?>