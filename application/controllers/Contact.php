<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact  extends CI_Controller {

	function __construct() {
		Parent::__construct();
		//check_login_admin();
		$this->load->model('ContactModel');  
		
	}

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('front_view/contact');
		$this->load->view('layout/footer');
	}

    public function save()
    {
        //echo "<pre>"; print_r($_POST); die; 
        if(isset($_POST) && !empty($_POST))
		{

				
		
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('subject', 'subject', 'required');
			$this->form_validation->set_rules('message', 'message', 'required');



			if ($this->form_validation->run()) 
					{

						$AddRow = array(
					 	'name' =>$_POST['name'], 
					 	'email' =>$_POST['email'],
					 	'subject' =>$_POST['subject'], 
					 	'message' =>$_POST['message'], 
					 
					 );

                     //echo '<pre>'; print_r($AddRow); die; 
					
						$NewRow = $this->ContactModel->insert($AddRow);

						if($NewRow)
						{
							$this->session->set_flashdata('success_message', 'Form Submitted successfully!');
			 			    redirect(base_url('contact'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('contact'));
						}	
						
 					}
					else
					{
						$this->index();
					}
					


		}else
		{
			redirect(base_url('admin/contact/add'));
		}
    }

}

?>