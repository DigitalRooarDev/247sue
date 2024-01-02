<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
	}

	public function index()
	{
		$data['title'] = 'Member Manager';
		$data['breadcrumb_title'] = 'Member Manager';
		$data['breadcrumb_menu'] = 'Member Manager';
		$data['section_title'] = 'Member List';
		$data['rows'] = $this->common->getAllUser('users','desc' ,'Lawyer');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/member/index');
		$this->load->view('admin/include/footer');
	}

	public function viewdetails()
	{
		$id = ($_POST['id']) ? $_POST['id'] : '';
		$member = $this->common->getSingleRecordById($id,'users');
		$output = $this->load->view('admin/member/view' , ['member'=> $member] , true);
		echo json_encode($output);
	}

public function add()
	{
		

		$data['title'] = 'Member Manager';
		$data['breadcrumb_title'] = 'Member Manager';
		$data['breadcrumb_menu'] = 'Add Member';
		$data['section_title'] = 'Add Member';

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/member/add');
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


						 if(!empty($_FILES['certificate']['name']))
				{

				$file = $this->do_upload('certificate');
				if($file['response'] == true)
				{
					$certificate = $file['data']['file_name'];
				}else

				{
					$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$certificate = $row['certificate'];
					$this->session->set_flashdata('certificate', $file['data']['error']);
				}

				}else
				{
					$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$certificate = $row['certificate'];
				}







				if(!empty($_FILES['document']['name']))
				{

				$file = $this->do_upload('document');
				if($file['response'] == true)
				{
					$document = $file['data']['file_name'];
				}else

				{
					$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$document = $row['document'];
					$this->session->set_flashdata('document', $file['data']['error']);
				}

				}else
				{
					$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$document = $row['document'];
				}
			

				

					 $insertRow = array(
					 	'first_name' =>$_POST['first_name'], 
					 	'last_name' =>$_POST['last_name'], 
					 	'email' =>$_POST['email'], 
					 	'mobile' =>$_POST['mobile'], 
					 	'address' =>$_POST['address'], 
					 	'role' => 'Lawyer',
					 	'password' =>md5($_POST['password']), 
					 	'certificate' =>$certificate, 
					 	'document' =>$document, 
					 	 
					 );
					
						$insertRow = $this->common->insert('users',$insertRow);

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Member created successfully!');
			 			    redirect(base_url('admin/member'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/member/add'));
						}	
						
 					}
					else
					{
						$this->add();
					}
					


		}else
		{
			redirect(base_url('admin/member/add'));
		}

		


		


	}





	public function edit($id)
	{
		

		$data['title'] = 'Member Manager';
		$data['breadcrumb_title'] = 'Member Manager';
		$data['breadcrumb_menu'] = 'Edit Member';
		$data['section_title'] = 'Edit Member';
		$data['row'] = $this->common->getSingleRecordById($id , 'users');

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/member/edit');
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

				

				if(!empty($_FILES['certificate']['name']))
				{

				$file = $this->do_upload('certificate');
				if($file['response'] == true)
				{
					$certificate = $file['data']['file_name'];
				}else

				{
					$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$certificate = $row['certificate'];
					$this->session->set_flashdata('certificate', $file['data']['error']);
				}

				}else
				{
					$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$certificate = $row['certificate'];
				}







				if(!empty($_FILES['document']['name']))
				{

				$file = $this->do_upload('document');
				if($file['response'] == true)
				{
					$document = $file['data']['file_name'];
				}else

				{
					$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$document = $row['document'];
					$this->session->set_flashdata('document', $file['data']['error']);
				}

				}else
				{
					$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$document = $row['document'];
				}


			
			
			
			

			if ($this->form_validation->run()) 
					{

						$UpdateRow = array(
					 	'first_name' =>$_POST['first_name'], 
					 	'last_name' =>$_POST['last_name'],
					 	'mobile' =>$_POST['mobile'], 
					 	'password' =>md5($_POST['password']), 
					 	'address' =>$_POST['address'], 
					 	'certificate' =>$certificate, 
					 	'document' =>$document, 
					 
					 );
					
						$insertRow = $this->common->update($UpdateRow , $id , 'users');

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Member update successfully!');
			 			   redirect(base_url('admin/member/edit/'.$id));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/member/edit/'.$id));
						}	
						
 					}
					else
					{
						$this->edit($id);
					}
					


		}else
		{
			redirect(base_url('admin/member/edit/'.$id));
		}

		


		


	}



		private function do_upload($upload){

				$output = array();
				$config = array(
				'upload_path' => "./upload/",
				'allowed_types' => "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp",
				$config['encrypt_name'] = TRUE,
				//'overwrite' => TRUE,
				//'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				//'max_height' => "768",
				//'max_width' => "1024"
				);

				$this->load->library('upload', $config);
				if($this->upload->do_upload($upload))
				{
				$data = $this->upload->data();
				$output['response'] = true;
				$output['data'] = $data;
				}
				else
				{
				$error = array('error' => $this->upload->display_errors());
				$output['response'] = false;
				$output['data'] = $error;
				
				}

				return $output;
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
							$this->session->set_flashdata('success_message', 'Member status update successfully!');
			 			    redirect(base_url('admin/member'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/member/edit/'.$id));
						}

   }
}
