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
		echo "save";
	}
}
