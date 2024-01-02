<?php

class TeamModel extends CI_Model {

	function __construct() {
        

}

public function get_team()
{
    $this->db->select('team.*');
    $this->db->from('team');
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
        $this->db->from('team');
        
        $query = $this->db->get();
		$result = $query->row_array();
        //echo "<pre>"; print_r($result); die;
        return $result;
} 

function update($UpdateRow, $id){
    $this->db->where('id',$id);
    $this->db->update('team',$UpdateRow);
    return true;
} 


function insert($AddRow)
    {
        $this->db->insert('team', $AddRow);
        return true;
        //return $this->db->insert_id();
    }


    public function get_team_data()
{
    $this->db->select('*');
    $this->db->where('status',1);
    $this->db->from('team');
    $this->db->order_by('user_order', 'asc');
    $query = $this->db->get();
	$result = $query->result_array();
    //echo "<pre>"; print_r($result); die;
    return $result;

}

}
