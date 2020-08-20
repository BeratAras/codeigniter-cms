<?php 

function strToUrl( $str ) {
	$turkish = array("ı", "ğ", "ü", "ş", "ö", "ç", "İ", "Ğ", "Ü", "Ş", "Ö", "Ç");
	$english = array("i", "g", "u", "s", "o", "c", "I", "G", "U", "S", "O", "C");

	$str = str_replace($turkish, $english, $str);

	return url_title( $str, "-", true );
}

?>