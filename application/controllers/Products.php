<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	public function index()
	{
		$data = new stdClass();
		$data->products = $this->general_model->get_all('products');
		$this->load->view('back/pages/products/product_view', $data);
	}

	public function add_page()
	{
		$this->load->view('back/pages/products/product_add');
	}

	public function add()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules("title", "Başlık", "required|trim");
		$this->form_validation->set_message(["required" => "<b>{field}</b> alanı doldurulmalıdır."]);
		$validate = $this->form_validation->run();

		if($validate)
		{
			$title 		 	= $this->input->post('title');
			$description 	= $this->input->post('description');

			$data = array(
				'title' 		=> $title,
				'description' 	=> $description,
				'url'			=> strToUrl($title),
				'rank'			=> 0,
				'isActive'		=> 1,
				'createdAt'		=> date('Y-m-d H:i:s')
			);

			$result = $this->general_model->add_all('products', $data);

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
			redirect(base_url("products"));
		}
		else
		{
			$data = new stdClass();
			$data->form_error = true;
			$this->load->view('back/pages/products/product_add', $data);
		}
	}

	public function update_page($id)
	{
		$data = new stdClass();
		$data->product = $this->general_model->get_where('products', ["id" => $id]);
		$this->load->view('back/pages/products/product_update', $data);
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

			$data = array(
				'title' 		=> $title,
				'description' 	=> $description,
				'url'			=> strToUrl($title),
			);

			$result = $this->general_model->update('products', ["id" => $id], $data);

			if($result)
			{
				redirect(base_url('products'));
			}
			else
			{
				echo "update başarısız";
			}
		}
	}

	public function delete($id, $table)
	{
		$result = $this->general_model->delete($table, ['id' => $id]);

		if($result)
		{
			if($table == "products")
			{
				redirect(base_url('products'));
			}
			else if($table == "product_images")
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

	public function isCoverSetter($imageID, $productID)
	{
		$isCover = ($this->input->post("data") === "true") ? 1 : 0;
		
		//Kapak yapılmak istenen kayıt
		$data = array(
			"isCover" => $isCover
		);
		$this->general_model->update("product_images", ["id" => $imageID, "product_id" => $productID], $data);

		//Kapak yapılmayan diğer kayıtlar.
		$data2 = array(
			"isCover" => 0
		);
		$this->general_model->update("product_images", ["id !=" => $imageID, "product_id" => $productID], $data2);

		$viewData = new stdClass();
		$viewData->item_images = $this->load->general_model->get_where('product_images', ['product_id' => $productID]);
		$render_html = $this->load->view('back/pages/products/product_image', $viewData);
		echo $render_html;
	}
	
	public function image_page($id)
	{
		$data = new stdClass();
		$data->product 			= 	$this->general_model->get_where('products', ["id" => $id]);
		$data->product_images	=	$this->general_model->get_all("product_images");
		$this->load->view('back/pages/products/product_image', $data);
	}

	public function image_upload($id)
	{
		$config = array(
			"allowed_types"	=>	"jpeg|jpg|png",
			"upload_path"	=>	"uploads/products",
		);
		$this->load->library("upload", $config);

		$upload = $this->upload->do_upload("file");

		if($upload)
		{
			$upload_file_name	=	$this->upload->data("file_name");

			$data = array(
				"img_url"		=>	$upload_file_name,
				"product_id"	=>	$id,
				"rank"			=>	0,
				"isActive"		=>	1,
				"createdAt"		=>	date('Y-m-d H:i:s')
			);

			$this->general_model->add_all("product_images", $data);
		}
		else
		{
			echo "işlem başarısız";
		}
	}

}
