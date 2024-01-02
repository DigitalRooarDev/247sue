<?php

class HowitworkModel extends CI_Model {

	function __construct() {
        

}

public function get_howitwork()
{
    $this->db->select('how_it_work.*');
    $this->db->from('how_it_work');
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
        $this->db->from('how_it_work');
        
        $query = $this->db->get();
		$result = $query->row_array();
        //echo "<pre>"; print_r($result); die;
        return $result;
} 

function update($UpdateRow, $id){
    $this->db->where('id',$id);
    $this->db->update('how_it_work',$UpdateRow);
    return true;
} 


function insert($AddRow)
    {
        $this->db->insert('how_it_work', $AddRow);
        return true;
        //return $this->db->insert_id();
    }


    public function get_Howitwork_data()
{
    $this->db->select('*');
    $this->db->where('status',1);
    $this->db->from('how_it_work');
    $this->db->order_by('order', 'asc');
    $query = $this->db->get();
	$result = $query->result_array();
   // echo "<pre>"; print_r($result); die;
    return $result;

}

}
