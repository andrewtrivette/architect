<?php
class imageEdit {
	
	function scale_crop($width, $height, $img, $name, $path) {
		$image = imagecreatefromjpeg($img);
		list($width_orig, $height_orig) = getimagesize($img);
		$ratio_orig = $width_orig/$height_orig;
	
		$ratio = $width/$height;
		
		
		$image_new = imagecreatetruecolor($width, $height);
		$alt_height = $width/$ratio_orig;
		$alt_width = $height*$ratio_orig;
	
		if ($ratio_orig <= $ratio) {
			$crop = 0-(round(($alt_height - $height)/2));
			imagecopyresampled($image_new, $image, 0, $crop, 0, 0, $width, $alt_height, $width_orig, $height_orig);
		} else {
			$crop = 0-(round(($alt_width - $width)/2));
			imagecopyresampled($image_new, $image, $crop, 0, 0, 0, $alt_width, $height, $width_orig, $height_orig);
		}
		imagejpeg($image_new, $path.$name, 85);
		imagedestroy($image_new);
	}
	
	function scale($maxwidth, $maxheight, $img, $name, $path) {
		$image = imagecreatefromjpeg($img);
		list($width_orig, $height_orig) = getimagesize($img);
		$ratio_orig = $width_orig/$height_orig;
		$alt_height = $maxwidth/$ratio_orig;
		$alt_width = $maxheight*$ratio_orig;
		if ($ratio_orig >= 1) {
			$image_new = imagecreatetruecolor($maxwidth, $alt_height);
			imagecopyresampled($image_new, $image, 0, 0, 0, 0, $maxwidth, $alt_height, $width_orig, $height_orig);
		} else {
			$image_new = imagecreatetruecolor($alt_width, $maxheight);
			imagecopyresampled($image_new, $image, 0, 0, 0, 0, $alt_width, $maxheight, $width_orig, $height_orig);
		}
		imagejpeg($image_new, $path.$name, 85);
		imagedestroy($image_new);
	}

	function image_upload($img, $temp_img) {
	global $user;
	//$s3 = new S3('id', 'secret key');

	if (getimagesize($temp_img)) {
		self::scale(600, 600, $temp_img, basename($img), '../images/'.$user[0]->site[0]['url'].'/large/');
		self::scale(400, 400, $temp_img, basename($img), '../images/'.$user[0]->site[0]['url'].'/medium/');
		self::scale(200, 200, $temp_img, basename($img), '../images/'.$user[0]->site[0]['url'].'/small/');
		/*if(!$s3->putObjectFile($temp_name, 'titanium-sites'.$user[0]->site[0]['url'], $filename, S3::ACL_PUBLIC_READ)) {
			$s3->putObjectFile($temp_name, 'titanium-sites'.$user[0]->site[0]['url'], $filename, S3::ACL_PUBLIC_READ);
		}*/
	}
	}             
}
?>