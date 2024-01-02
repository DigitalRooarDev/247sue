<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {

	function __construct() {
		Parent::__construct();
		//check_login_admin();
		$this->load->model('Common_model', 'common');  
		$this->load->model('Request_model', 'request');  
		$this->load->model('Chat_model', 'chat');  
	}

	public function index(){
		$data['title'] = 'Request Manager';
		$data['breadcrumb_title'] = 'Request Manager';
		$data['breadcrumb_menu'] = 'Request Manager';
		$data['section_title'] = 'Request List';
		$data['rows'] = $this->request->getrequest('Default');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/request/index');
		$this->load->view('admin/include/footer');
	}


		public function getallchatmember($id = ''){


		$data['title'] = 'All Discussion User';
		$data['breadcrumb_title'] = 'All Discussion User';
		$data['breadcrumb_menu'] = 'All Discussion User';
		$data['section_title'] = 'All Discussion User List';
		$data['rows'] = $this->chat->getallchatmemberByCaseID($id);
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/chat/index');
		$this->load->view('admin/include/footer');
	}

	public function getallchats(){

		$case_id =  $this->uri->segment(4);
		$lawyerid = $this->uri->segment(5);
		$client_id =  $this->uri->segment(6);

		


		$data['title'] = 'All Discussion chat';
		$data['breadcrumb_title'] = 'All Discussion chat';
		$data['breadcrumb_menu'] = 'All Discussion chat';
		$data['section_title'] = 'All Discussion User chat List';
		$data['rows'] = $this->chat->getallchatsByCaseID($case_id , $lawyerid , $client_id);
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/chat/chats');
		$this->load->view('admin/include/footer');
	}







}
