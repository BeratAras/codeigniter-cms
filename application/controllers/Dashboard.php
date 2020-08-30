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
		$this->load->model('general_model');
	}

	public function index()
	{
		$data = new stdClass();
		$data->settings = $this->general_model->get_where('settings', ["id" => 1]);
		$this->load->view('back/dashboard', $data);
	}
}
