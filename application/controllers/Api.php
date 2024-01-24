<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('bunnycdn-storage.php');

class Api extends CI_Controller
{

    function __construct()
    {
        Parent::__construct();
        $this->load->model('Api_model', 'api');
        $this->fcm_device_id = '32423jk4hjk32h4jk32h4jk32h4jk32h4kj32h4kj32h4kj2h4kj3h4kj2h4jk32h4kj32h4j32h34kj';
        $this->device_type = 'Android/IOS';

    }

    // Login API
    public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['username']) && isset($data['password'])) {
            $username = $data['username'];
            $password = $data['password'];
            $fcm_device_id = $data['fcm_device_id'];
            $device_type = $data['device_type'];
            // Check records from database if exists or not
            $userexists = $this->api->validate_user($username, $password);
            $data_array = array();
            $dataArray['l_location'] = $data['location'];
            $dataArray['l_latitude'] = $data['latitude'];
            $dataArray['l_longitude'] = $data['longitude'];
            $data_array['fcm_device_id'] = $fcm_device_id;
            $data_array['device_type'] = $device_type;

            if ($userexists) {
                $updateprofile = $this->api->update($data_array, $userexists['id'], 'users');
                if ($userexists['status'] == '0') {
                    $response = array('result' => '0', 'response' => 'Your account is not active');
                } else {
                    $response = array('result' => '1', 'response' => $userexists);
                }

            } else {
                $response = array('result' => '0', 'response' => 'Invalid Email or Password, Please try again');
            }
        } else {
            $response = array('result' => '0', 'response' => 'Invalid Data');
        }
        echo json_encode($response);
    }

    public function signup()
    {
        //$data = json_decode(file_get_contents('php://input'), true);
        //$data = $this->input->post();

        $data = (isset($_POST)) ? $_POST : array();

        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['first_name']) && isset($data['last_name']) && isset($data['email']) &&
            isset($data['password']) && isset($data['role']) && isset($data['mobile']) &&
            (isset($data['fcm_device_id'])) && (isset($data['device_type'])) && (isset($data['location'])) &&
            (isset($data['location'])) && (isset($data['latitude'])) && (isset($data['latitude'])) &&
            (isset($data['longitude'])) && (isset($data['longitude']))) {

            $emailExists = $this->api->checkAlredyEmailexiest($data['email']);
            $mobileExists = $this->api->checkifmobilealreadyexists($data['mobile']);
            if ($emailExists) {
                $response = array('result' => '0', 'response' => 'The Email id entered is already exists');
            } elseif ($mobileExists) {
                $response = array('result' => '0', 'response' => 'The Mobile number entered is already exists');
            } else {
                $dataArray = array();
                if ($data['role'] == 'Lawyer') {
                    $getDocument1 = '';
                    if (isset($_FILES['document_1'])) {
                        $document1 = $this->uploadDocument('document_1');
                        if ($document1['status'] == true) ;
                        {
                            $getDocument1 = $document1['data'];
                        }
                    }

                    $getDocument2 = '';
                    if (isset($_FILES['document_2'])) {
                        $document2 = $this->uploadDocument('document_2');
                        if ($document2['status'] == true) ;
                        {
                            $getDocument2 = $document2['data'];
                        }
                    }

                    $getDocument3 = '';
                    if (isset($_FILES['document_3'])) {
                        $document3 = $this->uploadDocument('document_3');
                        if ($document3['status'] == true) ;
                        {
                            $getDocument3 = $document3['data'];
                        }
                    }

                    $getDocument4 = '';
                    if (isset($_FILES['document_4'])) {
                        $document4 = $this->uploadDocument('document_4');
                        if ($document4['status'] == true) ;
                        {
                            $getDocument4 = $document4['data'];
                        }
                    }

                    $dataArray['llb_certificate'] = $getDocument1;
                    $dataArray['call_to_bar_certificate'] = $getDocument2;
                    $dataArray['supreme_court_number'] = $getDocument3;
                    $dataArray['annual_practice_fee'] = $getDocument4;
                }

                $dataArray['first_name'] = $data['first_name'];
                $dataArray['last_name'] = $data['last_name'];
                $dataArray['email'] = $data['email'];
                $dataArray['role'] = $data['role'];
                $dataArray['status'] = ($data['role'] == 'Lawyer') ? '0' : '1';
                $dataArray['mobile'] = $data['mobile'];
                $dataArray['l_location'] = $data['location'];
                $dataArray['l_latitude'] = $data['latitude'];
                $dataArray['l_longitude'] = $data['longitude'];
                $dataArray['password'] = md5($data['password']);
                $dataArray['fcm_device_id'] = $data['fcm_device_id'];
                $dataArray['device_type'] = $data['device_type'];
                $dataArray['plan_id'] = DEFAULT_PLAN_ID;
                $dataArray['plan_expiry'] = date('Y-m-d h:i:s', strtotime('+1 years'));

                $insertID = $this->api->addNewRecord('users', $dataArray);

                if (isset($data['refer_code']) && $data['refer_code'] != '') {
                    $query = $this->db->query('SELECT * FROM users WHERE refer_code = "' . $data['refer_code'] . '"');
                    $usersData = $query->result_array();
                    if (count($usersData) > 0) {
                        /*$referralBonus = $this->api->getSettings('referralbonus');
                        $updateWallet['wallet'] = $referralBonus;
                        $updateWallet['refer_by'] = $usersData[0]['id'];*/
                        $updateWallet['refer_by'] = $usersData[0]['id'];
                        $this->api->update($updateWallet, $insertID, 'users');
                    }
                }

                if ($insertID) {
                    $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';

                    // refer code hiten code start
                    $unique_ref_found = false;
                    while (!$unique_ref_found) {
                        $referralCode = substr(str_shuffle($str_result), 0, 6);
                        $query = $this->db->query("SELECT `refer_code` FROM `users` WHERE `refer_code`='$referralCode'");
                        $usersData = $query->result_array();
                        if (count($usersData) == 0) {
                            $unique_ref_found = true;
                        }
                    }
                    $dataArrayUpdate['refer_code'] = $referralCode;
                    $this->api->update($dataArrayUpdate, $insertID, 'users');
                    // refer code hiten code end

                    $userDetail = $this->api->getSingleRecordById($insertID, 'users');
                    //print_r($userDetail);exit;

                    $userDetailsSendINApi = array();
                    $userDetailsSendINApi['id'] = $userDetail['id'];
                    $userDetailsSendINApi['first_name'] = $userDetail['first_name'];
                    $userDetailsSendINApi['last_name'] = $userDetail['last_name'];
                    $userDetailsSendINApi['email'] = $userDetail['email'];
                    $userDetailsSendINApi['role'] = $userDetail['role'];
                    $userDetailsSendINApi['mobile'] = $userDetail['mobile'];
                    $userDetailsSendINApi['refer_code'] = $userDetail['refer_code'];
                    $userDetailsSendINApi['fcm_device_id'] = $userDetail['fcm_device_id'];
                    $userDetailsSendINApi['device_type'] = $userDetail['device_type'];
                    $response['result'] = '1';
                    $response['response'] = $userDetail;
                }

                if ($data['role'] == 'Lawyer') {
                    $response = array('result' => '1', 'response' => 'The Lawyer signup successfully. Admin can verify to login in you account');
                }
            }
        }
        echo json_encode($response);
    }

    public function referCodeCheck()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['refer_code'])) {
            $refer_code = $data['refer_code'];

            $referCodeExists = $this->api->checkReferCodeExiest($refer_code);
            if ($referCodeExists) {
                $response = array('result' => '1', 'response' => $referCodeExists);
            } else {
                $response = array('result' => '0', 'response' => 'Refer code not found, Please try again');
            }
        } else {
            $response = array('result' => '0', 'response' => 'Enter refer code');
        }
        echo json_encode($response);
    }

    private function uploadDocument($file = '')
    {
        $response = array();
        $response['status'] = false;
        $response['data'] = '';
        if ($file == '') {
            return $response;
        }
        $fileName = time() . '_' . $_FILES[$file]['name'];

        $tempName = $_FILES[$file]['tmp_name'];
        $filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $fileName;
        $allowed = array();
        $allowed[] = 'pdf';
        $allowed[] = 'png';
        $allowed[] = 'jpg';
        $allowed[] = 'jpeg';
        $allowed[] = 'doc';
        $allowed[] = 'docx';
        $allowed[] = 'amr';
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        if (!$extension || empty($extension) || !in_array($extension, $allowed)) {

            $response['data'] = 'Please select the doc, pdf or image file only.';
        }
        if (move_uploaded_file($tempName, $filePath)) {
            $response['status'] = true;
            $response['data'] = $fileName;
        }

        return $response;
    }

    public function testest()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $getDocument1 = '';
        if (isset($data['document_1'])) {
            $document1 = $this->Documentupload($data['document_1']);
            if ($document1['status'] == true) ;
            {
                $getDocument1 = $document1['data'];
            }
        }

        $getDocument2 = '';
        if (isset($data['document_2'])) {
            $document2 = $this->Documentupload($data['document_2']);
            if ($document2['status'] == true) ;
            {
                $getDocument2 = $document2['data'];
            }
        }

        $getDocument3 = '';
        if (isset($data['document_3'])) {
            $document3 = $this->Documentupload($data['document_2']);
            if ($document3['status'] == true) ;
            {
                $getDocument3 = $document3['data'];
            }
        }

        $getDocument4 = '';
        if (isset($data['document_4'])) {
            $document4 = $this->Documentupload($data['document_2']);
            if ($document4['status'] == true) ;
            {
                $getDocument4 = $document4['data'];
            }
        }

        $dataArray = array();
        $dataArray['llb_certificate'] = $getDocument1;
        $dataArray['call_to_bar_certificate'] = $getDocument2;
        $dataArray['supreme_court_number'] = $getDocument3;
        $dataArray['annual_practice_fee'] = $getDocument4;
        $insertID = $this->api->addNewRecord('users', $dataArray);

        echo json_encode($insertID);
    }

    public function Documentupload($file = array())
    {
        $output = array();
        $output['status'] = false;
        $output['data'] = '';
        $allowed_mime = array(
            'application/msword' => 'doc',
            'image/png' => 'png',
            'image/x-png' => 'png',
            'image/jpeg' => 'jpeg',
            'image/jpg' => 'jpg',
            'application/pdf' => 'pdf',
            'application/octet-stream' => 'pdf'
        );

        //$file = json_decode(file_get_contents('php://input'), true);
        try {

            if (!isset($file['mime_type'])) {
                throw new \Exception('mime type cant found.');
            }

            if (!array_key_exists($file['mime_type'], $allowed_mime)) {
                throw new \Exception('mime type is not  valid.');
            }

            if (!isset($file['file'])) {
                throw new \Exception('file cant found.');
            }

            if (empty($file['file'])) {
                throw new \Exception('file cant found.');
            }

            $base_decode = base64_decode($file['file'], true);
            if ($base_decode == false) {
                throw new \Exception('Document not uploaded please upload proper.');
            }

            $extension = $allowed_mime[$file['mime_type']];

            $filename = uniqid() . '.' . $extension;
            $filepath = 'upload/' . $filename;
            $success = file_put_contents($filepath, $base_decode);
            if ($success) {
                $output['status'] = true;
                $output['data'] = $filename;
            } else {
                throw new \Exception('Document not uploaded.');
            }
        } catch (Exception $e) {

            $output['data'] = $e->getMessage();
        }

        return $output;

        //echo json_encode($output);
    }

    // Forgot Password with mobile number
    public function ForgotPassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['mobile'])) {
            $checkExistEmailByUserID = $this->api->checkExistEmail($data['mobile']);
            if ($checkExistEmailByUserID) {
                $dataArray = array();
                $userDetail = $this->api->getSingleRecordById($checkExistEmailByUserID['id'], 'users');
                $userDetailsSendINApi = array();
                $userDetailsSendINApi['id'] = $userDetail['id'];
                $userDetailsSendINApi['first_name'] = $userDetail['first_name'];
                $userDetailsSendINApi['last_name'] = $userDetail['last_name'];
                $userDetailsSendINApi['email'] = $userDetail['email'];
                $userDetailsSendINApi['role'] = $userDetail['role'];
                $userDetailsSendINApi['mobile'] = $userDetail['mobile'];
                $userDetailsSendINApi['fcm_device_id'] = $userDetail['fcm_device_id'];
                $userDetailsSendINApi['device_type'] = $userDetail['device_type'];
                $response['result'] = '1';
                $response['response'] = $userDetailsSendINApi;
            } else {
                $response['result'] = '0';
                $response['response'] = 'There is no Account associated with this Mobile Number';
            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Create Case API
    public function createcase()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['user_id']) && isset($data['case_name']) && isset($data['description'])) {
            $dataArray = array();
            $dataArray['client_id'] = $data['user_id'];
            $dataArray['case_name'] = $data['case_name'];
            $dataArray['c_location'] = $data['location'];
            $dataArray['c_latitude'] = $data['latitude'];
            $dataArray['c_longitude'] = $data['longitude'];
            $dataArray['description'] = $data['description'];
            $dataArray['offend_status'] = $data['offend_status'];
            $dataArray['offend_name'] = $data['offend_name'];
            $dataArray['offend_contact'] = $data['offend_contact'];
            $dataArray['offend_other_info'] = $data['offend_other_info'];
            $dataArray['investigate_status'] = $data['investigate_status'];
            // Check if Case creation allowed
            $plan_detail = $this->api->current_membership_plan_params($data['user_id']);
            $number_of_cases = $plan_detail['service']['number_of_cases'];
            $total_created_case = $this->api->total_user_cases($data['user_id']);
            //echo $total_created_case.'----'.$number_of_cases; die;
            if ($number_of_cases > $total_created_case) {
                if ($data['investigate_status'] == 'No' && $data['offend_status'] == 'No') {
                    $response['result'] = '0';
                    $response['response'] = 'Case cannot be submitted please provide offender details';
                } else {
                    $insertID = $this->api->addNewRecord('request', $dataArray);
                    if ($insertID) {
                        $msg = "User #" . $data['user_id'] . " created a case";
                        $msg = wordwrap($msg, 70);
//		            mail($this->api->getSettings('admin_email'),"Case Created",$msg);
                        $this->sendemail($this->api->getSettings('admin_email'), "Case Created", $msg);
//		            mail('hiten.digitalrooar@gmail.com',"Case Created",$msg);

                        $nearestlawyerDetails = $this->api->AutoAssignnearestlawyer($insertID);
                        if (count($nearestlawyerDetails) > 0) {
                            $assignlaywerDetails = array();
                            $assignlaywerDetails['case_id'] = $insertID;
                            $assignlaywerDetails['status'] = 'S';
                            $assignlaywerDetails['lawyer_id'] = $nearestlawyerDetails[0]['id'];
                            $this->api->addNewRecord('case_lawyer', $assignlaywerDetails);
                            $update_data = array('laywer_id' => $nearestlawyerDetails[0]['id'], 'progress' => 'Pending');
                            $update_case_status = $this->api->update($update_data, $insertID, 'request');
                            // Sending Push Notification to Lawyer
                            $case_detail = $this->api->getSingleRecordById($insertID, 'request');
                            $lawyer_id = $nearestlawyerDetails[0]['id'];
                            $title = 'A New Case has been assigned.';
                            $message = 'Case ' . $case_detail['case_name'] . ' has been assigned to you. Goto Case List to see the detail';
                            $this->sendpushnotification($lawyer_id, $message, $title);
                            $this->sendemail($nearestlawyerDetails[0]['email'], "A New Case has been assigned", $message);
                            $r_notification_data['user_id'] = $lawyer_id;
                            $r_notification_data['case_id'] = $insertID;
                            $r_notification_data['case_name'] = $data['case_name'];
                            $r_notification_data['client_id'] = $data['user_id'];
                            $r_notification_data['lawyer_id'] = $lawyer_id;
                            $r_notification_data['message'] = 'Case ' . $case_detail['case_name'] . ' has been assigned to you. Goto Case List to see the detail';
                            $r_notification_data['redirect_to'] = 'received_message';
                            $r_notification_data['created_date'] = date('Y-m-d H:i:s');
                            $r_notification = $this->api->addNewRecord('notification', $r_notification_data);
                        }
                        // End
                        if (isset($data['evidenceid']) && !empty(!empty($data['evidenceid']))) {
                            foreach ($data['evidenceid'] as $key => $value) {
                                // insert data in case evidences
                                $caseEvidences = array();
                                $caseEvidences['case_id'] = $insertID;
                                $caseEvidences['user_id'] = $data['user_id'];
                                $caseEvidences['evidance_id'] = $value;
                                $this->api->addNewRecord('case_evidences', $caseEvidences);
                            }
                            $CaseDetail = $this->api->getSingleRecordById($insertID, 'request');
                            $caseDetialSendINApi = array();
                            $caseDetialSendINApi['id'] = $CaseDetail['id'];
                            $caseDetialSendINApi['case_name'] = $CaseDetail['case_name'];
                            $caseDetialSendINApi['user_id'] = $CaseDetail['client_id'];
                            $response['result'] = '1';
                            $response['response'] = $caseDetialSendINApi;
                        } else {
                            $response['result'] = '0';
                            $response['response'] = 'Please select at least one Evidance';
                        }
                        // get case information
                    } else {
                        $response['result'] = '0';
                        $response['response'] = 'There is an issue in creating the case';
                    }
                }
            } else {
                $response['result'] = '0';
                $response['response'] = 'You have exceeded the number of cases allowed. Upgrade your package to continue.';
            }
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Show list of Cases to the User
    public function caselistbyuser()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        $userID = $data['user_id'];
        $role = $data['role'];
        $progress = (!empty($data['progress'])) ? $data['progress'] : '';
        //echo $progress; die;
        if (!empty($userID)) {
            if ($role == 'Lawyer') {
                $caselist = $this->api->getrequestByUserID(array('laywer_id' => $userID), $progress);
            } else {
                $caselist = $this->api->getrequestByUserID(array('client_id' => $userID), $progress);
            }
            if ($caselist) {
                $responseData = array();
                //print_r($caselist); die;
                foreach ($caselist as $key => $value) {
                    $data = array();
                    $data['laywer_id'] = $value['laywer_id'];
                    $data['laywer_first_name'] = $value['laywer_first_name'];
                    $data['laywer_last_name'] = $value['laywer_last_name'];
                    $data['laywer_location'] = $value['laywer_location'];
                    $data['laywer_mobile'] = $value['laywer_mobile'];

                    $data['client_id'] = $value['client_id'];
                    $data['client_first_name'] = $value['client_first_name'];
                    $data['client_last_name'] = $value['client_last_name'];
                    $data['client_location'] = $value['client_location'];
                    $data['client_mobile'] = $value['client_mobile'];

                    $data['id'] = $value['id'];
                    $data['commission_percentage'] = $value['commission_percentage'];
                    $data['case_name'] = $value['case_name'];
                    $data['created_date'] = $value['created_date'];
                    $data['evidences'] = $this->api->getCaseEvidenceList($value['id']);
                    $data['commission_date'] = $value['commission_date'];
                    $data['status'] = $value['status'];
                    $data['description'] = $value['description'];
                    $data['co_status'] = $value['co_status'];
                    $data['com_payment_status'] = $value['com_payment_status'];
                    $data['progress'] = $value['progress'];
                    $data['amount'] = $value['amount'];
                    $data['offend_status'] = $value['offend_status'];
                    $data['offend_name'] = $value['offend_name'];
                    $data['offend_contact'] = $value['offend_contact'];
                    $data['offend_other_info'] = $value['offend_other_info'];
                    $data['investigate_status'] = $value['investigate_status'];

                    $data['commission'] = $value['commission'];
                    $data['lawyer_amount'] = $value['lawyer_amount'];
                    $data['client_compensasion'] = $value['client_compensasion'];
                    if (!empty($value['agreement'])) {
                        $data['agreement'] = base_url() . 'upload/' . $value['agreement'];
                    } else {
                        $data['agreement'] = '';
                    }

                    $responseData[] = $data;
                }
                $response['result'] = '1';
                $response['response'] = $responseData;
            } else {
                $response['result'] = '0';
                $response['response'] = "No Case available.";
            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Update Profile functionality
    public function updateprofile()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        //print_r($data); die;
        if (isset($data['first_name']) && isset($data['last_name']) && isset($data['dob']) && isset($data['user_id']) && isset($data['mobile']) && (isset($data['fcm_device_id'])) && (isset($data['device_type'])) && isset($data['acc_name']) && isset($data['account_number']) && isset($data['bank_name'])) {
            $dataArray = array();
            $dataArray['first_name'] = $data['first_name'];
            $dataArray['last_name'] = $data['last_name'];
            $dataArray['dob'] = date("Y-m-d", strtotime($data['dob']));
            $dataArray['acc_name'] = $data['acc_name'];
            $dataArray['account_number'] = $data['account_number'];
            $dataArray['bank_name'] = $data['bank_name'];
            $dataArray['mobile'] = $data['mobile'];
            $dataArray['fcm_device_id'] = $data['fcm_device_id'];
            $dataArray['device_type'] = $data['device_type'];
            $updateprofile = $this->api->update($dataArray, $data['user_id'], 'users');
            if ($updateprofile) {
                $userDetail = $this->api->getSingleRecordById($data["user_id"], 'users');
                $userDetailsSendINApi = array();
                $userDetailsSendINApi['id'] = $userDetail['id'];
                $userDetailsSendINApi['first_name'] = $userDetail['first_name'];
                $userDetailsSendINApi['last_name'] = $userDetail['last_name'];
                $userDetailsSendINApi['email'] = $userDetail['email'];
                $userDetailsSendINApi['role'] = $userDetail['role'];
                $userDetailsSendINApi['mobile'] = $userDetail['mobile'];
                $userDetailsSendINApi['dob'] = $userDetail['dob'];
                $userDetailsSendINApi['acc_name'] = $userDetail['acc_name'];
                $userDetailsSendINApi['account_number'] = $userDetail['account_number'];
                $userDetailsSendINApi['bank_name'] = $userDetail['bank_name'];
                $userDetailsSendINApi['wallet'] = $userDetail['wallet'];
                $userDetailsSendINApi['fcm_device_id'] = $userDetail['fcm_device_id'];
                $userDetailsSendINApi['device_type'] = $userDetail['device_type'];
                $response['result'] = '1';
                $response['response'] = $userDetailsSendINApi;
            } else {
                $response['result'] = '1';
                $response['response'] = 'Profile not updated due to some technical error';
            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Update Profile functionality
    public function deleteuser()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        //print_r($data); die;
        if (isset($data['user_id'])) {
            $dataArray = array();
            $dataArray['status'] = '2';

//			$updateprofile = $this->api->update($dataArray ,$data['user_id'], 'users');
            $updateprofile = $this->db->query('delete FROM users WHERE id="' . $data['user_id'] . '" ');
            if ($updateprofile) {
                $response['result'] = '1';
                $response['response'] = 'User Account Delete Successfully';
            } else {
                $response['result'] = '1';
                $response['response'] = 'User Account not deleted due to some technical error';
            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Upload Evidences
    public function uploadevidence()
    {
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($_POST['user_id']) && isset($_POST['title']) && isset($_POST['type']) && isset($_FILES['url'])) {
            $fileName = time() . '_' . $_FILES['url']['name'];
            $tempName = $_FILES['url']['tmp_name'];
            $filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $fileName;
            $allowed = array();
            if ($_POST['type'] == 'video') {
                $allowed = array(
                    'webm',
                    'wav',
                    'mp4',
                    'mkv',
                    'amr',
                );
            } elseif ($_POST['type'] == 'audio') {
                $allowed = array(
                    'mp3',
                    'ogg',
                    'amr',
                    'm4a',
                );
            } elseif ($_POST['type'] == 'docx') {
                $allowed = array('docx', 'doc');
            } elseif ($_POST['type'] == 'pdf') {
                $allowed = array('pdf');
            }
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
//                print_r($allowed);
            if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
                $response['result'] = '0';
                $response['response'] = 'Please select the doc, pdf or image file only.';
                //return;
            } else {
                if ($_POST['type'] != 'video') {
                    if (!move_uploaded_file($tempName, $filePath)) {
                        if (!empty($_FILES["url"]["error"])) {
                            $listOfErrors = array(
                                '1' => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                                '2' => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                                '3' => 'The uploaded file was only partially uploaded.',
                                '4' => 'No file was uploaded.',
                                '6' => 'Missing a temporary folder. Introduced in PHP 5.0.3.',
                                '7' => 'Failed to write file to disk. Introduced in PHP 5.1.0.',
                                '8' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.'
                            );
                            $error = $_FILES["url"]["error"];
                            if (!empty($listOfErrors[$error])) {
                                //echo $listOfErrors[$error];
                                $response['result'] = '0';
                                $response['response'] = $listOfErrors[$error];
                            } else {
                                $response['result'] = '0';
                                $response['response'] = 'Not uploaded because of error #' . $_FILES["url"]["error"];
                                //echo 'Not uploaded because of error #'.$_FILES["url"]["error"];
                            }
                        } else {
                            //echo 'Problem saving file: '.$tempName;
                            $response['result'] = '0';
                            $response['response'] = 'Problem saving file: ' . $tempName;
                        }
                        //return;
                    }
                }
                if ($_POST['type'] == 'video') {
                    $bunnyCDNStorage = new BunnyCDNStorage("247sue", "6b769d6b-7baf-4c60-901e24d7dda9-aa61-4ff2");
                    $reponse = $bunnyCDNStorage->uploadFile($_FILES['url']['tmp_name'], "/247sue/video/" . time() . '_' . $_FILES['url']['name']);
                    $reponseData = json_decode($reponse, true);
                    if ($reponseData['$reponseData'] != '201') {
                        $response['result'] = '0';
                        $response['response'] = $reponseData['Message'];
                    }
                    $fileName = "https://247sue.b-cdn.net/video/" . $fileName;
                }
                if (empty($_FILES["url"]["error"])) {
                    $data = array();
                    $data['user_id'] = $_POST['user_id'];
                    $data['title'] = $_POST['title'];
                    $data['type'] = $_POST['type'];
                    $data['lat'] = $_POST['lat'];
                    $data['long'] = $_POST['long'];
                    $data['location'] = $_POST['location'];
                    $data['size'] = $_POST['size'];
                    $data['url'] = $fileName;
                    // Plan details
                    $plan_detail = $this->api->current_membership_plan_params($data['user_id']);
                    $storage_space_in_gb = $plan_detail['service']['storage_space'];
                    $storage_space_in_gb_in_kb = $storage_space_in_gb * 1024 * 1024;
                    // Total size of evidences
                    $total_evidence_size_arr = $this->api->getTotalsizeofEvidences('evidences');
                    $total_evidence_size = $total_evidence_size_arr['size'];
                    if ($storage_space_in_gb_in_kb > $total_evidence_size) {
                        $insertID = $this->api->addNewRecord('evidences', $data);
                        if ($insertID) {
                            $userDetail = $this->api->getSingleRecordById($insertID, 'evidences');
                            $userDetailsSendINApi = array();
                            $userDetailsSendINApi['id'] = $userDetail['id'];
                            $userDetailsSendINApi['user_id'] = $userDetail['user_id'];
                            $userDetailsSendINApi['title'] = $userDetail['title'];
                            $userDetailsSendINApi['type'] = $userDetail['type'];
                            $userDetailsSendINApi['url'] = $userDetail['url'];
                            $response['result'] = '1';
                            $response['response'] = $userDetailsSendINApi;
                        }
                    } else {
                        $response['result'] = '0';
                        $response['response'] = 'You do not have enough storage space, Please choose a membership plan to continue';
                    }
                }

            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Update Evidence
    public function updateevidence()
    {
        $data = json_decode(file_get_contents('php://input'), true);
//                print_r($data);exit;
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['title']) && isset($data['description']) && isset($data['id'])) { //echo "dfg";
            $dataArray = array();
            $dataArray['title'] = $data['title'];
            $dataArray['description'] = $data['description'];
            $updateevidence = $this->api->update($dataArray, $data['id'], 'evidences');
            if ($updateevidence) {
                $response['result'] = '1';
                $response['response'] = 'Evidence has been updated successfully.';
            } else {
                $response['result'] = '1';
                $response['response'] = 'Error in Updating evidence';
            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function listevidencevideo()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['user_id']) && isset($data['type'])) {
            if ($data['type'] == 'All') {
                $evidence = $this->api->getEvidenceList('evidences', array('user_id' => $data['user_id']));
            } else {
                $evidence = $this->api->getEvidenceList('evidences', array('user_id' => $data['user_id'], 'type' => $data['type']));
            }
            if (!empty($evidence)) {
                $responseData = array();
                $dataEvidence = array();
                $i = 0;
                foreach ($evidence as $value) {
                    $dataEvidence['id'] = $value['id'];
                    $dataEvidence['user_id'] = $value['user_id'];
                    $dataEvidence['title'] = $value['title'];
                    $dataEvidence['type'] = $value['type'];
//						$dataEvidence['url'] =$value['url'];
                    $dataEvidence['url'] = $value['url'];
                    $dataEvidence['lat'] = $value['lat'];
                    $dataEvidence['location'] = $value['location'];
                    $dataEvidence['long'] = $value['long'];
                    $dataEvidence['description'] = $value['description'];
                    $dataEvidence['created_date'] = $value['created_date'];
                    $responseData[] = $dataEvidence;
                    $i++;
                }
                $response['result'] = '1';
                $response['response'] = $responseData;
            } else {
                $response['result'] = '0';
                $response['response'] = 'No Evidence found';
            }
            //array('id' => $id)
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function viewevidencevideo()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['id']) && isset($data['role'])) {

            $evidence = $this->api->getEvidenceList('evidences', array('id' => $data['id']));
            if (!empty($evidence)) {
                if (!empty($data['role']) && $data['role'] == 'Lawyer') {

                    $dataArray = array();
                    $dataArray['viewuser'] = $evidence[0]['viewuser'] + 1;
                    $updateevidence = $this->api->update($dataArray, $data['id'], 'evidences');
                    if ($updateevidence) {
                        $response['result'] = '1';
                        $response['response'] = 'Evidence has been updated successfully.';
                    } else {
                        $response['result'] = '1';
                        $response['response'] = 'Error in Updating evidence';
                    }
                }
                if (!empty($evidence[0]['shared_evidence_id']) && $data['role'] == 'Client') {
                    $dataArray = array();
                    $dataArray['viewuser'] = $evidence[0]['viewuser'] + 1;
                    $updateevidence = $this->api->update($dataArray, $data['id'], 'evidences');
                    if ($updateevidence) {
                        $response['result'] = '1';
                        $response['response'] = 'Evidence has been updated successfully.';
                    } else {
                        $response['result'] = '1';
                        $response['response'] = 'Error in Updating evidence';
                    }
                }
            } else {
                $response['result'] = '0';
                $response['response'] = 'No Evidence found';
            }
            //array('id' => $id)
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function deleteevidencevideo()
    {
//		$data = json_decode(file_get_contents('php://input'), true);

        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
//		$this->db->select('*');
//		$this->db->order_by('created_date', 'DESC');
//		$this->db->where('created_date >=', 'DATE(NOW()) + INTERVAL -7 DAY');
////		$this->db->where('created_date <=', '(NOW() + INTERVAL 14 DAY)');
//
//		$this->db->where('viewuser =', '0');
//		$this->db->from('evidences');
        $query = $this->db->query('SELECT * FROM evidences WHERE created_date <= now() - INTERVAL 7 DAY and created_date >= now() - INTERVAL 14 DAY and viewuser = 0 order by created_date DESC');

//                $query = $this->db->get();
//		$query = $this->db->get();
// echo               $this->db->last_query();

        $evidence = $query->result_array();
        $bunnyCDNStorage = new BunnyCDNStorage("247sue", "6b769d6b-7baf-4c60-901e24d7dda9-aa61-4ff2");
        foreach ($evidence as $evidences) {
            //unset($evidences);
//                    echo $_SERVER['DOCUMENT_ROOT'].'/upload/'.$evidences['url'];

//                    if (file_exists($_SERVER['DOCUMENT_ROOT'].'/upload/'.$evidences['url'])){
//                        unlink($_SERVER['DOCUMENT_ROOT'].'/upload/'.$evidences['url']);
            $link_array = explode('/', $evidences['url']);
            $page = end($link_array);
            $bunnyCDNStorage->deleteObject("/247sue/video/" . $page);
            $this->db->query('delete FROM evidences WHERE id="' . $evidences['id'] . '" ');
//                    }
            exit;

        }
        print_r($evidence);

//		echo json_encode($response , JSON_PRETTY_PRINT);
    }

    // Share Evidence with friend
    public function shareevidence()
    {
        /*$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $txt = print_r(file_get_contents('php://input'),true);
        fwrite($myfile, $txt);*/
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        //print_r($data); die;
        if (isset($data['evidence_id']) && isset($data['email']) && isset($data['amount'])) {
            //Check if any account exists with same email.
            foreach ($data['email'] as $phones) {
                $mobileExists = $this->api->checkExistEmail($phones);
                if ($mobileExists) {
                    $user_id = $mobileExists['id'];
                    $event_shared = $this->api->checkEventsShared($data['evidence_id'], $user_id);
                    if ($event_shared) {
                        $evidence_detail = $this->api->getEvidenceDetail($data['evidence_id'], $data['user_id']);
                        $evidence_detail['shared_evidence_id'] = $evidence_detail['id'];
                        $evidence_detail['user_id'] = $user_id;
                        $evidence_detail['amount'] = $data['amount'];
                        $evidence_detail['shared_by'] = $data['user_id'];
                        $evidence_detail['payment_status'] = 'N';
                        unset($evidence_detail['id']);
                        unset($evidence_detail['created_date']);
                        unset($evidence_detail['size']);
                        $insertID = $this->api->addNewRecord('evidences', $evidence_detail);
                        // Saving notification for the user who have shared the evidences
                        $user_detail = $this->api->getSingleRecordById($data['user_id'], 'users');
                        $full_name = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
                        $notification_data['user_id'] = $user_id;
                        $notification_data['message'] = $full_name . ' has shared the Evidence with me.';
                        $notification_data['redirect_to'] = 'evidence_shared_with_me';
                        $notification_data['created_date'] = date('Y-m-d H:i:s');
                        $notification = $this->api->addNewRecord('notification', $notification_data);
                        // Saving notification for the user who have shared the evidences
                        /*$notification_data['user_id'] = $data['user_id'];
                        $notification_data['message'] = '';
                        $notification_data['redirect_to'] = 'evidence_shared_by_me';
                        $notification_data['created_date'] = $data['amount'];
                        $notification = $this->api->addNewRecord('notification', $notification_data);*/
                        $userDetailsMail = $this->api->getSingleRecordById($data['user_id'], 'users');
                        $title = 'shared the Evidence';
                        $message = $full_name . ' has shared the Evidence with me.';
                        $this->sendemail($userDetailsMail['email'], $title, $message);
                        $response['result'] = '1';
                        $response['response'] = 'Evidence has been shared with this user. ';
                    } else {
                        $response['result'] = '0';
                        $response['response'] = 'Problem in sharing evidences';
                    }
                } else {
                    $response['result'] = '1';
                    $response['response'] = 'There are some users who do not have sue account';
                }
            }
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // My Shared Evidences
    public function mysharedevidences()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['user_id'])) {
            $evidencelist = $this->api->getMySharedEvidence($data['user_id']);
            $response['result'] = '1';
            $response['response'] = $evidencelist;
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    //  Evidences shared with me
    public function evidencesharedwithme()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['user_id'])) {
            $evidencelistdata = $this->api->getSharedwithmeEvidence($data['user_id']);
            $servicefee = $this->api->getSettings('servicefee');
            foreach ($evidencelistdata as $evidencelists) {
                $evidencelists['amount'] = strval($evidencelists['amount'] + $servicefee);
                $evidencelist[] = $evidencelists;
            }
            $response['result'] = '1';
            $response['response'] = $evidencelist;
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Change Password functionality
    public function changepassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        //print_r($data); die;
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['user_id']) && isset($data['new_password']) && isset($data['confirm_password'])) {
            if ($data['new_password'] == $data['confirm_password']) {
                // echo 'hii';die;
                $dataArray = array();
                $dataArray['password'] = md5($data['new_password']);
                $updateprofile = $this->api->update($dataArray, $data['user_id'], 'users');
                $userDetail = $this->api->getSingleRecordById($data['user_id'], 'users');
                $userDetailsSendINApi = array();
                $userDetailsSendINApi['id'] = $userDetail['id'];
                $userDetailsSendINApi['fcm_device_id'] = $userDetail['fcm_device_id'];
                $userDetailsSendINApi['device_type'] = $userDetail['device_type'];
                $response['result'] = '1';
                $response['response'] = $userDetailsSendINApi;
            } else {
                $response['result'] = '1';
                $response['response'] = 'your new password and confirm password do not matched.';
            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Update Password
    public function updatePassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['user_id']) && isset($data['old_password']) && isset($data['new_password']) && isset($data['confirm_password'])) {
            $GetUserDetails = $this->api->getSingleRecordById($data['user_id'], 'users');
            if ($GetUserDetails['password'] == md5($data['old_password'])) {
                if ($data['new_password'] == $data['confirm_password']) {
                    $dataArray = array();
                    $dataArray['password'] = md5($data['new_password']);
                    $updateprofile = $this->api->update($dataArray, $GetUserDetails['id'], 'users');
                    $userDetail = $this->api->getSingleRecordById($GetUserDetails['id'], 'users');
                    $userDetailsSendINApi = array();
                    $userDetailsSendINApi['id'] = $userDetail['id'];
                    $userDetailsSendINApi['fcm_device_id'] = $userDetail['fcm_device_id'];
                    $userDetailsSendINApi['device_type'] = $userDetail['device_type'];
                    $response['result'] = '1';
                    $response['response'] = $userDetailsSendINApi;
                } else {
                    $response['result'] = '1';
                    $response['response'] = 'your new password and confirm password do not matched.';
                }
            } else {
                $response['result'] = '1';
                $response['response'] = 'your old password do not matched.';
            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Get all Membership Plans
    public function allmembershipplans()
    {
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        /*$txt = print_r(file_get_contents('php://input'),true);
        fwrite($myfile, $txt);*/
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['minimum_withdrawal_amount'] = $this->api->getSettings('minimum_withdrawal_amount');
        $response['fee'] = $this->api->getSettings('fee');
        $response['applepayfee'] = $this->api->getSettings('applepayfee');
        $response['response'] = '';
        $plan_arr = array(
            'number_of_cases' => 'No of Cases (Per year)',
            'messaging' => 'Instant messaging',
            'video_recording' => 'Record non-doctorable Video and Audio Evidences',
            'evidence_sharing' => 'Evidence sharing',
            'representation' => 'Discount on Legal Representation in Government Agency Meetings in(%)',
            'storage_space' => 'Storage space (in GB)',
            'sue_individuals' => 'Civil Cases against Individuals',
            'sue_organizations' => 'Sue organizations',
            'rec_audio_evidence' => 'Record Audio Evidences',
            'lawyer_assignment_timings' => 'Lawyer assignment timing',
            'criminal_cases' => 'Petitions for Criminal Cases',
            'court_representation' => 'Discount on Legal Representation in Court in(%)',
            'lawyer_percentage' => 'Lawyer Percentage in(%)',
            'corporations_cases' => 'Civil Cases against corporations',
            'government_agencies_cases' => 'Civil Cases against Government Agencies',
            'discount_on_bail' => 'Discount on Administrative Bail from security and Anti-Graft Agencies in(%)',
        );

        if (isset($data['user_id'])) {
            $plans = $this->api->getAllRecordsE('membership_plan', array());
            if ($plans && count($plans) > 0) {
                foreach ($plans as $eachplan) {
                    $services = array();
                    foreach (unserialize($eachplan['service']) as $key => $value) {
                        $name = $plan_arr[$key];
                        $features['key'] = $key;
                        $features['name'] = $name;
                        $features['value'] = $value;
                        $services[] = $features;
                    }
                    $plan_yearly_price = $eachplan['price'];
                    $plan_monthly_price = round($eachplan['price'] / 12);
                    $eachplan['plan_price'] = 'NGN ' . $plan_yearly_price . ' Yearly (NGN ' . $plan_monthly_price . ' per Month)';
                    $eachplan['subscriptions_id'] = $eachplan['subscriptions_id'];
                    $eachplan['service'] = $services;
                    if ($eachplan['id'] != DEFAULT_PLAN_ID) {
                        $allplans[] = $eachplan;
                    }
                }
                //$plans['service'] = $features;
                $response['result'] = '1';
                $response['response'] = $allplans;
            } else {
                $response['result'] = '0';
                $response['response'] = 'No Membership Plans available.';
            }
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Get all Membership Plans
    public function planTypeWiseMemberShipPlans()
    {
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $response = array();
        $response['result'] = '0';
        $response['minimum_withdrawal_amount'] = $this->api->getSettings('minimum_withdrawal_amount');
        $response['fee'] = $this->api->getSettings('fee');
        $response['applepayfee'] = $this->api->getSettings('applepayfee');
        $response['response'] = '';
        $plan_arr = array(
            'number_of_cases' => 'No of Cases (Per year)',
            'messaging' => 'Instant messaging',
            'video_recording' => 'Record non-doctorable Video and Audio Evidences',
            'evidence_sharing' => 'Evidence sharing',
            'representation' => 'Discount on Legal Representation in Government Agency Meetings in(%)',
            'storage_space' => 'Storage space (in GB)',
            'sue_individuals' => 'Civil Cases against Individuals',
            'sue_organizations' => 'Sue organizations',
            'rec_audio_evidence' => 'Record Audio Evidences',
            'lawyer_assignment_timings' => 'Lawyer assignment timing',
            'criminal_cases' => 'Petitions for Criminal Cases',
            'court_representation' => 'Discount on Legal Representation in Court in(%)',
            'lawyer_percentage' => 'Lawyer Percentage in(%)',
            'corporations_cases' => 'Civil Cases against corporations',
            'government_agencies_cases' => 'Civil Cases against Government Agencies',
            'discount_on_bail' => 'Discount on Administrative Bail from security and Anti-Graft Agencies in(%)',
        );

        $allplans['Silver'] = array();
        $allplans['Gold'] = array();
        $allplans['Platinum'] = array();
        if (isset($user_id)) {
            $plans = $this->api->getAllRecordsE('membership_plan', array());
            if ($plans && count($plans) > 0) {
                foreach ($plans as $eachplan) {
                    $services = array();
                    foreach (unserialize($eachplan['service']) as $key => $value) {
                        $name = $plan_arr[$key];
                        $features['key'] = $key;
                        $features['name'] = $name;
                        $features['value'] = $value;
                        $services[] = $features;
                    }
                    $plan_yearly_price = $eachplan['price'];
                    $plan_monthly_price = round($eachplan['price'] / 12);
                    $eachplan['plan_price'] = 'NGN ' . $plan_yearly_price . ' Yearly (NGN ' . $plan_monthly_price . ' per Month)';
                    $eachplan['subscriptions_id'] = $eachplan['subscriptions_id'];
                    $eachplan['service'] = $services;

                    if ($eachplan['id'] != DEFAULT_PLAN_ID) {

                        if ($eachplan['plan_type'] == 'Silver') {
                            $allplans['Silver'][] = $eachplan;
                        }

                        $usersData = $this->db->select('*')->from('users')->where('id', $user_id)->get()->row_array();
                        if ($usersData) {
                            $roleName = $usersData['role'];
                        }

                        if ($roleName != 'Marketer') {
                            if ($eachplan['plan_type'] == 'Gold') {
                                $allplans['Gold'][] = $eachplan;
                            }
                            if ($eachplan['plan_type'] == 'Platinum') {
                                $allplans['Platinum'][] = $eachplan;
                            }
                        }
                    }
                }
                $response['result'] = '1';
                $response['response'] = $allplans;
            } else {
                $response['result'] = '0';
                $response['response'] = 'No Membership Plans available.';
            }
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Subscribe for membership
    public function subscribeplan()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $response = array();
        $response['result'] = '0';
        $data['payment_type'] = (isset($data['payment_type']) && $data['payment_type'] != '') ? $data['payment_type'] : 'Paystack';
        $response['response'] = '';
        if (isset($data['user_id']) && isset($data['plan_id'])) {
            $dataArray = array();

            // Adding Payment Transaction Start
            $transactionData['user_id'] = $data['user_id'];
            $transactionData['txn_no'] = $data['txn_no'];
            $transactionData['payment_type'] = $data['payment_type'];
            $transactionData['txn_desc'] = 'Made Payment from ' . $data['payment_type'] . ' for Membership Plan-' . $data['plan_name'];
            $transactionData['amount'] = $data['amount'];
            $transaction = $this->api->addNewRecord('transactions', $transactionData);
            // Adding Payment Transaction End

            if ($transaction) {

                $query = $this->db->query('SELECT * FROM users WHERE id = "' . $data['user_id'] . '"');
                $usersData = $query->result_array();
                if (count($usersData) > 0 && isset($usersData[0]['refer_by']) && $usersData[0]['refer_by'] != '') {
                    $queryReferral = $this->db->query('SELECT * FROM users WHERE id = "' . $usersData[0]['refer_by'] . '"');
                    $userReferralData = $queryReferral->result_array();
                    if (count($userReferralData) > 0) {

                        if ($usersData[0]['role'] == 'Marketer') {
                            $this->referByLevel($data['amount'], $data['user_id']);
                        }

                        if ($usersData[0]['role'] == 'Client') {
                            $referralBonus = $this->api->getSettings('referralbonus');
                            $updateWallet['wallet'] = $userReferralData[0]['wallet'] + ($data['amount'] * $referralBonus) / 100;
                            $this->api->update($updateWallet, $usersData[0]['refer_by'], 'users');

                            $transactionData = array();
                            $transactionData['user_id'] = $usersData[0]['refer_by'];
                            $transactionData['txn_no'] = rand();
                            $transactionData['txn_desc'] = 'Referral Bonus to User';
                            $transactionData['amount'] = ($data['amount'] * $referralBonus) / 100;
                            $this->api->addNewRecord('transactions', $transactionData);
                        }

                        // Sending Push Notification to User after receiving payment.
                        $title = 'You have received Payment for Referral Bonus.';
                        $message = 'You have Received Payment for the Referral Bonus';
                        $this->sendpushnotification($usersData[0]['refer_by'], $message, $title);
                    }
                    $userDetailsMail = $this->api->getSingleRecordById($usersData[0]['refer_by'], 'users');
                    if (count($userReferralData) > 0) {
                        $this->sendemail($userDetailsMail['email'], $title, $message);
                    }
                }
            }

            // Sending Push Notification to User after receiving payment.
            $title = 'You have made Payment for Membership Plan.';
            $message = 'You have made Payment for the Membership Plan. Now you can use features of ' . $data['plan_name'] . ' Plan';
            $this->sendpushnotification($data['user_id'], $message, $title);
            $userDetailsMail = $this->api->getSingleRecordById($data['user_id'], 'users');
            if (count($userReferralData) > 0) {
                $this->sendemail($userDetailsMail['email'], $title, $message);
            }
            // End

            // Saving notification for the user who have shared the evidences
            $notification_data['user_id'] = $data['user_id'];
            $notification_data['message'] = 'You have upgraded your Membership plan to ' . $data['plan_name'];
            $notification_data['redirect_to'] = 'upgraded_membership';
            $notification_data['created_date'] = date('Y-m-d H:i:s');
            $this->api->addNewRecord('notification', $notification_data);

            $dataArray['plan_id'] = $data['plan_id'];
            $updatePlan = $this->api->update($dataArray, $data['user_id'], 'users');
            if ($updatePlan) {
                $response['result'] = '1';
                $plan_detail = $this->api->current_membership_plan($data['user_id']);
                $response['response'] = $plan_detail;
            } else {
                $response['result'] = '1';
                $response['response'] = 'Error in Subscription';
            }
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function referByLevel($amount, $userId)
    {
        $usersData = $this->db->select('*')->from('users')->where('id', $userId)->get()->row_array();
        if ($usersData['refer_by'] > 0) {
            $usersData = $this->db->select('*')->from('users')->where('id', $usersData['refer_by'])->get()->row_array();

            if ($usersData['plan_id'] > 1) { // Plan Purchase
                $referralBonus = $this->api->getSettings('referralbonus');

                $updateWallet = array();
                $updateWallet['wallet'] = $usersData['wallet'] + ($amount * $referralBonus) / 100;
                $this->db->where('id', $usersData['id'])->update('users', $updateWallet);

                $transactionData = array();
                $transactionData['user_id'] = $usersData['id'];
                $transactionData['txn_no'] = rand();
                $transactionData['txn_desc'] = 'Referral Bonus to User';
                $transactionData['amount'] = ($amount * $referralBonus) / 100;
                $this->api->addNewRecord('transactions', $transactionData);
            }

            $this->referByLevel($amount, $usersData['id']);
        }
    }

    public function dashboardReward()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($user_id)) {
            $teamMemberData = $this->directRewardReportList($user_id);
            $teamMemberList['totalMembersCount'] = count($teamMemberData);
            $response['result'] = '1';
            $response['response'] = $teamMemberList;
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function directRewardReport()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($user_id)) {
            $dataArray = array();
            $teamMemberData = $this->directRewardReportList($user_id);
            $sum = 0;
            foreach ($teamMemberData as $getData) {
                $sum += $getData['wallet'];

                $userReferBy = $this->db->select('*')->from('users')->where('id', $getData['refer_by'])->get()->row_array();
                if ($userReferBy) {
                    $getData['referredByUser'] = $userReferBy['first_name'] . ' ' . $userReferBy['last_name'];
                } else {
                    $getData['referredByUser'] = '';
                }
                $getData['plan_expiry'] = date('jS M Y, h:i A', strtotime($getData['plan_expiry']));
                $getData['create_date'] = date('jS M Y, h:i A', strtotime($getData['create_date']));
                $dataArray[] = $getData;
            }
            $teamMemberList['directRewardIncome'] = (string)$sum;
            $teamMemberList['directReward'] = $dataArray;
            $response['result'] = '1';
            $response['response'] = $teamMemberList;
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function bonusRewardReport()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($user_id)) {
            $dataArray = array();
            $bonusIncomeData = $this->db->select('*')->from('bonus_incomes')->where('user_id', $user_id)->order_by('created_at', 'DESC')->get()->result_array();
            foreach ($bonusIncomeData as $getData) {
                $getData['created_at'] = date('jS M Y, h:i A', strtotime($getData['created_at']));
                $getData['updated_at'] = date('jS M Y, h:i A', strtotime($getData['updated_at']));
                $dataArray[] = $getData;
            }
            $teamMemberList['bonusReward'] = $dataArray;
            $response['result'] = '1';
            $response['response'] = $teamMemberList;
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function directRewardReportList($userId, $data = array())
    {
        /*$usersData1 = $this->db->select('*')->from('users')->where('refer_by', $userId)->get()->result_array();
        if ($usersData1) {
            foreach ($usersData1 as $user1) {
                $usersData2 = $this->db->select('*')->from('users')->where_in('refer_by', $user1['id'])->get()->result_array();
                if ($usersData2) {
                    foreach ($usersData2 as $user2) {
                        $this->teamMemberList($user2['id'], $data);
                        $data[] = $user2;
                    }
                } else {
                    $this->teamMemberList($user1['id'], $data);
                    $data[] = $user1;
                }
            }
        }
        return $data;*/

        $query = $this->db->query("SELECT * FROM (SELECT * FROM users ORDER BY refer_by, id) users,
            (SELECT @pv := $userId) initialisation
            WHERE find_in_set(refer_by, @pv) > 0
            AND @pv := concat(@pv, ',', id)");
        $usersData = $query->result_array();
        return $usersData;
    }

    public function levelWiseMemberCount()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($user_id)) {
            $teamMemberData = $this->levelWiseMemberCountList($user_id);
            $teamMemberList['levelWiseMemberCount'] = $teamMemberData;
            $response['result'] = '1';
            $response['response'] = $teamMemberList;
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function levelWiseMemberCountList($userId, $data = array())
    {
        $usersLevels = array();
        $referralIds = [$userId];
        for ($i = 1; $i <= 10; $i++) {
            $userRecords = [];
            if (!empty($referralIds))
                $userRecords = $this->db->select('*')->from('users')->where_in('refer_by', $referralIds)->get()->result_array();
            if (!empty($userRecords)) {
                $usersLevels[] = ['level' => $i, 'members' => count($userRecords), 'income' => (string)array_sum(array_column($userRecords, 'wallet'))];
                $referralIds = array_column($userRecords, 'id');
            } else {
                $usersLevels[] = ['level' => $i, 'members' => 0, 'income' => '0.00'];
            }
        }
        return $usersLevels;
    }

    public function levelWiseMemberList()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $user_id = $data['user_id'];
        $level = $data['level'];

        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($user_id)) {
            $dataArray = $this->levelWiseMember($user_id, $level);
            $levelWiseMemberList['levelWiseMemberCount'] = count($dataArray);

            $aaData = array();
            foreach ($dataArray as $getData) {
                $userReferBy = $this->db->select('*')->from('users')->where('id', $getData['refer_by'])->get()->row_array();
                if ($userReferBy) {
                    $getData['referredByUser'] = $userReferBy['first_name'] . ' ' . $userReferBy['last_name'];
                } else {
                    $getData['referredByUser'] = '';
                }
                $aaData[] = $getData;
            }
            $levelWiseMemberList['levelWiseMember'] = $aaData;
            $response['result'] = '1';
            $response['response'] = $levelWiseMemberList;
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function levelWiseMember($user_id, $level)
    {
        $referralIds = [$user_id];
        $userRecords = [];
        for ($i = 1; $i <= 10; $i++) {
            if (!empty($referralIds))
                $userRecords = $this->db->select('*')->from('users')->where_in('refer_by', $referralIds)->get()->result_array();
            if (!empty($userRecords)) {
                $referralIds = array_column($userRecords, 'id');
            } else {
                break;
            }
            if ($i == $level) break;
        }
        return $userRecords;
    }

    // Get all Other services type
    public function otherservicestype()
    {
        $otherservices = $this->api->getAllRecordsE('master_services', array());
        if ($otherservices && count($otherservices) > 0) {
            $response['result'] = '1';
            $response['response'] = $otherservices;
        } else {
            $response['result'] = '0';
            $response['response'] = "No service available";
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Submit Request for other services
    public function otherservicesreq()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        //print_r($data); die;
        if (isset($data['master_services_id']) && isset($data['content']) && isset($data['client_id'])) {
            $dataArray = array();
            $dataArray['master_services_id'] = $data['master_services_id'];
            $dataArray['content'] = $data['content'];
            $dataArray['client_id'] = $data['client_id'];
            $addotherservices = $this->api->addNewRecord('other_services', $dataArray);
            if ($addotherservices) {
                $response['result'] = '1';
                $response['response'] = 'Your request has been sent successfully';
                $msg = "User #" . $data['client_id'] . " has requested Other Request";
                $this->sendemail($this->api->getSettings('admin_email'), "Other Request", $msg);
            } else {
                $response['result'] = '1';
                $response['response'] = 'Error in Submitting Request';
            }
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Get my other services list
    public function myotherservices()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $statuses = array('P' => 'Pending', 'C' => 'Completed', 'R' => 'Rejected');
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['client_id'])) {
            $condition = array('client_id' => $data['client_id']);
            $otherservices = $this->api->getAllRecordsE('other_services', $condition);
            if ($otherservices && count($otherservices) > 0) {
                foreach ($otherservices as $services) {
                    $status = $services['status'];
                    $status_string = $statuses[$status];
                    $services['status'] = $status_string;
                    $myotherservices[] = $services;
                }
                $response['result'] = '1';
                $response['response'] = $myotherservices;
            } else {
                $response['result'] = '0';
                $response['response'] = 'No service available';
            }
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Doing chat with the person for the case.
    public function dochat()
    {
//		$data = json_decode(file_get_contents('php://input'), true);

        $data = (isset($_POST)) ? $_POST : array();
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['client_id']) && isset($data['lawyer_id']) && isset($data['case_id']) && isset($data['message'])) {
            $dataArray = array();
            $dataArray['client_id'] = $data['client_id'];
            $dataArray['lawyer_id'] = $data['lawyer_id'];
            $dataArray['case_id'] = $data['case_id'];
            $dataArray['message'] = $data['message'];
            $dataArray['sender_id'] = $data['sender_id'];


            $getDocument1 = '';
            if (isset($_FILES['attachment'])) {
                $document1 = $this->uploadDocument('attachment');
                if ($document1['status'] == true) ;
                {
                    $getDocument1 = $document1['data'];
                }
                $dataArray['attachment'] = $getDocument1;

                $extension = pathinfo(base_url() . 'upload/' . $getDocument1, PATHINFO_EXTENSION);
                $dataArray['attachment_type'] = $extension;
                $dataArray['attachment_fullpath'] = base_url() . 'upload/' . $getDocument1;

            }

            $addotherservices = $this->api->addNewRecord('chat_message', $dataArray);

            if ($data['client_id'] == $data['sender_id']) {
                $to_user_id = $data['lawyer_id'];
            } else {
                $to_user_id = $data['client_id'];
            }
            // Saving notification for the user who have shared the evidences
            $user_detail = $this->api->getSingleRecordById($data['sender_id'], 'users');
            $full_name = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
            $notification_data['user_id'] = $to_user_id;
            $notification_data['message'] = 'You have received message from ' . $full_name;
            $notification_data['redirect_to'] = 'received_message';
            $notification_data['created_date'] = date('Y-m-d H:i:s');
            $CaseDetail = $this->api->getSingleRecordById($dataArray['case_id'], 'request');
            $notification_data['client_id'] = ($dataArray['client_id'] != null) ? $dataArray['client_id'] : '';
            $notification_data['case_name'] = $CaseDetail['case_name'];
            $notification_data['case_id'] = $dataArray['case_id'];
            $notification_data['lawyer_id'] = $dataArray['lawyer_id'];

            $notification = $this->api->addNewRecord('notification', $notification_data);
            // Send Push Notification to user
            $title = 'Received new Message.';
            $message = 'You have received message from ' . $full_name;

            $this->sendpushnotification($to_user_id, $message, $title);
            $userDetailsMail = $this->api->getSingleRecordById($to_user_id, 'users');
            $this->sendemail($userDetailsMail['email'], $title, $message);
            $response['result'] = '1';
            $response['response'] = 'Message sent';
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Get my other chat list
    public function mychat()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['user_id']) && isset($data['role']) && isset($data['case_id'])) {
            $role = $data['role'];
            $case_id = $data['case_id'];
            if ($role == 'Lawyer') {
                $condition = array('lawyer_id' => $data['user_id'], 'case_id' => $case_id);
            } else {
                $condition = array('client_id' => $data['user_id'], 'case_id' => $case_id);
            }
            $chat_data = $this->api->getAllRecordsE('chat_message', $condition);

            if ($chat_data && count($chat_data) > 0) {
                $response['result'] = '1';
                $response['response'] = $chat_data;
            } else {
                $response['result'] = '0';
                $response['response'] = 'No service available';
            }
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // Update Case Progress
    public function updatecaseprogress()
    {
        //$data = json_decode(file_get_contents('php://input'), true);
        $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
        $txt = print_r($_POST, true);
        fwrite($myfile, $txt);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        //print_r($data); die;
        if (isset($_POST['user_id']) && isset($_POST['case_id'])) {
            $dataArray = array();
            if (isset($_POST['progress']) && !empty($_POST['progress'])) {
                $dataArray['progress'] = $_POST['progress'];
                if ($_POST['progress'] == 'Reject') {
                    $dataArray['commission'] = '0';
                    $dataArray['commission_percentage'] = '0';
                    $dataArray['amount'] = '0';
                    $dataArray['co_status'] = 'Default';
                    $dataArray['laywer_id'] = '0';
                }
                if ($_POST['progress'] == 'InCourt') {
                    $dataArray['request_status'] = 'Move_to_court';
                }

                $userDetailsMail = $this->api->getSingleRecordById($data['user_id'], 'users');
                $title = 'Case Status Change';
                $message = 'Case Status change to ' . $_POST['progress'];
                $this->sendemail($userDetailsMail['email'], $title, $message);
            }
            if (isset($_POST['amount']) && !empty($_POST['amount'])) {
                $condition = array('field_key' => 'commission');
                $global_setting = $this->api->getAllRecordsE('settings', $condition);
                $commission_percentage = $global_setting[0]['field_value'];
                $commision_amount = ($commission_percentage / 100) * $_POST['amount'];
                $dataArray['commission'] = $commision_amount;
                $dataArray['commission_percentage'] = $commission_percentage;
                $dataArray['amount'] = $_POST['amount'];
                $dataArray['co_status'] = 'Request';
            }
            if (isset($_FILES['agreement']) && $_FILES['agreement']) {
                $fileName = time() . '_' . $_FILES['agreement']['name'];
                $tempName = $_FILES['agreement']['tmp_name'];
                $filePath = $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $fileName;
                $allowed = array();
                if ($_POST['type'] == 'docx') {
                    $allowed = array('docx');
                } elseif ($_POST['type'] == 'pdf') {
                    $allowed = array('pdf');
                }
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                if (!$extension || empty($extension) || !in_array($extension, $allowed)) {
                    $response['result'] = '0';
                    $response['response'] = 'invalid extension';
                    //return;
                } else {
                    if (!move_uploaded_file($tempName, $filePath)) {
                        if (!empty($_FILES["agreement"]["error"])) {
                            $listOfErrors = array(
                                '1' => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
                                '2' => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
                                '3' => 'The uploaded file was only partially uploaded.',
                                '4' => 'No file was uploaded.',
                                '6' => 'Missing a temporary folder. Introduced in PHP 5.0.3.',
                                '7' => 'Failed to write file to disk. Introduced in PHP 5.1.0.',
                                '8' => 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop; examining the list of loaded extensions with phpinfo() may help.'
                            );
                            $error = $_FILES["agreement"]["error"];
                            if (!empty($listOfErrors[$error])) {
                                //echo $listOfErrors[$error];
                                $response['result'] = '0';
                                $response['response'] = $listOfErrors[$error];
                            } else {
                                $response['result'] = '0';
                                $response['response'] = 'Not uploaded because of error #' . $_FILES["agreement"]["error"];
                            }
                        } else {
                            $response['result'] = '0';
                            $response['response'] = 'Problem saving file: ' . $tempName;
                        }
                    } else {
                        $data = array();
                        $dataArray['agreement'] = $fileName;
                    }
                }
            }
            $updatecase = $this->api->update($dataArray, $_POST['case_id'], 'request');
            if ($updatecase) {
                $response['result'] = '1';
                $response['response'] = 'Case has been updated successfully.';
            } else {
                $response['result'] = '0';
                $response['response'] = 'Error in Updating Case';
            }
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    // cancel assign lawyer request API
    public function cancelrequest()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['case_id']) && isset($data['lawyer_id'])) {
            $case_id = $data['case_id'];
            $lawyer_id = $data['lawyer_id'];
            $data_array = array();
            $data_array['case_id'] = $case_id;
            $data_array['lawyer_id'] = $lawyer_id;
            $data_array['status'] = 'C';
            $updateprofile = $this->api->cancelrequest($data_array, array('lawyer_id' => $lawyer_id, 'case_id' => $case_id), 'case_lawyer');
            if ($updateprofile) {
                $dataArray['laywer_id'] = '0';
                $updatecase = $this->api->update($dataArray, $case_id, 'request');
                $getres = $this->api->autosendrrequest($case_id);
                if ($getres) {
                    $newlawyerID = $getres['0']['id'];
                }
                // Sending Push Notification to Lawyer
                $case_detail = $this->api->getSingleRecordById($case_id, 'request');
                $lawyer_id = $lawyer_id;
                $title = 'Case Request Declided';
                $message = 'You have declided the request of the Case ' . $case_detail['case_name'] . '.';
                $this->sendpushnotification($lawyer_id, $message, $title);

                $userDetailsMail = $this->api->getSingleRecordById($lawyer_id, 'users');
                $this->sendemail($userDetailsMail['email'], $title, $message);
                // End
                $response = array('result' => '1', 'response' => 'Request canceled successfully');
            } else {
                $response = array('result' => '0', 'response' => 'Opps! Somthing Error!');
            }
        } else {
            $response = array('result' => '0', 'response' => 'Invalid Data');
        }
        echo json_encode($response);
    }

    // cancel assign lawyer request API
    public function acceptrequest()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['case_id']) && isset($data['lawyer_id'])) {
            $case_id = $data['case_id'];
            $lawyer_id = $data['lawyer_id'];
            $data_array = array();
            $data_array['case_id'] = $case_id;
            $data_array['lawyer_id'] = $lawyer_id;
            $data_array['status'] = 'A';
            $updateprofile = $this->api->cancelrequest($data_array, array('lawyer_id' => $lawyer_id, 'case_id' => $case_id), 'case_lawyer');
            if ($updateprofile) {
                $dataArray['progress'] = 'Inprogress';
                $updatecase = $this->api->update($dataArray, $case_id, 'request');
                // Sending Push Notification to Lawyer
                $case_detail = $this->api->getSingleRecordById($case_id, 'request');
                $client_id = $case_detail['client_id'];
                $title = ' Case Request Accepted';
                $message = 'Lawyer have accepted your Case ' . $case_detail['case_name'] . '. Goto Case List to see the detail';
                $this->sendpushnotification($client_id, $message, $title);

                $userDetailsMail = $this->api->getSingleRecordById($client_id, 'users');
                $this->sendemail($userDetailsMail['email'], $title, $message);
                // End
                $response = array('result' => '1', 'response' => 'Request accepted  successfully');
            } else {
                $response = array('result' => '0', 'response' => 'Opps! Somthing Error!');
            }
        } else {
            $response = array('result' => '0', 'response' => 'Invalid Data');
        }
        echo json_encode($response);
    }

    // Sending Push notification functionality.
    public function sendpushnotification($user_id = '', $message = '', $title = '')
    {
        //echo $user_id; die;
        $user_detail = $this->api->getSingleRecordById($user_id, 'users');
        $regId = $user_detail['fcm_device_id'];
        $device_type = $user_detail['device_type'];
        $notification = array();
        $arrNotification = array();
        $arrData = array();
        $arrNotification["body"] = $message;
        $arrNotification["title"] = $title;
        $arrNotification["sound"] = "default";
        $arrNotification["android_channel_id"] = "247_sue";
        $arrNotification["click_action"] = "FLUTTER_NOTIFICATION_CLICK";

        $notification = $this->api->send_notification($regId, $arrNotification, $device_type);
        return true;
    }

    // Get User current membership plan
    public function getcurrentmembershipplan()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['user_id'])) {
            $user_id = $data['user_id'];
            $plan_detail = $this->api->current_membership_plan($user_id);
            $plan_detail['applepayfee'] = $this->api->getSettings('applepayfee');
            $response = array('result' => '1', 'response' => $plan_detail);
        } else {
            $response = array('result' => '0', 'response' => 'Invalid Data');
        }
        echo json_encode($response);
    }

    // Making Payment for the evidence.
    public function makepaymentforevidence()
    {
        //mail("ravi@softechplanet.com","My Subject","My body");
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['evidence_id']) && isset($data['txn_no']) && isset($data['amount']) && isset($data['shared_by'])) {
            // Update Evidence Status
            $data_array['payment_status'] = 'Y';
            $update_evidence_status = $this->api->update($data_array, $data['evidence_id'], 'evidences');

            // Get Evicence sharing commision
            $condition = array('field_key' => 'evidence_commission');
            $global_setting = $this->api->getAllRecordsE('settings', $condition);
            $commission_percentage = $global_setting[0]['field_value'];
            $commision_amount = ($commission_percentage / 100) * $data['amount'];

            // Add Send Transcations
            $p_transcation_data['user_id'] = $data['user_id'];
            $p_transcation_data['txn_no'] = $data['txn_no'];
            $p_transcation_data['txn_desc'] = 'Paid for Evidence';
            $p_transcation_data['amount'] = $data['amount'];
            $p_transcation_data['to_user_id'] = $data['shared_by'];
            $p_transcation = $this->api->addNewRecord('transactions', $p_transcation_data);

            // Add Receiving Transcation
            $user_detail = $this->api->getSingleRecordById($data['user_id'], 'users');
            $full_name = $user_detail['first_name'] . ' ' . $user_detail['last_name'];
            $r_transcation_data['user_id'] = $data['shared_by'];
            $r_transcation_data['txn_no'] = $data['txn_no'];
            $r_transcation_data['txn_desc'] = 'You have Received Payment for the Evidence from ' . $full_name;
            $r_transcation_data['amount'] = $data['amount'];
            $r_transcation_data['to_user_id'] = $data['user_id'];
            $r_transcation = $this->api->addNewRecord('transactions', $r_transcation_data);
            // Saving notification for the user who have shared the evidences
            $r_notification_data['user_id'] = $data['shared_by'];
            $r_notification_data['message'] = 'You have Received Payment for the Evidence from ' . $full_name;
            $r_notification_data['redirect_to'] = 'received_payment_for_evidence';
            $r_notification_data['created_date'] = date('Y-m-d H:i:s');
            $r_notification = $this->api->addNewRecord('notification', $r_notification_data);

            // Adding Admin commision to transcation
            $c_transcation_data['user_id'] = $data['shared_by'];
            $c_transcation_data['txn_desc'] = 'Deducted Evidence sharing Commision of ' . $commision_amount . ' Naira from wallet';
            $c_transcation_data['amount'] = $commision_amount;
            $c_transcation = $this->api->addNewRecord('transactions', $c_transcation_data);
            // End
            // Add amount to User wallet.
            $wallet_amount = $data['amount'] - $commision_amount;
            $update_wallet = $this->api->updatewallet($wallet_amount, $data['shared_by']);

            // Sending Push Notification to User after receiving payment.
            $title = 'You have received Payment for Evidence.';
            $message = 'You have Received Payment for the Evidence from ' . $full_name;
            $this->sendpushnotification($data['shared_by'], $message, $title);
            $userDetailsMail = $this->api->getSingleRecordById($data['shared_by'], 'users');
            $this->sendemail($userDetailsMail['email'], $title, $message);
            // End
            $response = array('result' => '1', 'response' => 'Your Payment for the Evidence has been succesfull.');
        } else {
            $response = array('result' => '0', 'response' => 'Invalid Data');
        }
        echo json_encode($response);
    }

    // Getting My Transcation List
    public function mytranscations()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['user_id'])) {
            // Update Evidence Status
            $userDetail = $this->api->getSingleRecordById($data['user_id'], 'users');
            $condition = array('user_id' => $data['user_id']);
            $transactionData = $this->api->getAllRecordsE('transactions', $condition);
            $response['result'] = '1';
            $response['wallet_amount'] = $userDetail['wallet'];
            $response['response'] = $transactionData;
        } else {
            $response = array('result' => '0', 'response' => 'Invalid Data');
        }
        echo json_encode($response);
    }

    // Getting My Notification List
    public function mynotification()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['user_id'])) {
            $condition = array('user_id' => $data['user_id']);
            $notification_data = $this->api->getAllRecordsE('notification', $condition);
            $response['result'] = '1';
            $response['response'] = $notification_data;
        } else {
            $response = array('result' => '0', 'response' => 'Invalid Data');
        }
        echo json_encode($response);
    }

    public function sendtestnotification()
    {
        $title = 'Testing notofication';
        $message = 'You have Received test notification';
        $user_id = '187';
        $notification = $this->sendpushnotification($user_id, $message, $title);
        print_r($notification);
        die;
    }

    public function txn()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if (isset($data['user_id'])) {
            $evidencelist = $this->api->txnListByUserID($data['user_id']);
            $response['result'] = '1';
            $response['response'] = $evidencelist;
        } else {
            $response['result'] = '0';
            $response['response'] = 'Invalid Data';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function requestfund()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        try {
            if (!isset($data['user_id'])) {
                throw new \Exception('Invalid Data.');
            }

            if (!isset($data['amount'])) {
                throw new \Exception('Invalid Data.');
            }

            $user = $this->api->getSingleRecordById($data['user_id'], 'users');
            if (empty($user)) {
                throw new \Exception("This user doesn't do exiest in our records.");
            }

            $testing = $user['wallet'] . '----' . $data['amount'] . '----' . $data['user_id'];
            //mail("ravi@softechplanet.com","My Subject",$testing);

            if ($user['wallet'] < $data['amount']) {
//				mail("ravi@softechplanet.com","My Subject",$testing);
//				mail("hiten.digitalrooar@gmail.com","My Subject",$testing);
                throw new \Exception("Your wallet balance is low.");
            }

            $minimum_request = $this->api->getSettings('minimum_withdrawal_amount');

            if ($minimum_request > $data['amount']) {
                throw new \Exception("You can't make minimum request below " . $minimum_request);
            }
            $fee = $this->api->getSettings('fee');
            $requestAmt = $data['amount'];
            $net_amt = $data['amount'] - $fee;

            $insertData = array();
            $insertData['user_id'] = $data['user_id'];
            $insertData['amount'] = $requestAmt;
            $insertData['net_amt'] = $net_amt;
            $insertData['fee'] = $fee;
            $insertData['status'] = 'Pending';
            $insertData['created_date'] = date("Y-m-d");
            $insert = $this->api->addNewRecord('wallet_request', $insertData);
            if ($insert) {
                $requestDetail = $this->api->getSingleRecordById($insert, 'wallet_request');
                $row = $this->api->getSingleRecordById($insert, 'wallet_request');

                if ($insert) {
                    $msg = "User #" . $data['user_id'] . " has requested a wallet of " . $data['amount'] . " NGN";
                    $msg = wordwrap($msg, 70);
//		             mail($this->api->getSettings('admin_email'),"Wallet Request",$msg);
                    $this->sendemail($this->api->getSettings('admin_email'), "Wallet Request", $msg);
                    $userDetailsMail = $this->api->getSingleRecordById($data['user_id'], 'users');

                    $this->sendemail($userDetailsMail['email'], "Wallet Request", $msg);
                    $transactionData = array();
                    $transactionData['user_id'] = $row['user_id'];
                    $transactionData['txn_no'] = rand();
                    $transactionData['txn_desc'] = 'Funds requested by user';
                    $transactionData['amount'] = $row['amount'];
                    $transaction = $this->api->addNewRecord('transactions', $transactionData);
                    $userDetails = $this->api->getSingleRecordById($row['user_id'], 'users');

                    $oldWalletAmt = $userDetails['wallet'];
                    $approvedAmout = $row['amount'];
                    $updateWalletAmount = $oldWalletAmt - $approvedAmout;
                    $updateWallet = array();
                    $updateWallet['wallet'] = $updateWalletAmount;
                    $this->api->update($updateWallet, $row['user_id'], 'users');
                }


                $response['result'] = '1';
                $response['response'] = $requestDetail;
            } else {
                $response['result'] = '1';
                $response['response'] = '';
            }


        } catch (Exception $e) {
            $response['result'] = '0';
            $response['response'] = $e->getMessage();
        }


        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function wallet_history($user_id = '')
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $response = array();
        $response['result'] = '0';
        $response['response'] = '';
        if ($user_id) {
            $wallethistory = $this->api->wallethistory($user_id);
            $response['result'] = '1';
            $response['response'] = $wallethistory;
        } else {
            $response['result'] = '1';
            $response['response'] = '';
        }
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function sendemail($email = "", $title = "", $msg = "")
    {
        //$title = "test";
        //$msg = "test";
        //$config['protocol'] = 'smtp';
        //$config['smtp_host'] = 'smtp.gmail.com';
        //$config['smtp_port'] = 587;
        //$config['smtp_user']  = 'cemiehwe@gmail.com';
        //$config['smtp_pass']  = 'gvtwtkanfjhmahdf';
        //$config['_smtp_auth'] = true;
        //$config['smtp_crypto'] = 'tls';
        //$config['protocol'] = 'smtp';
        //$config['mailtype']  = 'html';
        //$config['charset']    = 'iso-8859-1';
        //$config['wordwrap']   = TRUE;
        //$config['protocol'] = 'smtp';
        //$config['smtp_host'] = 'smtp.office365.com';
        //$config['smtp_port'] = 587;
        //$config['smtp_user']  = 'info@247sue.com';
        //$config['smtp_pass']  = 'Suetest123!';
        ////$config['_smtp_auth'] = true;
        //$config['smtp_crypto'] = 'tls';
        //$config['protocol'] = 'smtp';
        //$config['mailtype']  = 'html';
        //$config['charset']    = 'iso-8859-1';
        //$config['wordwrap']   = TRUE;

        //$config['smtp_crypto'] = 'tls';
        //$config['protocol'] = 'smtp';
        //$config['smtp_host'] = 'smtp.office365.com';
        //$config['smtp_user'] = 'info@247sue.com';
        //$config['smtp_pass'] = 'Suetest123!';
        //$config['smtp_port'] = '587';
        //$config['charset']='utf-8'; // Default should be utf-8 (this should be a text field)
        //$config['newline']="\r\n"; //"\r\n" or "\n" or "\r". DEFAULT should be "\r\n"
        //$config['crlf'] = "\r\n"; //"\r\n" or "\n" or "\r" DEFAULT should be "\r\n"
        //$this->load->library('email');
        //$this->email->initialize($config);
        $content = '<table cellspacing="0" cellpadding="0" border="0" width="650" align="center" style="border:1px solid #e2e2e2;color:#13324b;font-family:Arial,Helvetica,sans-serif;font-size:12px;font-weight:normal"><tbody><tr><td align="center" valign="top"><table cellspacing="0" cellpadding="0" width="100%" align="center" style="color:#000000;font-size:12px"><tbody><tr><td valign="top" bgcolor="#ffffff" style="text-align:center;padding:10px 0 0 0;border-bottom:1px solid #e2e2e2"><a href="https://247sue.com" target="_blank" ><img src="https://247sue.com/assets/images/logo.jpg" style="margin-bottom:10px;" border="0"></a></td></tr><tr><td style="padding:10px 10px 20px" align="center" valign="top"><table width="100%" cellspacing="0" cellpadding="0" align="center" style="font-size:12px;color:#333"><tbody><tr><td align="left" style="padding:10px 0;font-size:12px"><strong style="font-size:18px;color:#333;font-family:Arial,Helvetica,sans-serif">  Following message received via  247sue</strong></td></tr><tr><td height="5"></td></tr><tr><td width="100%" border="0"><table width="100%" align="center" cellpadding="0" cellspacing="0" style="font-size:13px;color:#666666;border-collapse:collapse;border:1px solid #ccc;border-bottom:0"><tbody>';
        $content .= '<tr><td style="font-family:Arial,Helvetica,sans-serif;padding:10px;border-bottom:1px solid #ccc;width:66%">' . $msg . '</td></tr>';
        $content .= '</tbody></table></td></tr></tbody></table></td></tr><tr><td><table cellpadding="0" cellspacing="0" border="0" width="100%" style="line-height:18px;padding:10px;border-top:solid 1px #ccc"><tbody><tr><td align="left" width="50%" style="text-align:left;font-size:12px;font-family:Arial,Helvetica,sans-serif"><strong>Thanks &amp; Regards</strong><br> 247sue Team</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>';
        //echo $content;exit;
        //$this->email->set_newline("\r\n");
        //$this->email->from('info@247sue.com');  //same email u use for smtp_user
        ////$this->email->to($email);
        //$this->email->to('hiten.digitalrooar@gmail.com');
        //$this->email->subject($title);
        //$this->email->message($content);
        //$reponse = $this->email->send();
        //return  $reponse;
        //print_r($reponse);exit;
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@247sue.com';
        $mail->Password = 'Suetest123!';
        $mail->SMTPSecure = 'STARTTLS';
        $mail->Port = 587;

        $mail->setFrom('info@247sue.com', '247sue');
        //$mail->addReplyTo('hiten.digitalrooar@gmail.com', 'Hiten');

        $mail->addAddress($email);
        $mail->Subject = $title;
        $mail->isHTML(true);
        $mail->Body = $content;
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

}

