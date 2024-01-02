<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
		$this->load->model('Request_model', 'request');  
	}

	public function index(){
		$data['title'] = 'Request Manager';
		$data['breadcrumb_title'] = 'Request Manager';
		$data['breadcrumb_menu'] = 'Request Manager';
		$data['section_title'] = 'Request List';
		$data['rows'] = $this->request->getrequest('Default');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/request/index');
		$this->load->view('admin/include/footer');
	}


	public function movecourtrequest(){
		$data['title'] = 'Request Manager';
		$data['breadcrumb_title'] = 'Request Manager';
		$data['breadcrumb_menu'] = 'Request Manager';
		$data['section_title'] = 'Request List';

		$plan_id = $_POST['plan_id'] ?? '';
		$client_id = $_POST['client_id'] ?? '';
		$laywer_id = $_POST['laywer_id'] ?? '';

		$data['rows'] = $this->request->getrequest('Move_to_court', $plan_id, $client_id, $laywer_id);

		$data['clientList'] = $this->db->from('users')->where('role','Client')->get()->result_array();
		$data['lawyerList'] = $this->db->from('users')->where('role','Lawyer')->get()->result_array();

		$data['plan_id'] = $plan_id;
		$data['client_id'] = $client_id;
		$data['laywer_id'] = $laywer_id;
		
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/request/index');
		$this->load->view('admin/include/footer');
	}

	public function userrequest($id){
		$data['title'] = 'Request Manager';
		$data['breadcrumb_title'] = 'Request Manager';
		$data['breadcrumb_menu'] = 'Request Manager';
		$data['section_title'] = 'Request List';
		$data['rows'] =  $this->request->getrequestByUserID(array('client_id'=>$id) , $request_status = '');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/request/index');
		$this->load->view('admin/include/footer');
	}

	public function viewinfo($id = ''){
		if(!empty($id)){
			$data['title'] = 'Request Information';
			$data['breadcrumb_title'] = 'Request Information';
			$data['breadcrumb_menu'] = 'Request Information';
			$data['section_title'] = 'Request Information';
			$data['id'] = $id;
			$this->load->view('admin/include/header',$data);
			$this->load->view('admin/include/left');
			$this->load->view('admin/request/viewdetail');
			$this->load->view('admin/include/footer');
		}else{
			redirect(base_url('admin/request'));
		}
	}


	public function add(){
		$data['title'] = 'User Manager';
		$data['breadcrumb_title'] = 'User Manager';
		$data['breadcrumb_menu'] = 'Add User';
		$data['section_title'] = 'Add User';
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/user/add');
		$this->load->view('admin/include/footer');
	}



	public function save(){
		if(isset($_POST) && !empty($_POST)){
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required|is_unique[users.email]');
			$this->form_validation->set_rules('mobile', 'mobile', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			if ($this->form_validation->run()) {
				$insertRow = array(
				'first_name' =>$_POST['first_name'], 
				'last_name' =>$_POST['last_name'], 
				'email' =>$_POST['email'], 
				'mobile' =>$_POST['mobile'], 
				'role' => 'Customer',
				'password' =>md5($_POST['password']), 
				);
				$insertRow = $this->common->insert('users',$insertRow);
				if($insertRow){
					$this->session->set_flashdata('success_message', 'Item created successfully!');
					redirect(base_url('admin/user'));
				}else{
					$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
					redirect(base_url('admin/user/add'));
				}	
			}
			else{
				$this->add();
			}
		}else{
			redirect(base_url('admin/user/add'));
		}
	}

	public function edit($id){
		$data['title'] = 'User Manager';
		$data['breadcrumb_title'] = 'User Manager';
		$data['breadcrumb_menu'] = 'Edit User';
		$data['section_title'] = 'Edit User';
		$data['row'] = $this->common->getSingleRecordById($id , 'users');
		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/user/edit');
		$this->load->view('admin/include/footer');
	}


	public function assign(){
            $this->load->model('Api_model', 'api');  
			if(isset($_POST) && !empty($_POST)){
			$UpdateRow = array(
			'laywer_id' =>$_POST['lawyerid'],
			'progress' =>'Pending' 
			);
			$Update = $this->common->update($UpdateRow , $_POST['id'] , 'request');
			if($Update){
				// Sending push notification to Lawyer 
				// Get case Detail by id
				$case_detail = $this->common->getSingleRecordById($_POST['id'] , 'request');
				$lawyer_id = $_POST['lawyerid'];
				$title = 'A New Case has been assigned.';
				$message = 'Case '.$case_detail['case_name'].' has been assigned to you. Goto Case List to see the detail';
				$this->sendpushnotification($lawyer_id, $message, $title);
                                $user_detailmail = $this->api->getSingleRecordById($lawyer_id, 'users');
//                                print_r($user_detailmail);exit;
                                $this->common->sendemail($user_detailmail['email'],$title,$message);
				$this->session->set_flashdata('success_message', 'Lawyer assign successfully!');
			}else{
				$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
			}
		}
		redirect(base_url('admin/request'));
	}

	// Sending Push notification functionality. 
	public function sendpushnotification($user_id='', $message='', $title=''){
		/*$user_id = '37';
		$message = 'This is notification for you.';
		$title = 'New notification';*/
		$user_detail = $this->common->getSingleRecordById($user_id , 'users');
		$regId = $user_detail['fcm_device_id'];
		// INCLUDE YOUR FCM FILE
		$notification = array();
		$arrNotification= array();			
		$arrData = array();											
		$arrNotification["body"] = $message;
		$arrNotification["title"] = $title;
		$this->common->send_notification($regId, $arrNotification,"Android");
		return true;
	}

   public function delete($id){
       $this->db->delete('users', array('id' => $id));
       echo 'Deleted successfully.';
   }

	public function status(){
		$id = $this->uri->segment(4);
		$status = $this->uri->segment(5);
		if($status == '1'){
			$st = '0';
		}else{
			$st = '1';
		}
		$UpdateRow = array(
		'status' =>$st, 
		);
		$update = $this->common->update($UpdateRow , $id , 'request');
		if($update){
			$this->session->set_flashdata('success_message', 'Request status update successfully!');
			redirect(base_url('admin/request'));
		}else{
			$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
			redirect(base_url('admin/request'));
		}
	}

	
	public function movecourt($id){
		$UpdateRow = array(
		'request_status' =>'Move_to_court', 
		);
		$update = $this->common->update($UpdateRow , $id , 'request');
		if($update){
			$this->session->set_flashdata('success_message', 'Request status update successfully!');
			redirect(base_url('admin/request'));
		}else{
			$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
			redirect(base_url('admin/request'));
		}
	}

	function checkassignClient(){
		$output = array();
		$output['result'] = false;
		$output['data'] = '';
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$row = $this->db->get_where('request', array('id' => $_POST['id']))->row_array();
			if($row['laywer_id'] > 0){
				$lawyer = $this->db->get_where('users', array('role' => 'Lawyer', 'id'=>$row['laywer_id']))->row_array();
				$output['result'] = true;
				$output['data'] = $lawyer['first_name'].' '.$lawyer['last_name'];
			}
		}
		header('Content-Type: application/json');
		echo json_encode($output);
	}


	function paycommission(){
		$output = array();
		$output['result'] = false;
		$output['data'] = '';
		if (isset($_POST['requestid']) && !empty($_POST['requestid'])) {
			$updateData = array('commission' => $_POST['commission'],'commission_date'=>date('Y-m-d'));
			$this->db->where('id', $_POST['requestid']);
			$this->db->update('request', $updateData); 
			$output['result'] = true;
		}
		header('Content-Type: application/json');
		echo json_encode($output);
	}


	function getevidence(){
		$output = array();
		$output['result'] = false;
		$output['data'] = '';
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			//die('This is found'); 
			$html = '';
			//$row = $this->db->get_where('request', array('id' => $_POST['id']))->row_array();
			$row  = $this->request->getAllEvedenceByCase($_POST['id']);
			//echo "<pre>";
			//print_r($row); die;
			if(!empty($row)){
				$html .= '<ul class="evelist">';
				foreach ($row  as $key => $value) { 
					$html .= '<li><span><i class="fa  fa-camera"></i>  '.$value["title"].' </span> <label><a href="' .$value["url"]. '" download >View</a></label></li>';
				}
				$html .= '<ul>';
				$output['result'] = true;
				$output['data'] = $html;
			}else{
				$html .= '<div class="row">';
				$html .= '<div class="col-sm-12"><h3>Not Found Evidence</h3></div>';
				$html .= '</div>';
				$output['result'] = false;
				$output['data'] = $html;
			}
		}
		header('Content-Type: application/json');
		echo json_encode($output);
	}



	function commissionstatus(){
		$output = array();
		$output['result'] = false;
		$output['data'] = '';
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			$row = $this->db->get_where('request', array('id' => $_POST['id']))->row_array();
			if($row['co_status'] == 'Accept'){
				$status = 'Accept';
				$statushtml = '<div class="alert alert-success alert-dismissible" role="alert"><h3><strong><i class="icon fa fa-check"></i> You have accepted the fees added by lawyer. </strong></h3>
				<div>
				<p><label>Compensasion Amount  : </label> NGN '.$row['amount'].' </p>
				<p><label>Admin Compensation Percentage  : </label> '.$row['commission_percentage'].' % </p>
				<p><label>Admin Compensation Amount  : </label> NGN '.$row['commission'].'</p>
				<p><label>Lawyer Compensation Percentage  : </label> '.$row['lawyer_percentage'].' % </p>
				<p><label>Lawyer Compensation Amount  : </label> NGN '.$row['lawyer_amount'].' </p>
				<p><label>Client Compensation Amount  : </label> NGN '.$row['client_compensasion'].' </p>
				</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>';
			}
			elseif ($row['co_status'] == 'Reject') {
				$status = 'Reject';
				$statushtml = '<div class="alert alert-danger alert-dismissible" role="alert">
				<h3> <strong><i class="icon fa fa-warning"></i>  You have rejected the fees added by lawyer.</strong></h3>
				<div>
				<p><label>Compensasion Amount  : </label> '.$row['amount'].' </p>
				</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>';
			}elseif ($row['co_status'] == 'Request') {
				$status = 'Request';
				$statushtml = '<div class="alert alert-info alert-dismissible" role="alert"><h3><strong><i class="icon fa fa-check"></i> Lawyer have updated the Case fees. </strong></h3>
				<div>
				<p><label>Compensasion Amount  : </label> '.$row['amount'].' </p>
				</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>';
			}
			else
			{
				$status = 'Default';
				$statushtml = '<div class="alert alert-warning alert-dismissible" role="alert"><h3><strong><i class="icon fa fa-check"></i> Lawyer have not updated the fees yet. </strong></h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>';
			}
			$output['data'] = $statushtml;
			$output['status'] = $status;
			$output['result'] = true;
		}
		header('Content-Type: application/json');
		echo json_encode($output);
	}





	function commissionstatuschange(){
		$this->load->model('Api_model', 'api');  
		$output = array();
		$output['result'] = false;
		$output['data'] = '';
		if (isset($_POST['id']) && !empty($_POST['id'])) {
			
			// Admin Commision
			$condition = array('field_key'=>'commission');
			$global_setting = $this->api->getAllRecordsE('settings',$condition);
			$commission_percentage = $global_setting[0]['field_value'];	
			
			$case_detail = $this->common->getSingleRecordById($_POST['id'], 'request');
			$client_id = $case_detail['client_id'];
			$client_detail = $this->common->getSingleRecordById($client_id, 'users');
			$client_wallet = $client_detail['wallet'];
			
			$laywer_id = $case_detail['laywer_id'];
			$lawyer_detail = $this->common->getSingleRecordById($laywer_id, 'users');
			$lawyer_wallet = $lawyer_detail['wallet'];
			
			$plan_detail = $this->api->current_membership_plan_params($client_id);
			$lawyer_percentage = $plan_detail['service']['lawyer_percentage'];
			$compensasion_added_by_lawyer = $case_detail['amount'];
			
			$admin_commision = ($commission_percentage/100)*$compensasion_added_by_lawyer;
			$remaining_amount = $compensasion_added_by_lawyer - $admin_commision;
			$lawyer_percentage_amount = ($lawyer_percentage/100)*$remaining_amount;
			
			$compensasion_for_client = $remaining_amount - $lawyer_percentage_amount;
			
			$updateData = array(
							'co_status' => $_POST['st'],
							'lawyer_percentage' => $lawyer_percentage,
							'lawyer_amount' => $lawyer_percentage_amount,
							'client_compensasion' => $compensasion_for_client,
							);
			
			$this->db->where('id', $_POST['id']);
			$this->db->update('request', $updateData);
			
			//Update Lawyer Wallet Data
			$lawyer_wallet_new = $lawyer_wallet+$lawyer_percentage_amount;
			$lawyer_update_arr = array('wallet'=>$lawyer_wallet_new);
			$this->db->where('id', $laywer_id);
			$this->db->update('users', $lawyer_update_arr);
			
			$ltranscation_data['user_id'] = $laywer_id;
			$ltranscation_data['txn_no'] = '';
			$ltranscation_data['txn_desc'] = 'Received Compensasion Percentage for the Case ID #'.$_POST['id'];
			$ltranscation_data['amount'] = $lawyer_percentage_amount;
			$ltranscation = $this->common->insert('transactions', $ltranscation_data);
			
			  $user_detailmail = $this->api->getSingleRecordById($lawyer_id, 'users');
                                $this->common->sendemail($user_detailmail['email'],'Received Compensasion Percentage','Received Compensasion Percentage for the Case ID #'.$_POST['id']);
			  
			//Update Client Wallet Data
			$client_wallet_new = $client_wallet+$compensasion_for_client;
			$client_update_arr = array('wallet'=>$client_wallet_new);
			$this->db->where('id', $client_id);
			$this->db->update('users', $client_update_arr);
			
			$ctranscation_data['user_id'] = $client_id;
			$ctranscation_data['txn_no'] = '';
			$ctranscation_data['txn_desc'] = 'Received Compensasion amount from Case ID #'.$_POST['id'];
			$ctranscation_data['amount'] = $compensasion_for_client;
			$ctranscation = $this->common->insert('transactions', $ctranscation_data);
                        $user_detailmail = $this->api->getSingleRecordById($client_id, 'users');
                                $this->common->sendemail($user_detailmail['email'],'Received Compensasion Percentage','Received Compensasion Percentage for the Case ID #'.$_POST['id']);
			
			$row = $this->db->get_where('request', array('id' => $_POST['id']))->row_array();
			if($row['co_status'] == 'Accept'){
				$status = 'Accept';
				$statushtml = '<div class="alert alert-success alert-dismissible" role="alert"><h3><strong><i class="icon fa fa-check"></i> You have accepted the fees added by lawyer. </strong></h3>
				<div>
				<p><label>Compensasion Amount  : </label> NGN '.$row['amount'].' </p>
				<p><label>Admin Compensation Percentage  : </label> '.$row['commission_percentage'].' % </p>
				<p><label>Admin Compensation Amount  : </label> NGN '.$row['commission'].'</p>
				<p><label>Lawyer Compensation Percentage  : </label> '.$row['lawyer_percentage'].' % </p>
				<p><label>Lawyer Compensation Amount  : </label> NGN '.$row['lawyer_amount'].' </p>
				<p><label>Client Compensation Amount  : </label> NGN '.$row['client_compensasion'].' </p>
				</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>';
			}
			elseif ($row['co_status'] == 'Reject') {
				$status = 'Reject';
				$statushtml = '<div class="alert alert-danger alert-dismissible" role="alert">
				<h3> <strong><i class="icon fa fa-warning"></i>  You have rejected the fees added by lawyer.</strong></h3>
				<div>
				<p><label>Compensasion Amount  : </label> '.$row['amount'].' </p>
				</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>';
			}elseif ($row['co_status'] == 'Request') {
				$status = 'Request';
				$statushtml = '<div class="alert alert-info alert-dismissible" role="alert"><h3><strong><i class="icon fa fa-check"></i> Lawyer have updated the Case fees. </strong></h3>
				<div>
				<p><label>Compensasion Amount  : </label> '.$row['amount'].' </p>
				</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>';
			}else{
				$status = 'Default';
				$statushtml = '<div class="alert alert-warning alert-dismissible" role="alert"><h3><strong><i class="icon fa fa-check"></i> Lawyer have not updated the fees yet. </strong></h3><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>';
			}
			$output['data'] = $statushtml;
			$output['status'] = $status;
			$output['result'] = true;
		}
		header('Content-Type: application/json');
		echo json_encode($output);
	}
		  
	
	





	// Fetch list of Lawyer by distance
	function getAllLawyerBynearlocationBycaseID(){
		$output = array();
		$output['result'] = false;
		$output['data'] = '';
		if(isset($_POST['case_id']) && !empty($_POST)){
			$getdata = $this->request->AllLawyerBynearlocationBycaseID($_POST['case_id']);
			if ($getdata) {
				$list = '';
				$list .= '<input type="hidden" class="lawyer__id__insert" value="0">';
				$list .= '<input type="hidden" class="case__id" value="'.$_POST['case_id'].'">';
				$i=1; 
				foreach ($getdata as $key => $value) {
					if(isset($value['distance'])){
						$distance = '('.$value['distance'].' KM)';
					}else{
						$distance = '';
					}
					$list .='<div class="list__row">
					<div class="col__1 col__0">
					'.$i.'
					</div>
					<div class="col__1">
					<input type="radio" class="lawyer_ids" name="laywer" value="'.$value["id"].'">
					</div>
					<div class="col__2">
					'.$value["first_name"].' '.$value["last_name"].' ,'.$value["email"].' , '.$value["mobile"].'
					<br>
					<small>  '.$value["address"].' '.$distance.'   </small> 
					</div>
					</div>';
					$i++; 
				}
				$output['result'] = true;
				$output['data'] = $list;
			}else{
				$output['result'] = 'Yes';
				$output['data'] ='<h4 style="text-align:center;">Not Found</h4>';
			}
		}
		header('Content-Type: application/json');
		echo json_encode($output);
	}

	// Assign Lawyer for the case
	function assign__lawyer(){
		$output = array();
                
                $this->load->model('Api_model', 'api');  
		$output['result'] = false;
		$output['data'] = '';
		if(isset($_POST['id']) && !empty($_POST)){
			$check = $this->request->checkalrreadyAssignLawyerIncase($_POST['id'] , $_POST['case_id']);
			if ($check) {
				$output['result'] = true;
				$output['data'] = '<div class="alert alert-danger" role="alert">Lawyer assign already!</div>';
			}else{
				$action = array();
				$action['lawyer_id'] =  $_POST['id'];
				$action['case_id'] = $_POST['case_id'];
				$action['status'] = 'S';
				$insertid = $this->common->insert('case_lawyer',$action);
				if ($insertid) {
					// Sending Push Notification to Lawyer
					$case_detail = $this->common->getSingleRecordById($_POST['case_id'] , 'request');
					$lawyer_id = $_POST['id'];
					$title = 'A New Case has been assigned.';
					$message = 'Case '.$case_detail['case_name'].' has been assigned to you. Goto Case List to see the detail';
					$this->sendpushnotification($lawyer_id, $message, $title);
					 $user_detailmail = $this->api->getSingleRecordById($_POST['id'], 'users');
                                $this->common->sendemail($user_detailmail['email'],$title,$message);
					$output['result'] = true;
					$output['data'] = '<div class="alert alert-success" role="alert">Lawyer successfully assigned</div>';
				}else{
					$output['result'] = true;
					$output['data'] = '<div class="alert alert-danger" role="alert">Opps! somthing wrong.</div>';
				}
			}
		} 
		header('Content-Type: application/json');
		echo json_encode($output);
	}







/*function distance($lat1='27.25441338323543', $lon1='75.45194258197172', $lat2='27.251577', $lon2='75.414791', $unit='K') {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      echo ($miles * 1.609344);
    } else if ($unit == "N") {
      echo  ($miles * 0.8684);
    } else {
      echo  $miles;
    }
  }
}
*/

//27.25441338323543, 75.45194258197172



}
