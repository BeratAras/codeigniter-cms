<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	public function index()
	{
		$user_check = get_check_user();

		if($user_check == true)
		{
			redirect(base_url("dashboard"));
		}

		$data = new stdClass();
		$data->users = $this->general_model->get_all('users');
		$this->load->view('back/pages/login/login', $data);
	}

	public function login()
	{
		$this->load->library("form_validation");

		$this->form_validation->set_rules("username", "Kullanıcı Adı", "required|trim");
		// $this->form_validation->set_rules("password", "Kullanıcı Adı", "required|trim|min_length[6]");

		$this->form_validation->set_message(
			[
				"required" => "<b>{field}</b> alanı doldurulmadılır.",
				"min_length" => "Şifre en az 6 karakterden oluşmalıdır.",
			]
		);

		$validate = $this->form_validation->run();
		
		if($validate)
		{
			$username = $this->input->post("username");
			$password =	$this->input->post("password");

			$user = $this->general_model->get_where("users", ["user_name" => $username, "password" => md5($password), "isActive" => 1]);

			if($user)
			{
				$this->session->set_userdata("user", $user);
				redirect(base_url("dashboard"));
			}
			else
			{
				$alert = array(
					"title"	=>	"İşlem Başarısız!",
					"text"	=>	"Böyle bir kullanıcı yok veya hesabınız donduruldu.",
					"type"	=>	"danger"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("login"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/login/login', $data);
		}
	}

	public function logout()
	{
		$this->session->unset_userdata("user");
		redirect(base_url("login"));
	}


}
