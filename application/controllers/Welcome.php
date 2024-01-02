<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
		function __construct() {
		Parent::__construct();
		$this->load->model('Common_model', 'common');  
	}

	public function index(){
	    redirect('/admin/login');
	///	$this->load->view('home');
	}

}
