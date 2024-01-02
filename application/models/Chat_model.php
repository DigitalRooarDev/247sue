<?php

class Chat_Model extends CI_Model {

	function __construct() {

}

	function getallchatmemberByCaseID($caseId ='1') {
		
		$this->db->select('chat_message.*');
		$this->db->where('chat_message.case_id' ,$caseId);
		$this->db->select('c.first_name as client_first_name, c.last_name as client_last_name');
		$this->db->select('l.first_name as laywer_first_name, l.last_name as laywer_last_name');
		$this->db->from('chat_message');
		$this->db->join('users as c', 'c.id = chat_message.client_id', 'left');
		$this->db->join('users as l', 'l.id = chat_message.lawyer_id', 'left');
		$this->db->group_by('chat_message.lawyer_id'); 
		$this->db->order_by('chat_message.id','desc');
		$query = $this->db->get();
//                echo $this->db->last_query();  
//		echo '<pre>'; print_r($query->result_array());
//                die;
		return $query->result_array();
	}



		function getallchatsByCaseID($case_id = '1' , $lawyerid = '' , $client_id = '') {
		
		$this->db->select('chat_message.*');
		$this->db->where('chat_message.case_id' ,$case_id);
		$this->db->where('chat_message.lawyer_id' ,$lawyerid);
		$this->db->where('chat_message.client_id' ,$client_id);
		$this->db->select('c.first_name as client_first_name, c.last_name as client_last_name');
		$this->db->select('l.first_name as laywer_first_name, l.last_name as laywer_last_name');
		$this->db->from('chat_message');
		$this->db->join('users as c', 'c.id = chat_message.client_id', 'left');
		$this->db->join('users as l', 'l.id = chat_message.lawyer_id', 'left');
		$this->db->order_by('chat_message.id','ASC');
		$query = $this->db->get();
		
		return $query->result_array();
	}





	
	
}
