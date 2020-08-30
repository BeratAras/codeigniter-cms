<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	//Portfolio

	public function index()
	{
		$data = new stdClass();
		$data->portfolio = $this->general_model->get_all('portfolios');
		$this->load->view('back/pages/portfolios/portfolio/portfolio_view', $data);
	}

	public function add_page()
	{
		$data = new stdClass();
		$data->portfolio_categories = $this->general_model->get_all('portfolio_categories');
		$this->load->view('back/pages/portfolios/portfolio/portfolio_add', $data);
	}

	public function add()
	{
        $this->load->library('form_validation');

		$this->form_validation->set_rules("title", "Başlık", "required|trim");
		$this->form_validation->set_rules("category", "Category", "required|trim");
		$this->form_validation->set_rules("client", "Category", "required|trim");
		$this->form_validation->set_rules("finishedAt", "Category", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);
		$validate = $this->form_validation->run();

		if($validate)
		{
			$url 		 	= $this->input->post('url');
			$title 		 	= $this->input->post('title');
			$description 	= $this->input->post('description');
			$finishedAt 	= $this->input->post('finishedAt');
			$client 		= $this->input->post('client');
			$category 		= $this->input->post('category');
			$place 			= $this->input->post('place');
			$portfolioUrl 	= $this->input->post('portfolio_url');

			$data = array(
				'title' 			=> $title,
				'description' 		=> $description,
				'finishedAt' 		=> $finishedAt,
				'client' 			=> $client,
				'category_id' 		=> $category,
				'place' 			=> $place,
				'portfolio_url' 	=> $portfolioUrl,
				'url'				=> strToUrl($title),
				'rank'				=> 0,
				'isActive'			=> 1,
				'createdAt'			=> date('Y-m-d H:i:s')
			);

			$result = $this->general_model->add_all('portfolios', $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Kayıt başarılı bir şekilde eklendi!",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("portfolio"));
			}

		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/portfolios/portfolio/portfolio_add', $data);
		}
	}

	public function update_page($id)
	{
		$data = new stdClass();
		$data->portfolio = $this->general_model->get_where('portfolios', ["id" => $id]);
		$data->portfolio_categories = $this->general_model->get_all('portfolio_categories');
		$this->load->view('back/pages/portfolios/portfolio/portfolio_update', $data);
	}

	public function update($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("title", "Başlık", "required|trim");
		$this->form_validation->set_rules("category", "Category", "required|trim");
		$this->form_validation->set_rules("client", "Category", "required|trim");
		$this->form_validation->set_rules("finishedAt", "Category", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);

		$validate = $this->form_validation->run();

		if($validate)
		{
			$url 		 	= $this->input->post('url');
			$title 		 	= $this->input->post('title');
			$description 	= $this->input->post('description');
			$finishedAt 	= $this->input->post('finishedAt');
			$client 		= $this->input->post('client');
			$category 		= $this->input->post('category');
			$place 			= $this->input->post('place');
			$portfolioUrl 	= $this->input->post('portfolio_url');

			$data = array(
				'title' 			=> $title,
				'description' 		=> $description,
				'finishedAt' 		=> $finishedAt,
				'client' 			=> $client,
				'category_id' 		=> $category,
				'place' 			=> $place,
				'portfolio_url' 	=> $portfolioUrl,
				'url'				=> strToUrl($title),
			);

			$result = $this->general_model->update('portfolios', ["id" => $id], $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Güncelleme başarılı bir şekilde yapıldı.",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("portfolio"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/portfolios/portfolio/portfolio_update', $data);
		}
	}

	public function delete($id, $table)
	{
		$result = $this->general_model->delete($table, ['id' => $id]);

		if($result)
		{
			if($table == "portfolio_categories")
			{
				redirect(base_url('portfolio_categories'));
			}
			else
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

	public function isCoverSetter($imageID, $portfolio_categoriesID)
	{
		$isCover = ($this->input->post("data") === "true") ? 1 : 0;
		
		//Kapak yapılmak istenen kayıt
		$data = array(
			"isCover" => $isCover
		);
		$this->general_model->update("portfolio_images", ["id" => $imageID, "portfolio_id" => $portfolio_categoriesID], $data);

		//Kapak yapılmayan diğer kayıtlar.
		$data2 = array(
			"isCover" => 0
		);
		$this->general_model->update("portfolio_images", ["id !=" => $imageID, "portfolio_id" => $portfolio_categoriesID], $data2);

		$viewData = new stdClass();
		$viewData->item_images = $this->load->general_model->get_where('portfolio_categories_images', ['portfolio_categories_id' => $portfolio_categoriesID]);
		$render_html = $this->load->view('back/pages/portfolios/portfolio/portfolio_categories_image', $viewData);
		echo $render_html;
	}

	public function image_page($id)
	{
		$data = new stdClass();
		$data->portfolio 			= 	$this->general_model->get_where('portfolios', ["id" => $id]);
		$data->portfolio_images	=	$this->general_model->get_all("portfolio_images");
		$this->load->view('back/pages/portfolios/portfolio/portfolio_image', $data);
	}

	public function image_upload($id)
	{
		$config = array(
			"allowed_types"	=>	"jpeg|jpg|png",
			"upload_path"	=>	"uploads/portfolios",
		);
		$this->load->library("upload", $config);

		$upload = $this->upload->do_upload("file");

		if($upload)
		{
			$upload_file_name	=	$this->upload->data("file_name");

			$data = array(
				"img_url"		=>	$upload_file_name,
				"portfolio_id"	=>	$id,
				"rank"			=>	0,
				"isActive"		=>	1,
				"isCover"		=>	0,
				"createdAt"		=>	date('Y-m-d H:i:s')
			);

			$this->general_model->add_all("portfolio_images", $data);
		}
		else
		{
			echo "işlem başarısız";
		}
	}

	//Portfolio Categories

	public function portfolio_categories()
	{
		$data = new stdClass();
		$data->portfolio_categories = $this->general_model->get_all('portfolio_categories');
		$this->load->view('back/pages/portfolios/portfolio_categories/portfolio_categories_view', $data);
	}

	public function category_add_page()
	{
		$this->load->view('back/pages/portfolios/portfolio_categories/portfolio_categories_add');
	}

	public function category_add()
	{
        $this->load->library('form_validation');

		$this->form_validation->set_rules("title", "Başlık", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);
		$validate = $this->form_validation->run();

		if($validate)
		{
			$title 		 	= $this->input->post('title');

		
			$data = array(
				'title' 			=> $title,
				'isActive'			=> 1,
				'createdAt'			=> date('Y-m-d H:i:s')
			);
		
			$result = $this->general_model->add_all('portfolio_categories', $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Kayıt başarılı bir şekilde eklendi!",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("portfolio_categories"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/portfolios/portfolio_categories/portfolio_categories_add', $data);
		}
	}

	public function category_update_page($id)
	{
		$data = new stdClass();
		$data->portfolio_categories = $this->general_model->get_where('portfolio_categories', ["id" => $id]);
		$this->load->view('back/pages/portfolios/portfolio_categories/portfolio_categories_update', $data);
	}

	public function category_update($id)
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("title", "Başlık", "required|trim");

		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);

		$validate = $this->form_validation->run();

		if($validate)
		{
			$title 		 	= $this->input->post('title');

			$data = array(
				'title' 		=> $title,
				'isActive'			=> 1,
				'createdAt'			=> date('Y-m-d H:i:s')
			);

			$result = $this->general_model->update('portfolio_categories', ["id" => $id], $data);

			if($result)
			{
				$alert = array(
					"title"	=>	"İşlem Başarılı!",
					"text"	=>	"Güncelleme başarılı bir şekilde yapıldı.",
					"type"	=>	"success"
				);
				$this->session->set_flashdata("alert", $alert);
				redirect(base_url("portfolio_categories"));
			}
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/portfolios/portfolio_categories/portfolio_categories_update', $data);
		}
	}
}
