<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Websetting extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('WebsettingModel');  
	}

	public function index()
	{
		$data['title'] = 'Web Settings';
		$data['breadcrumb_title'] = 'Web Settings';
		$data['breadcrumb_menu'] = 'Web Settings';
		$data['section_title'] = 'Web Setting List';
		$data['social_links'] = 'Social Links';
		$data['footer_setting'] = 'Footer Setting';
		//$data['rows'] = $this->WebsettingModel->getAllstore_links();
		//$data['social_links'] = $this->WebsettingModel->getAllsocial_links();

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/websetting/index',$data);
		$this->load->view('admin/include/footer');
	}

	public function update()
{
	if(isset($_POST) && !empty($_POST))
	{
	
		//echo '<pre>'; print_r($_POST); die;
		
					foreach ($_POST as $key => $value) {

						//echo '<pre>'; print_r($key); die;

						$UpdateRow = array(
							 'field_value' => $value, 
						 );
				
							$this->db->where('field_key', $key);
							$this->db->update('website_settings', $UpdateRow);
					}
					$this->session->set_flashdata('success_message', 'Settings update successfully!');
	}
	

		redirect(base_url('admin/websetting'));
	


}


}


?>