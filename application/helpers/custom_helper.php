<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 	if (!function_exists('check_login_admin')) {
	    function check_login_admin() {
	        $ci = get_instance();
	         if (isset($_SESSION['Admin']['is_login']) && $_SESSION['Admin']['is_login'] == true) {

	           return true;
	        }else
	        {
	        	 $ci->session->sess_destroy();
	            redirect(base_url('admin/login'));
	        }
	    }
	}
if (!function_exists('check_login_member')) {
	    function check_login_member() {
	        $ci = get_instance();
	         if (isset($_SESSION['Lawyer']['is_login']) && $_SESSION['Lawyer']['is_login'] == true) {

	           return true;
	        }else
	        {
	        	 $ci->session->sess_destroy();
	            redirect(base_url('member/login'));
	        }
	    }
	}
	if (!function_exists('get_settings')) {
	    function get_settings($field_key ='') {
	        $ci = get_instance();
	        $ci->db->select('*');
        // $ci->db->order_by('id', 'DESC');
        $ci->db->where('field_key', $field_key);
        $ci->db->from('website_settings');
        $query = $ci->db->get();
		$result = $query->row_array();

		if($result){
			return $output = $result['field_value'];
		}
        return false;
	    }
	}