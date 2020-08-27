<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class References extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	public function index()
	{
		$data = new stdClass();
		$data->references = $this->general_model->get_all('references');
		$this->load->view('back/pages/references/references_view', $data);
	}

	public function add_page()
	{
		$this->load->view('back/pages/references/references_add');
	}

	public function add()
	{
        $this->load->library('form_validation');
        
        if($references_type == "image")
        {
            if($_FILES["file"]["name"] == "")
            {
                $alert = array(
					"title"	=>	"İşlem Başarısız!",
					"text"	=>	"Lüten bir görsel seçiniz.",
					"type"	=>	"error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("references/add_page"));
            }
        }

		$this->form_validation->set_rules("title", "Başlık", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);
		$validate = $this->form_validation->run();

		if($validate)
		{
			$title 		 	= $this->input->post('title');
			$description 	= $this->input->post('description');

			$config = array(
				"allowed_types"	=>	"jpeg|jpg|png",
				"upload_path"	=>	"uploads/references",
			);
			$this->load->library("upload", $config);
	
			$upload = $this->upload->do_upload("file");

			if($upload)
			{
				$upload_file_name	=	$this->upload->data("file_name");

				$data = array(
					'title' 			=> $title,
					'description' 		=> $description,
					'url'				=> strToUrl($title),
					'img_url'			=> $upload_file_name,
					'rank'				=> 0,
					'isActive'			=> 1,
					'createdAt'			=> date('Y-m-d H:i:s')
				);
			}

			$result = $this->general_model->add_all('references', $data);

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
			redirect(base_url("references"));
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/references/references_add', $data);
		}
	}

	public function update_page($id)
	{
		$data = new stdClass();
		$data->references = $this->general_model->get_where('references', ["id" => $id]);
		$this->load->view('back/pages/references/references_update', $data);
	}

	public function update($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("title", "Başlık", "required|trim");

		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);

		$validate = $this->form_validation->run();

		if($validate)
		{
			$title 		 	= $this->input->post('title');
			$description 	= $this->input->post('description');

			if($_FILES['file']['name'] !== "")
			{
				$config = array(
					"allowed_types"	=>	"jpeg|jpg|png",
					"upload_path"	=>	"uploads/references",
				);
				$this->load->library("upload", $config);
		
				$upload = $this->upload->do_upload("file");
				$upload_file_name	=	$this->upload->data("file_name");
				
				$data = array(
					'url' 			=> strToUrl($title),
					'title' 		=> $title,
					'description' 	=> $description,
					'img_url'		=> $upload_file_name,
				);
			}
			else
			{
				$data = array(
					'url' 			=> strToUrl($title),
					'title' 		=> $title,
					'description' 	=> $description
				);
			}

			$result = $this->general_model->update('references', ["id" => $id], $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Güncelleme başarılı bir şekilde yapıldı.",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("references"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/references/references_update', $data);
		}
	}

	public function delete($id, $table)
	{
		$result = $this->general_model->delete($table, ['id' => $id]);

		if($result)
		{
			if($table == "references")
			{
				redirect(base_url('references'));
			}
			else if($table == "references_images")
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

	public function isCoverSetter($imageID, $referencesID)
	{
		$isCover = ($this->input->post("data") === "true") ? 1 : 0;
		
		//Kapak yapılmak istenen kayıt
		$data = array(
			"isCover" => $isCover
		);
		$this->general_model->update("references_images", ["id" => $imageID, "references_id" => $referencesID], $data);

		//Kapak yapılmayan diğer kayıtlar.
		$data2 = array(
			"isCover" => 0
		);
		$this->general_model->update("references_images", ["id !=" => $imageID, "references_id" => $referencesID], $data2);

		$viewData = new stdClass();
		$viewData->item_images = $this->load->general_model->get_where('references_images', ['references_id' => $referencesID]);
		$render_html = $this->load->view('back/pages/references/references_image', $viewData);
		echo $render_html;
	}
}
