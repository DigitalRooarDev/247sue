<?php

class Commission_Model extends CI_Model {

	function __construct() {

}

	function getCommission() {
		
		$this->db->select('request.*');
		$this->db->where('co_status' , 'Accept');
		$this->db->select('c.first_name as client_first_name, c.last_name as client_last_name');
		$this->db->select('l.first_name as laywer_first_name, l.last_name as laywer_last_name,');
		$this->db->from('request');
		$this->db->join('users as c', 'c.id = request.client_id', 'left');
		$this->db->join('users as l', 'l.id = request.laywer_id', 'left');
		$this->db->order_by('request.id','desc');
		$query = $this->db->get();
		//echo '<pre>'; print_r($query->result_array()); die;
		return $query->result_array();
	}






	
	
}
