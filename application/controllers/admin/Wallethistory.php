<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wallethistory extends CI_Controller {

	function __construct() {
		Parent::__construct();
		check_login_admin();
		$this->load->model('Common_model', 'common');  
	}

	public function index()
	{
		$data['title'] = 'Fund Request  Manager';
		$data['breadcrumb_title'] = 'Fund Request  Manager';
		$data['breadcrumb_menu'] = 'Fund Request  Manager';
		$data['section_title'] = 'Fund Request  List';
		$data['rows'] = $this->common->walletHistory();

		$this->load->view('admin/include/header',$data);
		$this->load->view('admin/include/left');
		$this->load->view('admin/wallethistory/index');
		$this->load->view('admin/include/footer');
	}

   public function status()
   {
	$id =  (isset($_GET['id'])) ? $_GET['id'] : '';
    $status = (isset($_GET['st'])) ? $_GET['st'] : '';

    $requestData = $this->common->getSingleRecordById($id,'wallet_request');

    if($requestData['status'] == 'Accepted' ||  $requestData['status'] == 'Rejected')
    {
    	
    	$this->session->set_flashdata('error_message', 'The status of this request is already changed, you cannot change it again.');
	     redirect(base_url('admin/Wallethistory'));
	     return true;
	   	exit();
    }

    
    $UpdateRow = array(
   	   	'status' =>$status,
   	   	'updated_date' =>date("Y-m-d"),
   	   );
    $update = $this->common->update($UpdateRow , $id , 'wallet_request');
    if($update)
		{
			$row = $this->common->getSingleRecordById($id,'wallet_request');
			// if(!empty($row) &&  $status == 'Accepted')
			// {
			// 	$transcation_data['user_id'] = $row['user_id'];
			// 	$transcation_data['txn_no'] = rand();
			// 	$transcation_data['txn_desc'] = 'Wallet payment has been approved';
			// 	$transcation_data['amount'] = $row['amount'];
			// 	$transcation = $this->common->insert('transactions', $transcation_data);

			// 	$userDetails = $this->common->getSingleRecordById($row['user_id'],'users');

			// 	$oldWalletAmt = $userDetails['wallet'];
			// 	$approvedAmout = $row['amount'];
			// 	$updateWalletAmount = $oldWalletAmt - $approvedAmout;
			// 	$updateWallet = array();
			// 	$updateWallet['wallet'] = $updateWalletAmount;
			// 	$this->common->update($updateWallet, $row['user_id'], 'users');
			// }

			if(!empty($row) &&  $status == 'Rejected')
			{
				$transcation_data['user_id'] = $row['user_id'];
				$transcation_data['txn_no'] = rand();
				$transcation_data['txn_desc'] = 'Wallet payment has been rejected';
				$transcation_data['amount'] = $row['amount'];
				$transcation = $this->common->insert('transactions', $transcation_data);

				$userDetails = $this->common->getSingleRecordById($row['user_id'],'users');

				$oldWalletAmt = $userDetails['wallet'];
				$approvedAmout = $row['amount'];
				$updateWalletAmount = $oldWalletAmt + $approvedAmout;
				$updateWallet = array();
				$updateWallet['wallet'] = $updateWalletAmount;
				$this->common->update($updateWallet, $row['user_id'], 'users');
			}


			

			$this->session->set_flashdata('success_message', 'Status update successfully!');
			    redirect(base_url('admin/Wallethistory'));
		}else
		{
			$this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
			redirect(base_url('admin/Wallethistory'));
		}

   }

}
