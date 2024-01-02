<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
	}

	public function index($id = null)
	{
		$data['title'] = 'Users Manager';
		$data['breadcrumb_title'] = 'Users Manager';
		$data['breadcrumb_menu'] = 'Users Manager';
		$data['section_title'] = 'Users List';

		if($id) {
			$plan_id = $id ?? null;
			$plan_period = null;
		} else {
			$plan_id = $_POST['plan_id'] ?? null;
			$plan_period = $_POST['plan_period'] ?? null;
		}

		$ids = array();
		if($plan_period){
			$ids[] = $plan_period;
		} else {
			if($plan_id && $plan_id == 'NoPlan'){
				$plans = $this->db->select('*')->from('membership_plan')->where('plan_type', null)->get()->result_array();
				$ids[] = $plans[0]['id'];
			} else {
				if($plan_id){
					$plans = $this->db->select('*')->from('membership_plan')->where('plan_type', $plan_id)->get()->result_array();
					foreach ($plans as $key => $plan) {
						$ids[] = $plan['id'];
					}
				}
			}
		}

		$data['rows'] = $this->common->getAllClient($ids);
		$data['plan_id'] = $plan_id;
		$data['plan_period'] = $plan_period;

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/user/index');
		$this->load->view('admin/include/footer');
	}

	public function viewdetails()
	{
		$id = ($_POST['id']) ? $_POST['id'] : '';
		$member = $this->common->getSingleRecordById($id,'users');
		$output = $this->load->view('admin/user/view' , ['member'=> $member] , true);
		echo json_encode($output);
	}

	public function add()
	{
		

		$data['title'] = 'User Manager';
		$data['breadcrumb_title'] = 'User Manager';
		$data['breadcrumb_menu'] = 'Add User';
		$data['section_title'] = 'Add User';

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/user/add');
		$this->load->view('admin/include/footer');



	}



  public function save()
  {
	if(isset($_POST) && !empty($_POST))
		{
			
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[users.email]');
			$this->form_validation->set_rules('mobile', 'mobile', 'trim|required|is_unique[users.mobile]');
			$this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			
			

			if ($this->form_validation->run()) 
					{


					 $insertRow = array(
					 	'first_name' =>$_POST['first_name'], 
					 	'last_name' =>$_POST['last_name'], 
					 	'email' =>$_POST['email'], 
					 	'mobile' =>$_POST['mobile'], 
					 	'role' => 'Client',
					 	'password' =>md5($_POST['password']), 
					 	'address' =>$_POST['address'], 
					 	 
					 );
					
						$insertRow = $this->common->insert('users',$insertRow);

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'User created successfully!');
			 			    redirect(base_url('admin/user'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/user/add'));
						}	
						
 					}
					else
					{
						$this->add();
					}
					


		}else
		{
			redirect(base_url('admin/user/add'));
		}

		


		


	}





	public function edit($id){
		$data['title'] = 'User Manager';
		$data['breadcrumb_title'] = 'User Manager';
		$data['breadcrumb_menu'] = 'Edit User';
		$data['section_title'] = 'Edit User';
		$data['row'] = $this->common->getSingleRecordById($id , 'users');
		$total_evidence_size_arr = $this->common->getTotalsizeofEvidences($id);
		$total_evidence_size = $total_evidence_size_arr['size'];
		//echo $total_evidence_size; die;
		$total_evidence_size_in_gb = ($total_evidence_size/1024)/1024;
		$data['total_evidence_size_in_kb'] = round($total_evidence_size);
		$data['total_evidence_size_in_gb'] = round($total_evidence_size_in_gb,4);
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/user/edit');
		$this->load->view('admin/include/footer');
	}


public function update($id)
  {
	if(isset($_POST) && !empty($_POST))
		{

				$singleRow = $this->common->getSingleRecordById($id , 'users');
		
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

			

			if(isset($_POST['mobile']) && !empty($_POST['mobile']) && $_POST['mobile'] != $singleRow['mobile'])
			{
					$this->form_validation->set_rules('mobile', 'mobile', 'trim|required|is_unique[users.mobile]');
			}else
			{
				$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
			}

			if(isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] != $singleRow['email'])
			{
					$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[users.email]');
			}else
			{
				$this->form_validation->set_rules('email', 'email', 'trim|required');
			}
			

			if (!empty($_POST['password'])) {

			$this->form_validation->set_rules('password', 'password', 'required');
			$this->form_validation->set_rules('confirm_password', 'confirm password', 'required|matches[password]');
			}
			
			

			if ($this->form_validation->run()) 
					{

						$UpdateRow = array(
					 	'first_name' =>$_POST['first_name'], 
					 	'last_name' =>$_POST['last_name'],
					 	'mobile' =>$_POST['mobile'], 
					 	'address' =>$_POST['address'], 
					 	'password' =>md5($_POST['password']), 
					 
					 );
					
						$insertRow = $this->common->update($UpdateRow , $id , 'users');

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'User update successfully!');
			 			    redirect(base_url('admin/user'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/user/edit/'.$id));
						}	
						
 					}
					else
					{
						$this->edit($id);
					}
					


		}else
		{
			redirect(base_url('admin/user/edit/'.$id));
		}

		


		


	}


   public function delete($id)
   {
       $this->db->delete('users', array('id' => $id));
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
					
	$update = $this->common->update($UpdateRow , $id , 'users');

	if($update)
						{
							$this->session->set_flashdata('success_message', 'User status update successfully!');
			 			    redirect(base_url('admin/user'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/user/edit/'.$id));
						}

   }





public function profile()
	{

		//echo '<pre>'; print_r($_SESSION); die;
		

		$data['title'] = 'Profile Manager';
		$data['breadcrumb_title'] = 'Profile Manager';
		$data['breadcrumb_menu'] = 'Edit Profile';
		$data['section_title'] = 'Edit Profile';
		$data['row'] = $this->common->getSingleRecordById($_SESSION['Admin']['id'] , 'users');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/user/profile');
		$this->load->view('admin/include/footer');



	}



public function updateprofile($id)
  {
	if(isset($_POST) && !empty($_POST))
		{
		
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			
			$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
			
			

			if ($this->form_validation->run()) 
					{

						$UpdateRow = array(
					 	'first_name' =>$_POST['first_name'], 
					 	'last_name' =>$_POST['last_name'], 
					 	'mobile' =>$_POST['mobile'], 
					 
					 );
					
						$insertRow = $this->common->update($UpdateRow , $id , 'users');

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Profile update successfully!');
			 			    redirect(base_url('admin/user/profile'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/user/profile/'.$id));
						}	
						
 					}
					else
					{
						$this->profile($id);
					}
					


		}else
		{
			redirect(base_url('admin/user/profile/'.$id));
		}

	}

		



















   
}
