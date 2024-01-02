<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacypolicy extends CI_Controller {
	function __construct() {
		Parent::__construct();
	}
	
	public function index(){
		$this->load->view('privacy-policy');
	}
}
