<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About  extends CI_Controller {

	function __construct() {
		Parent::__construct();
		//check_login_admin();
		//$this->load->model('ContactModel');  
		
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('front_view/about');
		$this->load->view('layout/footer');
	}
}