<?php
/**
* Common_Model Model for Admin and site
*/
class Common_Model extends CI_Model {

	function __construct() {

}

	

	function getAllUser($table,$order_by, $role='') {
		
		$this->db->select('*');
		if(!empty($role))
		{
			$this->db->where('role', $role);
		}
		
		$this->db->from($table);
		$this->db->order_by('id',$order_by);
		$query = $this->db->get();
		return $query->result_array();
	}


	function getAllRecord($table,$order_by) {
		
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('id',$order_by);
		$query = $this->db->get();
		return $query->result_array();
	}

	function insert($table,$data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    function getSingleRecordById($id,$table)
	 {
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $this->db->where('id', $id);
        $this->db->from($table);
        $query = $this->db->get();
		$result = $query->row_array();
        return $result;
	 }


	function update($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return true;
   	} 
	

	function getAllClient($plan_ids = null) {
		$this->db->select('users.*');
		$this->db->select('m.name');

		$this->db->where('role','Client');
		
		if(count($plan_ids) > 0){
			$this->db->where_in('users.plan_id', $plan_ids);
		}
		
		$this->db->from('users');
		$this->db->join('membership_plan as m', 'm.id = users.plan_id', 'left');
		
		$this->db->order_by('users.id','desc');
		$query = $this->db->get();
		
		return $query->result_array();
	}

	function getAllUserData()
    {
    	$this->db->select('UM.*');
        $this->db->select('US.first_name AS firstName');
        $this->db->select('US.last_name AS lastName');
        $this->db->select('US.refer_code AS referCode');
        $this->db->from('users AS UM');
        $this->db->join('users AS US', 'UM.refer_by=US.id', 'left');
        $this->db->where('UM.role','Client');
        $this->db->order_by('US.id', 'desc');
        $query = $this->db->get();
        /*echo '<pre>';
        print_r($query->result_array());
        exit();*/
        return $query->result_array();
    }
	
	// Send Push notification to mobile devices
	public function send_notification($registatoin_ids, $notification, $device_type) {
		$url = 'https://fcm.googleapis.com/fcm/send';
		if($device_type == "Android"){
			$fields = array(
			'to' => $registatoin_ids,
			'data' => $notification,
			'collapse_key' => 'collapse_key',
			'notification' => $notification
			);
		}else{
			$fields = array(
			'to' => $registatoin_ids,
			'data' => $notification,
			'collapse_key' => 'collapse_key',
			'notification' => $notification
			);
		}
		// Firebase API Key
		$headers = array('Authorization:key='.FIREBASEKEY,'Content-Type:application/json');
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
			//die('Curl failed: ' . curl_error($ch));
		}
		curl_close($ch);
	}
	
	// Get total size of evidence
	public function getTotalsizeofEvidences($user_id){ 
		$this->db->select('user_id, SUM(size) AS size', FALSE);
        $this->db->where('user_id', $user_id);
		//$this->db->from('evidences');
        $query = $this->db->get('evidences');
		return $query->row_array(); 	
	}

	function walletHistory() {
		
		$this->db->select('wallet_request.*');
		$this->db->select('users.first_name , users.last_name');
		$this->db->from('wallet_request');
		$this->db->join('users', 'users.id = wallet_request.user_id', 'left');
		$this->db->order_by('wallet_request.id','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}


   function sendemail($email="",$title="",$msg=""){
//$title = "test";
//$msg = "test";
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_user']  = 'cemiehwe@gmail.com';  
$config['smtp_pass']  = 'gvtwtkanfjhmahdf';  
$config['_smtp_auth'] = true;
$config['smtp_crypto'] = 'tls';
$config['protocol'] = 'smtp';
$config['mailtype']  = 'html'; 
$config['charset']    = 'iso-8859-1';
$config['wordwrap']   = TRUE;

$this->load->library('email');
$this->email->initialize($config);
$content = '<table cellspacing="0" cellpadding="0" border="0" width="650" align="center" style="border:1px solid #e2e2e2;color:#13324b;font-family:Arial,Helvetica,sans-serif;font-size:12px;font-weight:normal"><tbody><tr><td align="center" valign="top"><table cellspacing="0" cellpadding="0" width="100%" align="center" style="color:#000000;font-size:12px"><tbody><tr><td valign="top" bgcolor="#ffffff" style="text-align:center;padding:10px 0 0 0;border-bottom:1px solid #e2e2e2"><a href="https://247sue.com" target="_blank" ><img src="https://247sue.com/assets/images/logo.jpg" style="margin-bottom:10px;" border="0"></a></td></tr><tr><td style="padding:10px 10px 20px" align="center" valign="top"><table width="100%" cellspacing="0" cellpadding="0" align="center" style="font-size:12px;color:#333"><tbody><tr><td align="left" style="padding:10px 0;font-size:12px"><strong style="font-size:18px;color:#333;font-family:Arial,Helvetica,sans-serif">  Following message received via  247sue</strong></td></tr><tr><td height="5"></td></tr><tr><td width="100%" border="0"><table width="100%" align="center" cellpadding="0" cellspacing="0" style="font-size:13px;color:#666666;border-collapse:collapse;border:1px solid #ccc;border-bottom:0"><tbody>';
       $content .=  '<tr><td style="font-family:Arial,Helvetica,sans-serif;padding:10px;border-bottom:1px solid #ccc;width:66%">'.$msg.'</td></tr>';
               $content .=  '</tbody></table></td></tr></tbody></table></td></tr><tr><td><table cellpadding="0" cellspacing="0" border="0" width="100%" style="line-height:18px;padding:10px;border-top:solid 1px #ccc"><tbody><tr><td align="left" width="50%" style="text-align:left;font-size:12px;font-family:Arial,Helvetica,sans-serif"><strong>Thanks &amp; Regards</strong><br> Free Love Back Solution Team</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>';
//               echo $content;exit;
$this->email->set_newline("\r\n");
$this->email->from('info@247sue.com');  //same email u use for smtp_user 
$this->email->to($email);
//$this->email->to('hiten.digitalrooar@gmail.com');
$this->email->subject($title);
$this->email->message($content); 
$reponse = $this->email->send();
return  $reponse;
//print_r($reponse);exit;    
	}



	
	
}
