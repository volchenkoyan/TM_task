<?php
/**
* Database connection
*/
$mysqli = mysqli_connect("baneradmin.com","root","","banner");
if(mysqli_connect_errno())
{
	echo "Не удалось подключиться к БД";
}
//$mysqli->select_db("banner");

/**
* Creates table 'banners' if it nit exists
*/
$create_banner_table = mysqli_query($mysqli, "CREATE TABLE IF NOT EXISTS banner
			(id int(4) NOT NULL AUTO_INCREMENT,
			name text NOT NULL,
			path text NOT NULL,
			height int(4) NOT NULL,
			width int(4) NOT NULL,
			link text NOT NULL,
			target_page text NOT NULL,
			creation_date date NOT NULL,
			visible bool NOT NULL,
			PRIMARY KEY(`id`)
			)");

?>