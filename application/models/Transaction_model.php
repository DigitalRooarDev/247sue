<?php

class Transaction_model extends CI_Model {

	function __construct() {

}

	function getAlltransaction($userID = '') {
		
		$this->db->select('transactions.*');
		$this->db->select('c.first_name, c.last_name');

		if(!empty($userID))
		{
			$this->db->where('user_id', $userID);
		}
		
	
		$this->db->from('transactions');
		$this->db->join('users as c', 'c.id = transactions.user_id', 'left');
	
		$this->db->order_by('transactions.id','desc');
		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		return $query->result_array();
	}






	
	
}
