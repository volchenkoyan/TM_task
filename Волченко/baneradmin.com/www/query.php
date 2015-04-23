<?php
/**
* Cuts link for curent page
*/
function cutPage($link)
{
	$temp_mas = explode("/",$link);
	$last_part = array_pop($temp_mas);
	return $last_part;
}
?>