<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Otherservice extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
	}

	public function index()
	{
		$data['title'] = 'Other Service Manager';
		$data['breadcrumb_title'] = 'Other Service Manager';
		$data['breadcrumb_menu'] = 'Other Service Manager';
		$data['section_title'] = 'Other Services List';

		$this->db->select('other_services.*');
		$this->db->select('u.*');
		$this->db->select('s.title');
		$this->db->from('other_services');
		$this->db->join('master_services as s', 's.id = other_services.master_services_id', 'left');
		$this->db->join('users as u', 'other_services.client_id = u.id', 'left');
		$this->db->order_by('other_services.id','desc');
		$query = $this->db->get();		
		$result = $query->result_array();

	/*	echo "<pre>";
		print_r($result); die;*/
		$data['rows'] = $result;
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/otherservice/index');
		$this->load->view('admin/include/footer');
	}






}
