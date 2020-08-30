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

	public function password_forget_page()
	{
		$user_check = get_check_user();
		if($user_check == true)
		{
			redirect(base_url("dashboard"));
		}

		$this->load->view("back/pages/login/password_forget");
	}

	public function reset_password()
	{
		$user_email = $this->input->post("email");

		$data = array(
			"isActive"	=>	1,
			"email"		=>	$user_email
		);

		$user = $this->general_model->get_where("users", $data);

		$this->load->helper("string");
		$temp_password = random_string();

		$email = $this->general_model->get_where("email_settings", ["isActive" => 1]);

		$config = array(
			"protocol"	=>	$email->protocol,
			"smtp_host"	=>	$email->host,
			"smtp_port"	=>	$email->port,
			"smtp_user"	=>	$email->user,
			"smtp_pass"	=>	$email->password,
			"starttls"	=>	true,
			"charset"	=>	"utf-8",
			"mail_type"	=>	"html",
			"word_wrap"	=> 	true,
			"newline"	=>	"\r\n"
		);

		$this->load->library("email", $config);

		$this->email->from($email->from, $email->user_name);
		$this->email->to($user->email);
		$this->email->subject("CMS için Email Çalışmaları");
		$this->email->message("CMS'e geçici olarak <b>{$temp_password}</b> şifresiyle giriş yapabilirsiniz.");

		$send = $this->email->send();

		if($send)
		{
			$this->general_model->update("users", ["id" => $user->id], ["password" => md5($temp_password)]);

			$alert = array(
				"title"	=>	"İşlem Başarılı!",
				"text"	=>	"Şifre sıfırlama postanız gönderildi.",
				"type"	=>	"success"
			);
			$this->session->set_flashdata("alert", $alert);
			redirect(base_url("login"));
		}
		else
		{
			$alert = array(
				"title"	=>	"İşlem Başarısız!",
				"text"	=>	"Böyle bir e-posta bulunmamaktadır.",
				"type"	=>	"danger"
			);
			$this->session->set_flashdata("alert", $alert);
			redirect(base_url("password-forget"));
		}
	}

	public function send_email()
	{
		$config = array(
			"protocol"	=>	"smtp",
			"smtp_host"	=>	"ssl://smtp.gmail.com",
			"smtp_port"	=>	"465",
			"smtp_user"	=>	"m.berataras@gmail.com",
			"smtp_pass"	=>	"1212berat",
			"starttls"	=>	true,
			"charset"	=>	"utf-8",
			"mail_type"	=>	"html",
			"word_wrap"	=> 	true,
			"newline"	=>	"\r\n"
		);

		$this->load->library("email", $config);

		$this->email->from("m.berataras@gmail.com", "CMS");
		$this->email->to("berat.aras@hotmail.com");
		$this->email->subject("CMS için Email Çalışmaları");
		$this->email->message("nabıyın len");

		$send = $this->email->send();

		if($send)
		{
			echo "okey";
		}
		else{
			echo $this->email->print_debugger();
		}
	}


}
