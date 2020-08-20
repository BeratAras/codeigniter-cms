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
				redirect(base_url("product"));
			}
			else
			{
				echo "bb";
			}
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
}
