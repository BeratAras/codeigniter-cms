<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		$user_check = get_check_user();

		if($user_check == false)
		{
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$this->load->view('back/dashboard');
	}
}
