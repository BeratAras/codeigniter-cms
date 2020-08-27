<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	public function index()
	{
		$data = new stdClass();
		$data->users = $this->general_model->get_all('users');
		$this->load->view('back/pages/users/users_view', $data);
	}

	public function add_page()
	{
		$this->load->view('back/pages/users/users_add');
	}

	public function add()
	{
        $this->load->library('form_validation');

		$this->form_validation->set_rules("username", "Kullanıcı Adı", "required|trim");
		$this->form_validation->set_rules("name", "Ad", "required|trim");
		$this->form_validation->set_rules("surname", "Soyad", "required|trim");
		$this->form_validation->set_rules("email", "E-Posta", "required|trim");
		$this->form_validation->set_rules("password", "Şifre", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);
		$validate = $this->form_validation->run();

		if($validate)
		{
			$userName 		= $this->input->post('username');
			$name 			= $this->input->post('name');
			$surname 		= $this->input->post('surname');
			$email 			= $this->input->post('email');
			$password 		= $this->input->post('password');


			$data = array(
				'user_name' 		=> $userName,
				'name' 				=> $name,
				'surname'			=> $surname,
				'email'				=> $email,
				'password'			=> md5($password),
				'isActive'			=> 1,
				'createdAt'			=> date('Y-m-d H:i:s')
			);

			$result = $this->general_model->add_all('users', $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Kayıt başarılı bir şekilde eklendi!",
					"type"	=>	"success"
				);
			}

			//İşlemin sonucunu session'a yazar.
			$this->session->set_flashdata("alert", $alert);
			redirect(base_url("users"));
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/users/users_add', $data);
		}
	}

	public function update_page($id)
	{
		$data = new stdClass();
		$data->users = $this->general_model->get_where('users', ["id" => $id]);
		$this->load->view('back/pages/users/users_update', $data);
	}

	public function update($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("username", "Kullanıcı Adı", "required|trim");
		$this->form_validation->set_rules("name", "Ad", "required|trim");
		$this->form_validation->set_rules("surname", "Soyad", "required|trim");
		$this->form_validation->set_rules("email", "E-Posta", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);

		$validate = $this->form_validation->run();

		if($validate)
		{
			$userName 		= $this->input->post('username');
			$name 			= $this->input->post('name');
			$surname 		= $this->input->post('surname');
			$email 			= $this->input->post('email');
			$password 		= $this->input->post('password');

			if(empty($password))
			{
				$data = array(
					'user_name' 		=> $userName,
					'name' 				=> $name,
					'surname'			=> $surname,
					'email'				=> $email,
					'isActive'			=> 1,
					'createdAt'			=> date('Y-m-d H:i:s')
				);
			}
			else
			{
				$data = array(
					'user_name' 		=> $userName,
					'name' 				=> $name,
					'surname'			=> $surname,
					'email'				=> $email,
					'password'			=> md5($password),
					'isActive'			=> 1,
					'createdAt'			=> date('Y-m-d H:i:s')
				);
			}

			$result = $this->general_model->update('users', ["id" => $id], $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Güncelleme başarılı bir şekilde yapıldı.",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("users"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/users/users_update', $data);
		}
	}

	public function delete($id, $table)
	{
		$result = $this->general_model->delete($table, ['id' => $id]);

		if($result)
		{
			if($table == "users")
			{
				redirect(base_url('users'));
			}
			else if($table == "users_images")
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

	public function isCoverSetter($imageID, $usersID)
	{
		$isCover = ($this->input->post("data") === "true") ? 1 : 0;
		
		//Kapak yapılmak istenen kayıt
		$data = array(
			"isCover" => $isCover
		);
		$this->general_model->update("users_images", ["id" => $imageID, "users_id" => $usersID], $data);

		//Kapak yapılmayan diğer kayıtlar.
		$data2 = array(
			"isCover" => 0
		);
		$this->general_model->update("users_images", ["id !=" => $imageID, "users_id" => $usersID], $data2);

		$viewData = new stdClass();
		$viewData->item_images = $this->load->general_model->get_where('users_images', ['users_id' => $usersID]);
		$render_html = $this->load->view('back/pages/users/users_image', $viewData);
		echo $render_html;
	}
}
