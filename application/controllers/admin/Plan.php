<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
	}

	public function index()
	{
		$data['title'] = 'Membership Plan';
		$data['breadcrumb_title'] = 'Membership Plan';
		$data['breadcrumb_menu'] = 'Membership Plan';
		$data['section_title'] = 'Membership Plan List';
		$data['rows'] = $this->common->getAllRecord('membership_plan','desc');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/plan/index');
		$this->load->view('admin/include/footer');
	}


public function add(){
		$data['title'] = 'Membership Plan';
		$data['breadcrumb_title'] = 'Membership Plan';
		$data['breadcrumb_menu'] = 'Add Membership Plan';
		$data['section_title'] = 'Add Membership Plan';
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/plan/add');
		$this->load->view('admin/include/footer');
	}



  public function save()
  {
	if(isset($_POST) && !empty($_POST))
		{
			$this->form_validation->set_rules('plan_type', 'plan type', 'required');
			$this->form_validation->set_rules('name', 'plan name', 'trim|required');
			$this->form_validation->set_rules('price', 'price', 'trim|required');
			$this->form_validation->set_rules('compensation', 'compensation', 'trim|required');
			if ($this->form_validation->run()) 
					{
								$insertRow = array(
								 	'plan_type' =>$_POST['plan_type'], 
								 	'name' =>$_POST['name'], 
								 	'price' =>$_POST['price'], 
								 	'compensation' =>$_POST['compensation'], 
								 	'service' =>serialize($_POST['service']), 
							 );
								$insertRow = $this->common->insert('membership_plan',$insertRow);
								if($insertRow)
								{
									$this->session->set_flashdata('success_message', 'Plan created successfully!');
					 			    redirect(base_url('admin/plan'));
								}else
								{
									$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
									redirect(base_url('admin/plan/add'));
								}
					}else
					{
						$this->add();
					}
		}else
		{
			redirect(base_url('admin/plan/add'));
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Membership Plan';
		$data['breadcrumb_title'] = 'Membership Plan';
		$data['breadcrumb_menu'] = 'Edit Membership Plan';
		$data['section_title'] = 'Edit Membership Plan';
		$data['row'] = $this->common->getSingleRecordById($id , 'membership_plan');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/plan/edit');
		$this->load->view('admin/include/footer');
	}


public function update($id)
  {
	if(isset($_POST) && !empty($_POST))
		{
			$this->form_validation->set_rules('plan_type', 'plan type', 'required');
			$this->form_validation->set_rules('name', 'plan name', 'trim|required');
			$this->form_validation->set_rules('price', 'price', 'trim|required');
			//$this->form_validation->set_rules('compensation', 'compensation', 'trim|required');
			if ($this->form_validation->run()) 
					{
						$UpdateRow = array(
						'plan_type' =>$_POST['plan_type'],
					 	'name' =>$_POST['name'], 
					 	'price' =>$_POST['price'], 
					 	'compensation' =>$_POST['compensation'], 
					 	'service' =>serialize($_POST['service']), 
					 );
					 //print_r($UpdateRow); die;
						$insertRow = $this->common->update($UpdateRow , $id , 'membership_plan');
						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Plan update successfully!');
			 			    redirect(base_url('admin/plan'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/plan/edit/'.$id));
						}	
						
 					}
					else
					{
						$this->edit($id);
					}
		}else
		{
			redirect(base_url('admin/plan/edit/'.$id));
		}
	}


   public function delete($id)
   {
       $this->db->delete('membership_plan', array('id' => $id));
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
					
	$update = $this->common->update($UpdateRow , $id , 'membership_plan');

	if($update)
						{
							$this->session->set_flashdata('success_message', 'Item status update successfully!');
			 			    redirect(base_url('admin/plan'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/plan/edit/'.$id));
						}

   }
}
