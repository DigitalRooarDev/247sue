<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HowitWork extends CI_Controller
{

    function __construct() {
		Parent::__construct();
		 // check_login_admin();
          $this->load->model('HowitworkModel'); 
	}

    public function index()
    {
         $data = array();
         $data['rows'] = $this->HowitworkModel->get_Howitwork_data();

        $this->load->view('layout/header');
        $this->load->view('front_view/howitwork',$data);
        $this->load->view('layout/footer');
        
    }
    
}

