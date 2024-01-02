<?php

class FaqModel extends CI_Model {

	function __construct() {
        

}

public function get_faq()
{
    $this->db->select('faq.*');
    $this->db->from('faq');
    $query = $this->db->get();
	$result = $query->result_array();
    //echo "<pre>"; print_r($result); die;
    return $result;

    
}

public function getSingleRecordById($id)
{
        $this->db->select('*');
        //$this->db->order_by('id', 'DESC');
        $this->db->where('id', $id);
        $this->db->from('faq');
        $query = $this->db->get();
		$result = $query->row_array();
        //echo "<pre>"; print_r($result); die;
        return $result;
} 

function update($UpdateRow, $id){
    $this->db->where('id',$id);
    $this->db->update('faq',$UpdateRow);
    return true;
} 


function insert($AddRow)
    {
        $this->db->insert('faq', $AddRow);
        return true;
        //return $this->db->insert_id();
    }

    public function getAllfaq()
    {
        $this->db->select('*');
        $this->db->where('status',1);
        $this->db->order_by('faq_order', 'ASC');
        $this->db->from('faq');
        $query = $this->db->get();
		$result = $query->result_array();
        //echo "<pre>"; print_r($result); die;
        return $result;
    }
}
