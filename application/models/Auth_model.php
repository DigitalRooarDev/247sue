<?php
/**
 * Common_Model Model for Admin and site
 */
class Auth_model extends CI_Model
{

    function __construct()
    {

    }

    function checklogin()
    {
        $this->db->select('*');
        $this->db->where('email', $_POST['email']);
        $this->db->where('password', md5($_POST['password']));
        $this->db->from('users');
        $query = $this->db->get();
        if ($query->row_array()) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function checkMemberlogin()
    {
        $this->db->select('*');
        $this->db->where('email', $_POST['email']);
        $this->db->where('password', md5($_POST['password']));
        $this->db->where('role', 'Lawyer');
        $this->db->from('users');
        $query = $this->db->get();
        //print_r(md5($_POST['password'])); die;
        if ($query->row_array()) {
            return $query->row_array();
        } else {
            return false;
        }
    }
}
