<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	function __construct() {
		Parent::__construct();
		//  die('hello')	;
		  check_login_admin();
		$this->load->model('ContactModel');  
	}

	public function index()
	{
		$data = array();
        $data['title'] = 'Contact Manager';
		$data['breadcrumb_title'] = 'Contact Manager';
		$data['breadcrumb_menu'] = 'Contacts List';
		$data['section_title'] = 'Contacts List';
		$data['rows'] = $this->ContactModel->get_Entire_Data();

		$this->load->view('admin/include/header',$data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/contact/index',$data);
        $this->load->view('admin/include/footer');
	}

	
}
