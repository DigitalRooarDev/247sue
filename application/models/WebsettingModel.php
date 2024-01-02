<?php

class WebsettingModel extends CI_Model {

	function __construct() {
        

}


// public function getAllstore_links()
// {
//     $this->db->select('*');
//         //$this->db->order_by('id', 'DESC');
//         //$this->db->where('id', $id);
//         $this->db->from('website_settings');
//         $query = $this->db->get();
// 		$result = $query->result_array();
//         /echo "<pre>"; print_r($result); die;
//         return $result;
// } 

public function update_weblinks($data)
{
    $this->db->update('website_settings',$data);
    
    return true;
}



}

?>