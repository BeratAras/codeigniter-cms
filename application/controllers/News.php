<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	public function index()
	{
		$data = new stdClass();
		$data->news = $this->general_model->get_all('news');
		$this->load->view('back/pages/news/news_view', $data);
	}

	public function add_page()
	{
		$this->load->view('back/pages/news/news_add');
	}

	public function add()
	{
        $this->load->library('form_validation');
        
		$news_type = $this->input->post('news_type');
        if($news_type == "image")
        {
            if($_FILES["file"]["name"] == "")
            {
                $alert = array(
					"title"	=>	"İşlem Başarısız!",
					"text"	=>	"Lüten bir görsel seçiniz.",
					"type"	=>	"error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("news/add_page"));
            }
        }
        else if($news_type == "video")
        {
            $this->form_validation->set_rules("video_url", "Video URL", "required|trim");
        }

		$this->form_validation->set_rules("title", "Başlık", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);
		$validate = $this->form_validation->run();

		if($validate)
		{
			$title 		 	= $this->input->post('title');
			$description 	= $this->input->post('description');
			$video_url		= $this->input->post('video_url');

			$config = array(
				"allowed_types"	=>	"jpeg|jpg|png",
				"upload_path"	=>	"uploads/news",
			);
			$this->load->library("upload", $config);
	
			$upload = $this->upload->do_upload("file");

			if($upload)
			{
				$upload_file_name	=	$this->upload->data("file_name");

				$data = array(
					'title' 		=> $title,
					'description' 	=> $description,
					'url'			=> strToUrl($title),
					'news_type'		=> $news_type,
					'img_url'		=> $upload_file_name,
					'video_url'		=> $video_url,
					'rank'			=> 0,
					'isActive'		=> 1,
					'createdAt'		=> date('Y-m-d H:i:s')
				);
			}
			else
			{
				$data = array(
					'title' 		=> $title,
					'description' 	=> $description,
					'url'			=> strToUrl($title),
					'news_type'		=> $news_type,
					'video_url'		=> $video_url,
					'rank'			=> 0,
					'isActive'		=> 1,
					'createdAt'		=> date('Y-m-d H:i:s')
				);
			}

			$result = $this->general_model->add_all('news', $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Kayıt başarılı bir şekilde eklendi!",
					"type"	=>	"success"
				);
			}
			else
			{
				$alert = array(
					"title"	=>	"İşlem Başarısız!",
					"text"	=>	"Kayıt eklenemedi!",
					"type"	=>	"error"
				);
			}
			//İşlemin sonucunu session'a yazar.
			$this->session->set_flashdata("alert", $alert);
			redirect(base_url("news"));
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/news/news_add', $data);
		}
	}

	public function update_page($id)
	{
		$data = new stdClass();
		$data->news = $this->general_model->get_where('news', ["id" => $id]);
		$this->load->view('back/pages/news/news_update', $data);
	}

	public function update($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("title", "Başlık", "required|trim");

		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);
		$validate = $this->form_validation->run();

		if($validate){
			$title 		 	= $this->input->post('title');
			$description 	= $this->input->post('description');
			$news_type		= $this->input->post('news_type');
			$video_url		= $this->input->post('video_url');

			if($news_type == "image")
			{
				if($_FILES['file']['name'] !== "")
				{
					$config = array(
						"allowed_types"	=>	"jpeg|jpg|png",
						"upload_path"	=>	"uploads/news",
					);
					$this->load->library("upload", $config);
			
					$upload = $this->upload->do_upload("file");
					$upload_file_name	=	$this->upload->data("file_name");

					$data = array(
						'title' 		=> $title,
						'description' 	=> $description,
						'url' 			=> strToUrl($title),
						'news_type' 	=> $news_type,
						'img_url'		=> $upload_file_name,
						'video_url'		=> ""
					);
				}
				else
				{
					$data = array(
						'title' 		=> $title,
						'description' 	=> $description,
						'url' 			=> strToUrl($title),
						'news_type' 	=> $news_type
					);
				}
			}
			else if($news_type == "video")
			{
				$data = array(
					'title' 		=> $title,
					'description' 	=> $description,
					'news_type' 	=> $news_type,
					'img_url'		=> "",
					'video_url'		=> $video_url
				);
			}

			$result = $this->general_model->update('news', ["id" => $id], $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Güncelleme başarılı bir şekilde yapıldı.",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("news"));
			}
			else
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Güncelleme yapılamadı.",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("news"));
			}
		}
	}

	public function delete($id, $table)
	{
		$result = $this->general_model->delete($table, ['id' => $id]);

		if($result)
		{
			if($table == "news")
			{
				redirect(base_url('news'));
			}
			else if($table == "news_images")
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

	public function isCoverSetter($imageID, $newsID)
	{
		$isCover = ($this->input->post("data") === "true") ? 1 : 0;
		
		//Kapak yapılmak istenen kayıt
		$data = array(
			"isCover" => $isCover
		);
		$this->general_model->update("news_images", ["id" => $imageID, "news_id" => $newsID], $data);

		//Kapak yapılmayan diğer kayıtlar.
		$data2 = array(
			"isCover" => 0
		);
		$this->general_model->update("news_images", ["id !=" => $imageID, "news_id" => $newsID], $data2);

		$viewData = new stdClass();
		$viewData->item_images = $this->load->general_model->get_where('news_images', ['news_id' => $newsID]);
		$render_html = $this->load->view('back/pages/news/news_image', $viewData);
		echo $render_html;
	}
}
