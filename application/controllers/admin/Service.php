<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
	}

	public function index()
	{
		$data['title'] = 'Service Manager';
		$data['breadcrumb_title'] = 'Service Manager';
		$data['breadcrumb_menu'] = 'Service Manager';
		$data['section_title'] = 'Services  List';
		$data['rows'] = $this->common->getAllRecord('master_services','desc');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/service/index');
		$this->load->view('admin/include/footer');
	}




public function add()
	{
		

		$data['title'] = 'Service Manager';
		$data['breadcrumb_title'] = 'Service Manager';
		$data['breadcrumb_menu'] = 'Add Service';
		$data['section_title'] = 'Add Service';

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/service/add');
		$this->load->view('admin/include/footer');



	}



  public function save()
  {
	if(isset($_POST) && !empty($_POST))
		{
			
			$this->form_validation->set_rules('title', 'title', 'trim|required');
			
			

			if ($this->form_validation->run()) 
					{


					 $insertRow = array(
					 	'title' =>$_POST['title'], 
					 	 
					 );
					
						$insertRow = $this->common->insert('master_services',$insertRow);

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Service created successfully!');
			 			    redirect(base_url('admin/service/add'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/service/add'));
						}	
						
 					}
					else
					{
						$this->add();
					}
					


		}else
		{
			redirect(base_url('admin/service/add'));
		}

		


		


	}



	public function edit($id)
	{
		

		$data['title'] = 'Service Manager';
		$data['breadcrumb_title'] = 'Service Manager';
		$data['breadcrumb_menu'] = 'Edit Service';
		$data['section_title'] = 'Edit Service';
		$data['row'] = $this->common->getSingleRecordById($id , 'master_services');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/service/edit');
		$this->load->view('admin/include/footer');



	}


public function update($id)
  {
	if(isset($_POST) && !empty($_POST))
		{
		
			$this->form_validation->set_rules('title', 'title', 'trim|required');
		
			

			if ($this->form_validation->run()) 
					{

						$UpdateRow = array(
					 	'title' =>$_POST['title'], 
					 	
					 	
					 
					 );
					
						$insertRow = $this->common->update($UpdateRow , $id , 'master_services');

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Email template update successfully!');
			 			   redirect(base_url('admin/service/edit/'.$id));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/service/edit/'.$id));
						}	
						
 					}
					else
					{
						$this->edit($id);
					}
					


		}else
		{
			redirect(base_url('admin/service/edit/'.$id));
		}

		


		


	}


 public function delete($id)
   {
       $this->db->delete('master_services', array('id' => $id));
       echo 'Deleted successfully.';
   }

    public function status()
   {

   		 $id = $this->uri->segment(4);
   	    $status = $this->uri->segment(5);

   		//die;

   		if($status == '1')
   		{
   			$st = '0';
   		}else
   		{
   			$st = '1';
   		}

   		$UpdateRow = array(
					 	'status' =>$st, 
					 	 
					 
					 );
					
	$update = $this->common->update($UpdateRow , $id , 'master_services');

	if($update)
						{
							$this->session->set_flashdata('success_message', 'Service status update successfully!');
			 			    redirect(base_url('admin/service'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							 redirect(base_url('admin/service'));
						}

   }



}
