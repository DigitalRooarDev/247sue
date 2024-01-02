<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq  extends CI_Controller {

	function __construct() {
		Parent::__construct();
		//check_login_admin();
		$this->load->model('FaqModel');  
		
	}

	public function index()
	{
		$data = array();
		$data['rows'] = $this->FaqModel->getAllfaq();

		$this->load->view('layout/header');
		$this->load->view('front_view/faq',$data);
		$this->load->view('layout/footer');
	}


}

?>