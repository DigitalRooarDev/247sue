<?php
/**
* Common_Model Model for Admin and site
*/
class Dashboard_model extends CI_Model {

	function __construct() {

}

	

	function dashboard() {

		$result = array();
		
		$this->db->select('id');
		$this->db->where('role' , 'Customer');
		
		$this->db->from('users');
		
		$query = $this->db->get();
		$result['users'] = $query->num_rows();



		
		//print_r($result); die;


		return $result;
	}


	
}
