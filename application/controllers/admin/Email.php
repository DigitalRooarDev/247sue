<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
	}

	public function index()
	{
		$data['title'] = 'Email Template Manager';
		$data['breadcrumb_title'] = 'Email Template Manager';
		$data['breadcrumb_menu'] = 'Email Template Manager';
		$data['section_title'] = 'Email Template  List';
		$data['rows'] = $this->common->getAllRecord('email','desc');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/email/index');
		$this->load->view('admin/include/footer');
	}







	public function edit($id)
	{
		

		$data['title'] = 'Email Template Manager';
		$data['breadcrumb_title'] = 'Email Template Manager';
		$data['breadcrumb_menu'] = 'Edit Email Template';
		$data['section_title'] = 'Edit Email Template';
		$data['row'] = $this->common->getSingleRecordById($id , 'email');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/email/edit');
		$this->load->view('admin/include/footer');



	}


public function update($id)
  {
	if(isset($_POST) && !empty($_POST))
		{
		
			$this->form_validation->set_rules('subject', 'subject', 'trim|required');
		
			

			if ($this->form_validation->run()) 
					{

						$UpdateRow = array(
					 	'subject' =>$_POST['subject'], 
					 	'content' =>$_POST['content'], 
					 	
					 
					 );
					
						$insertRow = $this->common->update($UpdateRow , $id , 'email');

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Email template update successfully!');
			 			   redirect(base_url('admin/email/edit/'.$id));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/email/edit/'.$id));
						}	
						
 					}
					else
					{
						$this->edit($id);
					}
					


		}else
		{
			redirect(base_url('admin/email/edit/'.$id));
		}

		


		


	}


}
