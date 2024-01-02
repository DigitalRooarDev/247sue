<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commission  extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
		$this->load->model('Commission_model', 'commission');  
		
	}

	public function index()
	{
		$data['title'] = 'Compensation Manager';
		$data['breadcrumb_title'] = 'Compensation Manager';
		$data['breadcrumb_menu'] = 'Compensation Manager';
		$data['section_title'] = 'Compensation List';
		$data['rows'] = $this->commission->getCommission();

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/commission/index');
		$this->load->view('admin/include/footer');
	}


public function paymentstatus()
   {

   		 $id = $this->uri->segment(4);
   	    $status = $this->uri->segment(5);

   		//die;

   		if($status == 'No')
   		{
   			$st = 'Yes';
   		}else
   		{
   			$st = 'No';
   		}

   		$UpdateRow = array(
					 	'com_payment_status' =>$st, 
					 	 
					 
					 );
					
	$update = $this->common->update($UpdateRow , $id , 'request');

	if($update)
						{
							$this->session->set_flashdata('success_message', 'Payment release status  successfully!');
			 			    redirect(base_url('admin/commission'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/commission'));
						}

   }


}
