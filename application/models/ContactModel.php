<?php
/**
* Common_Model Model for Admin and site
*/
class Contactmodel extends CI_Model {

	public function get_Entire_Data()
{
        $this->db->select('*');
        $this->db->from('contact');
        $query = $this->db->get();
		$result = $query->result_array();
        //echo "<pre>"; print_r($result); die;
        return $result;
} 

function insert($AddRow)
    {
        $this->db->insert('contact', $AddRow);
        return true;
    }

}