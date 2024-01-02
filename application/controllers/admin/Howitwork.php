<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Howitwork extends CI_Controller
{

    function __construct() {
		Parent::__construct();
			check_login_admin();
		$this->load->model('HowitworkModel');   
	}
    public function index()
    {
        $data = array();
        $data['title'] = 'How it work Manager';
		$data['breadcrumb_title'] = 'How it work Manager';
		$data['breadcrumb_menu'] = 'How it work Manager';
		$data['section_title'] = 'How it work Manager';
        $data['rows'] = $this->HowitworkModel->get_howitwork();

        $this->load->view('admin/include/header',$data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/howitwork/index',$data);
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
					
	$update = $this->HowitworkModel->update($UpdateRow , $id);

	if($update)
						{
							$this->session->set_flashdata('success_message', 'status update successfully!');
			 			    redirect(base_url('admin/howitwork'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/howitwork/'.$id));
						}

   }


    public function add()
    {
		$data['title'] = 'How it work Manager ';
		$data['breadcrumb_title'] = 'How it work Manager';
		$data['breadcrumb_menu'] = 'Add work';
		$data['section_title'] = 'Add work';
		// $data['row'] = $this->TestomonialModel->getSingleRecordById($id);

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/howitwork/add');
		$this->load->view('admin/include/footer');


    }


    public function edit($id='')
    {
		$data['title'] = 'Team Manager';
		$data['breadcrumb_title'] = 'Team Manager';
		$data['breadcrumb_menu'] = 'Edit Team Member';
		$data['section_title'] = 'Edit Team Member';
		$data['rows'] = $this->HowitworkModel->getSingleRecordById($id);

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/howitwork/edit',$data);
		$this->load->view('admin/include/footer');


    }

    public function update($id='')
    {
        //echo "<pre>"; print_r($_POST); die; 
        if(isset($_POST) && !empty($_POST))
		{

				$singleRow = $this->HowitworkModel->getSingleRecordById($id);
		
				$this->form_validation->set_rules('icon', 'Icon', 'required');
				$this->form_validation->set_rules('title', 'Title', 'required');
				$this->form_validation->set_rules('order', 'Order', 'required');
				$this->form_validation->set_rules('description', 'Description', 'required');


           

			if ($this->form_validation->run()) 
					{

						$UpdateRow = array(
							'icon' =>$_POST['icon'], 
							'title' =>$_POST['title'],
							'description' =>$_POST['description'], 
							'order' =>$_POST['order'], 
						
						);
					   
					
						$insertRow = $this->HowitworkModel->update($UpdateRow,$id);

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'Work update successfully!');
			 			    redirect(base_url('admin/howitwork'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/howitwork/edit/'.$id));
						}	
						
 					}
					else
					{
						$this->edit($id);
					}
					


		}else
		{
			redirect(base_url('admin/howitwork/edit/'.$id));
		}
    }

    public function new()
    {
        //echo "<pre>"; print_r($_POST); die; 
        if(isset($_POST) && !empty($_POST))
		{

				
		
			$this->form_validation->set_rules('icon', 'Icon', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('order', 'Order', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');



            


			if ($this->form_validation->run()) 
					{

						$AddRow = array(
					 	'icon' =>$_POST['icon'], 
					 	'title' =>$_POST['title'],
					 	'description' =>$_POST['description'], 
					 	'order' =>$_POST['order'], 
					 
					 );
					
						$NewRow = $this->HowitworkModel->insert($AddRow);

						if($NewRow)
						{
							$this->session->set_flashdata('success_message', 'Work Added successfully!');
			 			    redirect(base_url('admin/howitwork'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/howitwork/add'));
						}	
						
 					}
					else
					{
						$this->add();
					}
					


		}else
		{
			redirect(base_url('admin/howitwork/add'));
		}
    }

    public function delete($id)
   {
       $this->db->delete('how_it_work', array('id' => $id));
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