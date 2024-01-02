<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faq extends CI_Controller
{

    function __construct() {
		Parent::__construct();
			check_login_admin();
		$this->load->model('FaqModel');   
	}
    public function index()
    {
        $data = array();
        $data['title'] = 'FAQ Manager';
		$data['breadcrumb_title'] = 'FAQ Manager';
		$data['breadcrumb_menu'] = 'FAQ List';
		$data['section_title'] = 'FAQ List';
        $data['rows'] = $this->FaqModel->get_faq();

        $this->load->view('admin/include/header',$data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/faq/index',$data);
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
					
	$update = $this->FaqModel->update($UpdateRow , $id);

	if($update)
						{
							$this->session->set_flashdata('success_message', 'FAQ status update successfully!');
			 			    redirect(base_url('admin/faq'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/faq/edit/'.$id));
						}

   }


    public function add()
    {
		$data['title'] = 'FAQ Manager';
		$data['breadcrumb_title'] = 'FAQ Manager';
		$data['breadcrumb_menu'] = 'Add FAQ';
		$data['section_title'] = 'Add FAQ';
		// $data['row'] = $this->TestomonialModel->getSingleRecordById($id);

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/faq/add');
		$this->load->view('admin/include/footer');


    }


    public function edit($id='')
    {
		$data['title'] = 'FAQ Manager';
		$data['breadcrumb_title'] = 'FAQ Manager';
		$data['breadcrumb_menu'] = 'Edit FAQ';
		$data['section_title'] = 'Edit FAQ';
		$data['row'] = $this->FaqModel->getSingleRecordById($id);

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/faq/edit',$data);
		$this->load->view('admin/include/footer');


    }

    public function update($id='')
    {
        //echo "<pre>"; print_r($_POST); die; 
        if(isset($_POST) && !empty($_POST))
		{

				$singleRow = $this->FaqModel->getSingleRecordById($id);
		
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'required');


           
			if ($this->form_validation->run()) 
					{

						$UpdateRow = array(
					 	'title' =>$_POST['title'], 
					 	'description' =>$_POST['description'],
						 'faq_order' =>$_POST['order'],  
					 
					 );
					
						$insertRow = $this->FaqModel->update($UpdateRow,$id);

						if($insertRow)
						{
							$this->session->set_flashdata('success_message', 'FAQ update successfully!');
			 			    redirect(base_url('admin/faq'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/faq/edit/'.$id));
						}	
						
 					}
					else
					{
						$this->edit($id);
					}
					


		}else
		{
			redirect(base_url('admin/testomonial/edit/'.$id));
		}
    }

    public function new()
    {
        //echo "<pre>"; print_r($_POST); die; 
        if(isset($_POST) && !empty($_POST))
		{

				
		
			$this->form_validation->set_rules('title', 'Title', 'trim|required');
			$this->form_validation->set_rules('description', 'Description', 'required');


			if ($this->form_validation->run()) 
					{

						$AddRow = array(
					 	'title' =>$_POST['title'], 
					 	'description' =>$_POST['description'], 
					 	'faq_order' =>$_POST['order'], 
					 
					 );
					
						$NewRow = $this->FaqModel->insert($AddRow);

						if($NewRow)
						{
							$this->session->set_flashdata('success_message', 'FAQ Added successfully!');
			 			    redirect(base_url('admin/faq'));
						}else
						{
							$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
							redirect(base_url('admin/faq/add'));
						}	
						
 					}
					else
					{
						$this->add();
					}
					


		}else
		{
			redirect(base_url('admin/testomonial/add'));
		}
    }

    public function delete($id)
   {
       $this->db->delete('faq', array('id' => $id));
       echo 'Deleted successfully.';
   }

   
    
}