<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team  extends CI_Controller {

	function __construct() {
		Parent::__construct();
		//check_login_admin();
		$this->load->model('TeamModel');  
		
	}

	public function index()
	{
		$data = array();
		$data['rows'] = $this->TeamModel->get_team_data();

		$this->load->view('layout/header');
		$this->load->view('front_view/team',$data);
		$this->load->view('layout/footer');
	}


}

?>