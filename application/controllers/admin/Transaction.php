<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
		$this->load->model('Transaction_model', 'transaction');  
	}

	public function index()
	{
		$data['title'] = 'Transaction Manager';
		$data['breadcrumb_title'] = 'Transaction Manager';
		$data['breadcrumb_menu'] = 'Transaction Manager';
		$data['section_title'] = 'Transaction List';
		$data['rows'] = $this->transaction->getAlltransaction();

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/transaction/index');
		$this->load->view('admin/include/footer');
	}




	public function usertransaction($id)
	{
		$data['title'] = 'Transaction Manager';
		$data['breadcrumb_title'] = 'Transaction Manager';
		$data['breadcrumb_menu'] = 'Transaction Manager';
		$data['section_title'] = 'Transaction List';
		$data['rows'] = $this->transaction->getAlltransaction($id);

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/transaction/index');
		$this->load->view('admin/include/footer');
	}



}
