<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	public function index()
	{
		$data = new stdClass();
		$data->email_settings = $this->general_model->get_all('email_settings');
		$this->load->view('back/pages/email_settings/email_settings_view', $data);
	}

	public function add_page()
	{
		$this->load->view('back/pages/email_settings/email_settings_add');
	}

	public function add()
	{
        $this->load->library('form_validation');

		$this->form_validation->set_rules("protocol", "Protokol", "required|trim");
		$this->form_validation->set_rules("host", "Host", "required|trim");
		$this->form_validation->set_rules("port", "Port", "required|trim");
		$this->form_validation->set_rules("user", "Gönderen", "required|trim");
		$this->form_validation->set_rules("password", "Şifre", "required|trim");
		$this->form_validation->set_rules("from", "Kimden", "required|trim");
		$this->form_validation->set_rules("to", "Kime", "required|trim");
		$this->form_validation->set_rules("user_name", "Gönderim Adı", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);
		$validate = $this->form_validation->run();

		if($validate)
		{
			$protocol 			= $this->input->post('protocol');
			$host 				= $this->input->post('host');
			$port 				= $this->input->post('port');
			$user 				= $this->input->post('user');
			$password 			= $this->input->post('password');
			$from 				= $this->input->post('from');
			$to 				= $this->input->post('to');
			$userName 			= $this->input->post('user_name');


			$data = array(
				'protocol' 			=> $protocol,
				'host' 				=> $host,
				'port'				=> $port,
				'user'				=> $user,
				'password'			=> $password,
				'from'				=> $from,
				'to'				=> $to,
				'user_name'			=> $userName,
				'isActive'			=> 1,
			);

			$result = $this->general_model->add_all('email_settings', $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Kayıt başarılı bir şekilde eklendi!",
					"type"	=>	"success"
				);

				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("email"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/email_settings/email_settings_add', $data);
		}
	}

	public function update_page($id)
	{
		$data = new stdClass();
		$data->email_settings = $this->general_model->get_where('email_settings', ["id" => $id]);
		$this->load->view('back/pages/email_settings/email_settings_update', $data);
	}

	public function update($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("protocol", "Protokol", "required|trim");
		$this->form_validation->set_rules("host", "Host", "required|trim");
		$this->form_validation->set_rules("port", "Port", "required|trim");
		$this->form_validation->set_rules("user", "Gönderen", "required|trim");
		$this->form_validation->set_rules("password", "Şifre", "required|trim");
		$this->form_validation->set_rules("from", "Kimden", "required|trim");
		$this->form_validation->set_rules("to", "Kime", "required|trim");
		$this->form_validation->set_rules("user_name", "Gönderim Adı", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);

		$validate = $this->form_validation->run();

		if($validate)
		{
			$protocol 			= $this->input->post('protocol');
			$host 				= $this->input->post('host');
			$port 				= $this->input->post('port');
			$user 				= $this->input->post('user');
			$password 			= $this->input->post('password');
			$from 				= $this->input->post('from');
			$to 				= $this->input->post('to');
			$userName 			= $this->input->post('user_name');


			$data = array(
				'protocol' 			=> $protocol,
				'host' 				=> $host,
				'port'				=> $port,
				'user'				=> $user,
				'password'			=> $password,
				'from'				=> $from,
				'to'				=> $to,
				'user_name'			=> $userName
			);

			$result = $this->general_model->update('email_settings', ["id" => $id], $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Güncelleme başarılı bir şekilde yapıldı.",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("email"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/email_settings/email_settings_update', $data);
		}
	}

	public function delete($id, $table)
	{
		$result = $this->general_model->delete($table, ['id' => $id]);

		if($result)
		{
			if($table == "email_settings")
			{
				redirect(base_url('email'));
			}
			else if($table == "email_settings_images")
			{
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
		else
		{
			echo "update başarısız";
		}
	}

	public function isActiveSetter($id, $table)
	{
		$isActive = ($this->input->post("data") === "true") ? 1 : 0;
		
		$data = array(
			"isActive" => $isActive
		);

		$result = $this->general_model->update($table, ["id" => $id], $data);
	}

	public function isCoverSetter($imageID, $email_settingsID)
	{
		$isCover = ($this->input->post("data") === "true") ? 1 : 0;
		
		//Kapak yapılmak istenen kayıt
		$data = array(
			"isCover" => $isCover
		);
		$this->general_model->update("email_settings_images", ["id" => $imageID, "email_settings_id" => $email_settingsID], $data);

		//Kapak yapılmayan diğer kayıtlar.
		$data2 = array(
			"isCover" => 0
		);
		$this->general_model->update("email_settings_images", ["id !=" => $imageID, "email_settings_id" => $email_settingsID], $data2);

		$viewData = new stdClass();
		$viewData->item_images = $this->load->general_model->get_where('email_settings_images', ['email_settings_id' => $email_settingsID]);
		$render_html = $this->load->view('back/pages/email_settings/email_settings_image', $viewData);
		echo $render_html;
	}
}
