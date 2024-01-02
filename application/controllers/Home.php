<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct() {
		Parent::__construct();
		 // check_login_admin();
          $this->load->model('TestomonialModel'); 
          $this->load->model('HowitworkModel'); 
	}

    public function index()
    {
        $data = array();
        $data['how_it_work'] = $this->HowitworkModel->get_Howitwork_data();
        $data['testomonial'] = $this->TestomonialModel->get_testomonial_data();

        $this->load->view('layout/header');
        $this->load->view('front_view/home',$data);
        $this->load->view('layout/footer');
        // $data = array();
        // $data['content'] = $this->load->view('home');
        // $this->load->view('index',$data);
    }
    
}

