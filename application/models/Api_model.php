<?php

/**
 * Common_Model Model for Admin and site
 */
class Api_Model extends CI_Model
{

    function __construct()
    {

    }

    //-- check valid user
    function validate_user($username, $password)
    {
        $this->db->select('users.*');
        $this->db->where('email', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    //-- check if evidence shared
    function check_evidence_shared($evidence_id, $user_id)
    {
        $this->db->select('users.*');
        $this->db->where('email', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }


//-- check exist email
    function checkExistEmail($mobile)
    {
        $this->db->select('users.*');
        $this->db->where('mobile', $mobile);
        $this->db->limit(1);
        $query = $this->db->get('users');
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function checkReferCodeExiest($refer_code)
    {
        $query = $this->db->select('users.*')->where('refer_code', $refer_code)->limit(1)->get('users');
        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return false;
        }
    }


    // Check Email already exists while signup
    function checkAlredyEmailexiest($email, $user_id = '')
    {
        $this->db->select('users.*');
        $this->db->where('email', $email);
        if ($user_id > 0) {
            $this->db->where('user_id!=', $user_id);
        }
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    // Check if event is already shared
    function checkEventsShared($evidence_id, $user_id = '')
    {
        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $this->db->where('shared_evidence_id', $evidence_id);
        //$this->db->from('evidences');
        $query = $this->db->get('evidences');
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    // Get Evidence Detail
    function getEvidenceDetail($evidence_id, $user_id = '')
    {
        $this->db->select('*');
        $this->db->where('user_id', $user_id);
        $this->db->where('id', $evidence_id);
        //$this->db->from('evidences');
        $query = $this->db->get('evidences');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    // Check Mobile already exists while signup
    function checkifmobilealreadyexists($mobile, $user_id = '')
    {
        $this->db->select('users.*');
        $this->db->where('mobile', $mobile);
        if ($user_id > 0) {
            $this->db->where('user_id!=', $user_id);
        }
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }


    function addNewRecord($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function getCaseEvidenceList($case_id)
    {
        //case_evidences
        $this->db->select('c.*');
        // $this->db->select('c.evidance_id');
        $this->db->select('e.user_id, e.title, e.type, e.url, e.description, e.lat, e.long, e.location, e.created_date');
        $this->db->where('case_id', $case_id);
        $this->db->join('evidences as e', 'c.evidance_id = e.id', 'left');
        $this->db->order_by('e.id', 'desc');
        $this->db->from('case_evidences as c');
        $query = $this->db->get();
        //echo '<pre>'; print_r($query->result_array()); die;
        return $query->result_array();
    }

    // Update Record by ID
    function update($action, $id, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $action);
        //return $this->db->affected_rows();
        return true;
    }

// Get Single Record by ID
    function getSingleRecordById($id, $table)
    {
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $this->db->where('id', $id);
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    // Get Single Record by ID
    function getAllRecords($table, $where = array())
    {
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }

    function getAllRecordsE($table, $where = array())
    {
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getAllPlans($table, $where = array())
    {
        $this->db->select('*');
        $this->db->order_by('id', 'ASC');
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function getEvidenceList($table, $where = array())
    {
        $this->db->select('*');
        $this->db->order_by('created_date', 'DESC');
        $this->db->order_by('type', 'DESC');
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->result_array();
        $evidence_arr = array();
        foreach ($result as $evidences) {
            if ($evidences['shared_by'] > 0 && $evidences['payment_status'] == 'N') {

                unset($evidences);

            } else {
                $evidence_arr[] = $evidences;
            }
        }
        return $evidence_arr;
    }


    function getrequest($request_status = '')
    {
        $this->db->select('request.*');
        $this->db->select('c.first_name as client_first_name, c.last_name as client_last_name');
        $this->db->select('l.first_name as laywer_first_name, l.last_name as laywer_last_name');
        if (!empty($request_status)) {
            $this->db->where('request.request_status', $request_status);
        }
        $this->db->from('request');
        $this->db->join('users as c', 'c.id = request.client_id', 'left');
        $this->db->join('users as l', 'l.id = request.laywer_id', 'left');
        $this->db->order_by('request.id', 'desc');
        $query = $this->db->get();
        //echo '<pre>'; print_r($query->result_array()); die;
        return $query->result_array();
    }


    function getrequestByUserID($userID = array(), $progress = '', $request_status = '')
    {
        $this->db->select('request.*');
        $this->db->select('c.first_name as client_first_name, c.last_name as client_last_name,c.l_location as client_location,c.mobile as client_mobile');
        $this->db->select('l.first_name as laywer_first_name, l.last_name as laywer_last_name, l.l_location as laywer_location, l.mobile as laywer_mobile');
        if (!empty($userID)) {
            $this->db->where($userID);
        }
        if (!empty($request_status)) {
            $this->db->where('request_status', $request_status);
        }
        if (!empty($progress)) {
            $this->db->where('request.progress', $progress);
        }
        $this->db->from('request');
        $this->db->join('users as c', 'c.id = request.client_id', 'left');
        $this->db->join('users as l', 'l.id = request.laywer_id', 'left');
        $this->db->order_by('request.id', 'desc');
        $query = $this->db->get();
        //echo '<pre>'; print_r($query->result_array()); die;
        return $query->result_array();
    }


    // Get All membership Plans
    function getAllMembershipPlans($table, $where = array())
    {
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->from($table);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }


    function AutoAssignnearestlawyer($case_id)
    {
        //To search by kilometers instead of miles, replace 3959 with 6371.
        $caseDetails = $this->casedetails($case_id);
        $lat = $caseDetails['c_latitude'];
        $long = $caseDetails['c_longitude'];
        //$query = "SELECT id  ,first_name , last_name , address , email , mobile ,   ROUND(6371 * acos(cos(radians('$lat')) * cos(radians(l_latitude)) * cos(radians(l_longitude) - radians('$long')) + sin(radians('$lat')) * sin(radians(l_latitude)))) as distance,l_longitude,l_latitude from  users where role='lawyer' HAVING distance > 0 order by distance LIMIT 0,1";
        $query = "SELECT id  ,first_name , last_name , address , email , mobile ,   ROUND(6371 * acos(cos(radians('$lat')) * cos(radians(l_latitude)) * cos(radians(l_longitude) - radians('$long')) + sin(radians('$lat')) * sin(radians(l_latitude)))) as distance,l_longitude,l_latitude from  users where role='lawyer' order by distance LIMIT 0,1";
        $querys = $this->db->query($query);
        $settingdistanceresult = $querys->result_array();
        //print_r($settingdistanceresult); die;
        return $settingdistanceresult;
    }

    function casedetails($caseid)
    {
        $this->db->select('*');
        $this->db->where('id', $caseid);
        $this->db->from('request');
        $query = $this->db->get();
        return $casedetails = $query->row_array();
    }

    // cancelrequest Record by ID
    function cancelrequest($action, $where, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $action);
        //return $this->db->affected_rows();
        return true;
    }

    function autosendrrequest($case_id)
    {
        $q = 'SELECT id ,GROUP_CONCAT(lawyer_id) as lawyerids FROM case_lawyer   WHERE case_id ="' . $case_id . '" GROUP BY case_id';
        $queryresult = $this->db->query($q);
        $getresult = $queryresult->row_array();
        if ($getresult) {
            $ids = $getresult['lawyerids'];
        } else {
            $ids = '';
        }
        //To search by kilometers instead of miles, replace 3959 with 6371.
        $caseDetails = $this->casedetails($case_id);
        $lat = $caseDetails['c_latitude'];
        $long = $caseDetails['c_longitude'];
        $query = "SELECT id  ,first_name , last_name , address , email , mobile ,   ROUND(6371 * acos(cos(radians('$lat')) * cos(radians(l_latitude)) * cos(radians(l_longitude) - radians('$long')) + sin(radians('$lat')) * sin(radians(l_latitude)))) as distance,l_longitude,l_latitude from  users where `id` NOT IN (" . $ids . ") &&  role='lawyer' HAVING distance > 0 order by distance LIMIT 0,1 ";
        $querys = $this->db->query($query);
        $settingdistanceresult = $querys->result_array();
        return $settingdistanceresult;
    }


    // Send Push notification to mobile devices
    public function send_notification($registatoin_ids, $notification, $device_type)
    {
//            ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL); 
        $apns = array("headers" => array("apns-priority" => "5", "apns-expiration" => "0"));
        $android = array("priority" => "high", "ttl" => "0s");
        $webpush = array("headers" => array("Urgency" => "high", "TTL" => "0"));


        $url = 'https://fcm.googleapis.com/fcm/send';
        if ($device_type == "android") {
            $fields = array(
                'registration_ids' => array($registatoin_ids),
                'data' => $notification,
                'collapse_key' => 'collapse_key',
                'notification' => $notification,
                'apns' => $apns,
                'android' => $android,
                'webpush' => $webpush
            );
        } else {
            $fields = array(
                'registration_ids' => array($registatoin_ids),
                'data' => $notification,
                'collapse_key' => 'collapse_key',
                'notification' => $notification,
                'apns' => $apns,
                'android' => $android,
                'webpush' => $webpush
            );
        }
//                echo json_encode($fields);exit;
        // Firebase API Key
        $headers = array('Authorization:key=' . FIREBASEKEY, 'Content-Type:application/json');
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //print_r($result); die;
        if ($result === FALSE) {
//			die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        $txt = print_r($result, true);
        fwrite($myfile, $txt);

    }

    // Checking Membership Plan
    public function current_membership_plan($user_id)
    {
        $user_detail = $this->getSingleRecordById($user_id, 'users');
        //$plan_id = $user_detail['plan_id'];

        /* Start New One */
        $plan_expiry = date('Y-m-d', strtotime($user_detail['plan_expiry']));
        $currentDate = date('Y-m-d');
        if ($plan_expiry >= $currentDate) {
            $plan_id = $user_detail['plan_id'];
        } else {
            $plan_id = 1;
        }
        /* Start New One */

        $plan_arr = array(
            'number_of_cases' => 'No of Cases (Per year)',
            'messaging' => 'Messaging',
            'video_recording' => 'Video recording',
            'evidence_sharing' => 'Evidence sharing',
            'representation' => 'Representation',
            'storage_space' => 'Storage space (in GB)',
            'sue_individuals' => 'Sue individuals',
            'sue_organizations' => 'Sue organizations',
            'rec_audio_evidence' => 'Rec audio evidence',
            'lawyer_assignment_timings' => 'Lawyer assignment timing',
            'criminal_cases' => 'Criminal cases',
            'court_representation' => 'Court Representation',
            'lawyer_percentage' => 'Lawyer Percentage',
            'corporations_cases' => 'Civil Cases against corporations',
            'government_agencies_cases' => 'Civil Cases against Government Agencies',
            'discount_on_bail' => 'Discount on Administrative Bail from security and Anti-Graft Agencies (in %)',

        );
        $plan_details = $this->getSingleRecordById($plan_id, 'membership_plan');
        $services = array();
        if ($plan_details['id'] == DEFAULT_PLAN_ID) {
            $plan_details['name'] = '';
        }
        foreach (unserialize($plan_details['service']) as $key => $value) {
            $name = $plan_arr[$key];
            $features['key'] = $key;
            $features['name'] = $name;
            $features['value'] = $value;
            $services[] = $features;
        }
        $plan_details['service'] = $services;
        return $plan_details;
    }


    // Checking Membership Plan
    public function current_membership_plan_params($user_id)
    {
        $user_detail = $this->getSingleRecordById($user_id, 'users');
        $plan_id = $user_detail['plan_id'];
        $plan_arr = array(
            'number_of_cases' => 'No of Cases (Per year)',
            'messaging' => 'Messaging',
            'video_recording' => 'Video recording',
            'evidence_sharing' => 'Evidence sharing',
            'representation' => 'Representation',
            'storage_space' => 'Storage space (in GB)',
            'sue_individuals' => 'Sue individuals',
            'sue_organizations' => 'Sue organizations',
            'rec_audio_evidence' => 'Rec audio evidence',
            'lawyer_assignment_timings' => 'Lawyer assignment timing',
            'criminal_cases' => 'Criminal cases',
            'court_representation' => 'Court Representation',
            'lawyer_percentage' => 'Lawyer Percentage',
        );
        $plan_details = $this->getSingleRecordById($plan_id, 'membership_plan');
        $services = unserialize($plan_details['service']);
        $plan_details['service'] = $services;
        return $plan_details;
    }


    public function getTotalsizeofEvidences($user_id)
    {
        $this->db->select('user_id, SUM(size) AS size', FALSE);
        $this->db->where('user_id', $user_id);
        //$this->db->from('evidences');
        $query = $this->db->get('evidences');
        return $query->row_array();
    }

    // Total Number of User cases
    public function total_user_cases($user_id)
    {
        $this->db->select('request.*');
        $this->db->where('client_id', $user_id);
        $query = $this->db->get('request');
        return $query->num_rows();
    }

    //My Shared Evidences
    public function getMySharedEvidence($user_id)
    {
        $this->db->select('evidences.*');
        $this->db->where('shared_by', $user_id);
        $this->db->order_by('evidences.id', 'desc');
        $query = $this->db->get('evidences');
        return $query->result_array();
    }

    // Evidence shared with me.
    public function getSharedwithmeEvidence($user_id)
    {
        $this->db->select('evidences.*');
        $this->db->where('user_id', $user_id);
        $this->db->where('shared_evidence_id >', 0);
        $this->db->order_by('evidences.id', 'desc');
        $query = $this->db->get('evidences');
        return $query->result_array();
    }

    // Evidence shared with me.
    public function updatewallet($amount, $user_id)
    {
        $this->db->set('wallet', 'wallet+' . $amount, FALSE);
        $where = array('id' => $user_id);
        $this->db->where($where);
        $this->db->update('users');
    }


    function txnListByUserID($user_id = '')
    {
        $this->db->select('transactions.*');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('transactions.id', 'desc');
        $this->db->from('transactions');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getSettings($key = '')
    {
        $this->db->select('*');
        $this->db->where('field_key', $key);
        $this->db->from('settings');
        $query = $this->db->get();
        $result = $query->row_array();
        if ($result) {
            return $result['field_value'];
        }
        return false;
    }

    function wallethistory($user_id = '')
    {
        $this->db->select('wallet_request.*');
        $this->db->where('user_id', $user_id);
        $this->db->order_by('wallet_request.id', 'desc');
        $this->db->from('wallet_request');
        $query = $this->db->get();
        return $query->result_array();
    }

}





/* New changes 15/10/19 */

