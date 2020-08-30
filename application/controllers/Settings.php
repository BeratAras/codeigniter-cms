<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	public function index()
	{
		$data = new stdClass();
		$data->settings = $this->general_model->get_where('settings', ["id" => 1]);
		$this->load->view('back/pages/settings/settings_view', $data);
	}

	public function update()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("company_name", "Şirket Adı", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);

		$validate = $this->form_validation->run();

		if($validate)
		{
			$companyName 		= $this->input->post('company_name');
			$aboutUs 			= $this->input->post('about_us');
			$mission 			= $this->input->post('mission');
			$vision 			= $this->input->post('vision');
			$address 			= $this->input->post('address');
			$phone_1 			= $this->input->post('phone_1');
			$phone_2 			= $this->input->post('phone_2');
			$fax_1 				= $this->input->post('fax_1');
			$fax_2 				= $this->input->post('fax_2');
			$email 				= $this->input->post('email');
			$facebook 			= $this->input->post('facebook');
			$twitter 			= $this->input->post('twitter');
			$instagram 			= $this->input->post('instagram');
			$linkedin 			= $this->input->post('linkedin');
		
			$config = array(
				"allowed_types"	=>	"jpeg|jpg|png",
				"upload_path"	=>	"uploads/logo",
			);

			$this->load->library("upload", $config);
	
			$upload = $this->upload->do_upload("logo");

			if($upload)
			{
				$logo_file_name	= $this->upload->data("file_name");

				$data = array(
					'company_name' 			=> $companyName,
					'about_us' 				=> $aboutUs,
					'mission'				=> $mission,
					'vision'				=> $vision,
					'logo'					=> $logo_file_name,
					'address'				=> $address,
					'phone_1'				=> $phone_1,
					'phone_2'				=> $phone_2,
					'fax_1'					=> $fax_1,
					'fax_2'					=> $fax_2,
					'email'					=> $email,
					'facebook'				=> $facebook,
					'twitter'				=> $twitter,
					'instagram'				=> $instagram,
					'linkedin'				=> $linkedin,
					'updatedAt'				=> date('Y-m-d H:i:s')
				);
			}
			else
			{
				$data = array(
					'company_name' 			=> $companyName,
					'about_us' 				=> $aboutUs,
					'mission'				=> $mission,
					'vision'				=> $vision,
					'address'				=> $address,
					'phone_1'				=> $phone_1,
					'phone_2'				=> $phone_2,
					'fax_1'					=> $fax_1,
					'fax_2'					=> $fax_2,
					'email'					=> $email,
					'facebook'				=> $facebook,
					'twitter'				=> $twitter,
					'instagram'				=> $instagram,
					'linkedin'				=> $linkedin,
					'updatedAt'				=> date('Y-m-d H:i:s')
				);
			}

			$result = $this->general_model->update('settings', ["id" => 1], $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Güncelleme başarılı bir şekilde yapıldı.",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("settings"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/settings/settings_view', $data);
		}
	}

}
