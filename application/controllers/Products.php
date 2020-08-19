<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __consturct()
	{
		parent::__consturct();
	}

	public function index()
	{
		$data = new stdClass();
		$this->load->view('back/pages/products/product_view');
	}
}
