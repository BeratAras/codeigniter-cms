<?php 

function strToUrl( $str ) {
	$turkish = array("ı", "ğ", "ü", "ş", "ö", "ç", "İ", "Ğ", "Ü", "Ş", "Ö", "Ç");
	$english = array("i", "g", "u", "s", "o", "c", "I", "G", "U", "S", "O", "C");

	$str = str_replace($turkish, $english, $str);

	return url_title( $str, "-", true );
}

function get_check_user()
{
	$t = &get_instance();

	$user = $t->session->userdata("user");

	if($user)
	{
		return $user;
	}
	else
	{
		return false;
	}
}

function get_settings()
{
	$t = &get_instance();
	$t->load->model('general_model');
	$settings = $t->general_model->get_where("settings", ["id" => 1]);
	return $settings;
}


?>