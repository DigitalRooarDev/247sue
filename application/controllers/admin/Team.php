<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team extends CI_Controller
{

    function __construct() {
		Parent::__construct();
			check_login_admin();
		$this->load->model('TeamModel');   
	}
    public function index()
    {
        $data = array();
        $data['title'] = 'Team Manager';
		$data['breadcrumb_title'] = 'Team Manager';
		$data['breadcrumb_menu'] = 'Team List';
		$data['section_title'] = 'Team List';
        $data['rows'] = $this->TeamModel->get_team();

        $this->load->view('admin/include/header',$data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/team/index',$data);
        $this->load->view('admin/include/footer');
        
        
    }

    public function status($id='',$status='')
   {

   		//  $id = $this->uri->segment(5);
   	    // $status = $this->uri->segment(6);

   		//echo $id ." " . $status ;

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
					
	$update = $this->TeamModel->update($UpdateRow , $id);

	if($update)
						{
							$this->session->set_flashdata('success_message', 'User status update successfully!');
			 			    redirect(base_url('admin/team'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/team/edit/'.$id));
						}

   }


    public function add()
    {
		$data['title'] = 'Team Manager';
		$data['breadcrumb_title'] = 'Team Manager';
		$data['breadcrumb_menu'] = 'Add Team Member';
		$data['section_title'] = 'Add Team Member';
		// $data['row'] = $this->TestomonialModel->getSingleRecordById($id);

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/team/add');
		$this->load->view('admin/include/footer');


    }


    public function edit($id='')
    {
		$data['title'] = 'Team Manager';
		$data['breadcrumb_title'] = 'Team Manager';
		$data['breadcrumb_menu'] = 'Edit Team Member';
		$data['section_title'] = 'Edit Team Member';
		$data['row'] = $this->TeamModel->getSingleRecordById($id);

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/team/edit',$data);
		$this->load->view('admin/include/footer');


    }

    public function update($id='')
    {
        //echo "<pre>"; print_r($_POST); die; 
        if(isset($_POST) && !empty($_POST))
		{

				$singleRow = $this->TeamModel->getSingleRecordById($id);
		
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');


            if(!empty($_FILES['profile']['name']))
				{

				$file = $this->do_upload('profile');
				if($file['response'] == true)
				{
					$profile = $file['data']['file_name'];
				}else

				{
					//$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$profile = $row['profile'];
					$this->session->set_flashdata('profile', $file['data']['error']);
				}

				}else
				{
					//$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$profile = $row['profile'];
				}

			if ($this->form_validation->run()) 
					{

						$UpdateRow = array(
					 	'name' =>$_POST['name'], 
					 	'designation' =>$_POST['designation'],
					 	'description' =>$_POST['description'], 
						'user_order' =>$_POST['order'],
					 	'profile' =>$profile, 
					 
					 );
					
						$insertRow = $this->TeamModel->update($UpdateRow,$id);

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Team Member update successfully!');
			 			    redirect(base_url('admin/team'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/team/edit/'.$id));
						}	
						
 					}
					else
					{
						$this->edit($id);
					}
					


		}else
		{
			redirect(base_url('admin/team/edit/'.$id));
		}
    }

    public function new()
    {
        //echo "<pre>"; print_r($_POST); die; 
        if(isset($_POST) && !empty($_POST))
		{

				
		
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('designation', 'Designation', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');



            if(!empty($_FILES['profile']['name']))
				{

				$file = $this->do_upload('profile');
				if($file['response'] == true)
				{
					$profile = $file['data']['file_name'];
				}else

				{
					//$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$profile = $row['profile'];
					$this->session->set_flashdata('profile', $file['data']['error']);
				}

				}else
				{
					//$row = $this->db->get_where('users', array('id' => $id))->row_array();
					$profile = $row['profile'];
				}


			if ($this->form_validation->run()) 
					{

						$AddRow = array(
					 	'name' =>$_POST['name'], 
					 	'designation' =>$_POST['designation'],
					 	'description' =>$_POST['description'], 
					 	'user_order' =>$_POST['order'], 
					 	'profile' =>$profile, 
					 
					 );
					
						$NewRow = $this->TeamModel->insert($AddRow);

						if($NewRow)
						{
							$this->session->set_flashdata('success_message', 'Team Member Added successfully!');
			 			    redirect(base_url('admin/team'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/team/add'));
						}	
						
 					}
					else
					{
						$this->add();
					}
					


		}else
		{
			redirect(base_url('admin/team/add'));
		}
    }

    public function delete($id)
   {
       $this->db->delete('team', array('id' => $id));
       echo 'Deleted successfully.';
   }

   public function do_upload($upload){

    $output = array();
    $config = array(
    'upload_path' => "./upload/",
    'allowed_types' => "gif|jpg|png",
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
    
}