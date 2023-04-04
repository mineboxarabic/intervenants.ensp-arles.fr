<?php
function retconfirm ($text) {
	return '' . 'onclick="return confirm(\'' . $text . '\')"';
}

setlocale(LC_ALL, 'en_US.UTF8');
function just_clean($str, $replace=array(), $delimiter='-') {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = str_replace("_", '-', $str);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $clean);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}

function createThumb($source,$dest) {
	$new_width = thumbnail_size;
	$new_height = thumbnail_size;
	$size = getimagesize($source);
	$width = $size[0];
	$height = $size[1];

	if($width > $height) {
		$x = ceil(($width - $height) / 2 );
		$width = $height;
	} elseif($height > $width) {
		$y = ceil(($height - $width) / 2);
		$height = $width;
	}
	$new_im = imagecreatetruecolor($new_width,$new_height);

	$extention = strtolower(substr($source, strlen($source)-3, strlen($source)));
	if ($extention == "jpg" || $extention == "jpeg") { $im = imagecreatefromjpeg($source); }
	elseif ($extention == "gif") { $im = imagecreatefromgif($source); }
	elseif ($extention == "png") { $im = imagecreatefrompng($source); }
	else { echo("ERROR: Unknown image source file format"); }

	imagecopyresampled($new_im,$im,0,0,$x,$y,$new_width,$new_height,$width,$height);
	imagejpeg($new_im,$dest,85);
}

function reload ($time, $url) {
	echo '' . '<meta http-equiv="REFRESH" content="' . $time . ';url=' . $url . '">';
}

function get_extension ($file) {
	$exte = explode(".", $file);
	$esay = count($exte)-1;
	$ext = strtolower($exte[$esay]);
			
	$pdf = "[pdf]";
   	$swf = "[swf]";
	$txt = "[txt]";
   	$word = "[doc][docx][rtf]";
   	$excel = "[xls][xlsx][xlsm][xlt]";
   	$vid = "[mpeg][flv][mov][avi]";
   	$pic = "[jpg][jpeg][png][gif]";
	$psd = "[psd]";
	$html = "[html]";
	$xml = "[xml]";
	$js = "[js]";
	$css = "[css]";
	$eps = "[eps]";
	$svg = "[svg]";
   	$zip = "[rar][ace][zip][tar][gz][tar.gz]";
	if (preg_match("[".$ext."]", $word)) { 
		$extension = "doc";
	} elseif (preg_match("[".$ext."]", $swf)) { 
		$extension = "swf";
	} elseif (preg_match("[".$ext."]", $pdf)) { 
		$extension = "pdf";
	} elseif (preg_match("[".$ext."]", $excel)) { 
		$extension = "xls";
	} elseif (preg_match("[".$ext."]", $vid)) { 
		$extension = "vid";
	} elseif (preg_match("[".$ext."]", $xml)) { 
		$extension = "xml";
	} elseif (preg_match("[".$ext."]", $pic)) { 
		$extension = "pic";
	} elseif (preg_match("[".$ext."]", $zip)) { 
		$extension = "zip";
	} elseif (preg_match("[".$ext."]", $psd)) { 
		$extension = "psd";
	} elseif (preg_match("[".$ext."]", $svg)) { 
		$extension = "svg";
	} elseif (preg_match("[".$ext."]", $eps)) { 
		$extension = "eps";
	} elseif (preg_match("[".$ext."]", $txt)) { 
		$nexte = explode(".", str_replace(".".$ext,"",$file));
		$nesay = count($nexte)-1;
		$next = strtolower($exte[$nesay]);
		if (preg_match("[".$next."]", $html)) {
			$extension = "html";
		} elseif (preg_match("[".$next."]", $css)) {
			$extension = "css";
		} elseif (preg_match("[".$next."]", $xml)) {
			$extension = "xml";
		} elseif (preg_match("[".$next."]", $js)) {
			$extension = "js";
		} else {
			$extension = "txt";
		}
	} else {
		$extension = "oth";
	}
	return $extension;
}

function remove_dir($current_dir) {
	if($dir = @opendir($current_dir)) {
		while (($f = readdir($dir)) !== false) {
			if($f > '0' and filetype($current_dir.$f) == "file") {
				unlink($current_dir.$f);
			} elseif($f > '0' and filetype($current_dir.$f) == "dir") {
				remove_dir($current_dir.$f."\\");
			}
		}
		closedir($dir);
		rmdir($current_dir);
	}
}
?>