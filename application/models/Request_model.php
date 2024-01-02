<?php

class Request_Model extends CI_Model {

	function __construct() {

}

	function getrequest($request_status = '', $plan_id = '', $client_id = '', $laywer_id = '') {
		
		$this->db->select('request.*');
		$this->db->select('
			c.first_name as client_first_name, 
			c.last_name as client_last_name,
			c.email as client_email,
			c.mobile as client_mobile,
			c.l_location as client_l_location,

			');
		$this->db->select('
			l.first_name as laywer_first_name,
			l.last_name as laywer_last_name,
			l.email as laywer_email,
			l.mobile as laywer_mobile,
			l.l_location as laywer_l_location,
			'
		);

		if(!empty($request_status))
		{
			$this->db->where('request.request_status' ,$request_status);
		}
		
		$this->db->from('request');
		if($plan_id) {
			$this->db->where('c.plan_id', $plan_id);
		}
		if($client_id) {
			$this->db->where('request.client_id', $client_id);
		}
		if($laywer_id) {
			$this->db->where('request.laywer_id', $laywer_id);
		}
		$this->db->join('users as c', 'c.id = request.client_id', 'left');
		$this->db->join('users as l', 'l.id = request.laywer_id', 'left');
		$this->db->order_by('request.id','desc');
		$query = $this->db->get();
		return $query->result_array();
	}


	function getrequestByUserID($userID = array() , $request_status = '') {
		
		$this->db->select('request.*');
		$this->db->select('
			c.first_name as client_first_name, 
			c.last_name as client_last_name,
			c.email as client_email,
			c.mobile as client_mobile,
			c.l_location as client_l_location,

			');
		$this->db->select('
			l.first_name as laywer_first_name,
			l.last_name as laywer_last_name,
			l.email as laywer_email,
			l.mobile as laywer_mobile,
			l.l_location as laywer_l_location,
			'
		);

		if(!empty($userID))
		{
			$this->db->where($userID);
		}

		if(!empty($request_status))
		{
			$this->db->where('request_status' ,$request_status);
		}
		


		$this->db->from('request');
		$this->db->join('users as c', 'c.id = request.client_id', 'left');
		$this->db->join('users as l', 'l.id = request.laywer_id', 'left');
		$this->db->order_by('request.id','desc');
		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		return $query->result_array();
	}



	function distancebylaywer($case_id) {

		//To search by kilometers instead of miles, replace 3959 with 6371.
		 		$caseDetails = $this->casedetails($case_id);  

			  $lat  = $caseDetails['c_latitude'];
			  $long  = $caseDetails['c_longitude'];

			  $query = "SELECT id  ,first_name , last_name , address , email , mobile ,   ROUND(6371 * acos(cos(radians('$lat')) * cos(radians(l_latitude)) * cos(radians(l_longitude) - radians('$long')) + sin(radians('$lat')) * sin(radians(l_latitude)))) as distance,l_longitude,l_latitude from  users where  role='lawyer'  HAVING distance > 0 order by distance";
			  $querys = $this->db->query($query);
			  return  $settingdistanceresult =   $querys->result_array(); 
        }



	function AllLawyerBynearlocationBycaseID($case_id) {

			 $caseDetails = $this->casedetails($case_id);  
			 $case_lat = $caseDetails['c_latitude'];
			 $case_lang = $caseDetails['c_longitude'];
			 $list = array();
              if($this->settingdistance() && !empty($case_lat) && !empty($case_lang))
              {
              	$list = $this->distancebylaywer($case_id);
              }else
              	{
              		$list = $this->lawyerlist();
              	}
              	return  $list;
     }


function settingdistance() {

			  $this->db->select('*');
              $this->db->where('field_key','distance');
              $this->db->from('settings');
              $query = $this->db->get();
              $settingdistanceresult =   $query->row_array(); 
              $settingdistance =   $settingdistanceresult['field_value']; 

              if(!empty($settingdistance) && is_numeric($settingdistance))
              {
              	return $settingdistance;
              }else
              {
              		return false;
              }


}

function lawyerlist() {
					$this->db->select('*');
		              $this->db->where('role','Lawyer');
		              $this->db->where('status','1');
		              $this->db->where('status','1');
		              $this->db->from('users');
		              $this->db->order_by('first_name','ASC');
		              $query = $this->db->get();
		             return  $list =   $query->result_array(); 
	}


	function casedetails($caseid) {
					$this->db->select('*');
					$this->db->where('id',$caseid);
					$this->db->from('request');
					$query = $this->db->get();
		             return  $casedetails =   $query->row_array(); 
	}


function distance($lat1='27.25441338323543', $lon1='75.45194258197172', $lat2='27.251577', $lon2='75.414791', $unit='K') {
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
     return ($miles * 1.609344);
    } else if ($unit == "N") {
      return  ($miles * 0.8684);
    } else {
      return  $miles;
    }
  }
}






function checkalrreadyAssignLawyerIncase($lawyer_id , $case_id) {

			  $this->db->select('*');
              $this->db->where('lawyer_id',$lawyer_id);
              $this->db->where('case_id',$case_id);
              $this->db->from('case_lawyer');
              $query = $this->db->get();
              $checkalrreadyAssignLawyerIncase =   $query->row_array(); 

              return  $checkalrreadyAssignLawyerIncase;


              


}


function getAllEvedenceByCase($case_id='') {
		$this->db->select('case_evidences.*');
		$this->db->select('e.title, e.url');
		$this->db->where('case_evidences.case_id' , $case_id);
		$this->db->from('case_evidences');
		$this->db->join('evidences as e', 'e.id = case_evidences.evidance_id', 'left');
		$this->db->order_by('case_evidences.id','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}




	
	
}
