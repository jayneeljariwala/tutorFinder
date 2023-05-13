<?php
	session_start(); 
	$text = rand(10000,99999); 
	$_SESSION["code"] = $text; 
	$height = 35; 
	$width = 80;   
	
	$image_p = imagecreate($width, $height); 

	 
	$black = imagecolorallocate($image_p, 0, 0, 0); 

	 
	$white = imagecolorallocate($image_p, 255, 255, 255); 
	$font_size = 80; 

	
	imagestring($image_p, $font_size, 17, 10, $text, $white); 

	
	imagejpeg($image_p);
?>