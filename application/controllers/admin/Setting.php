<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

    function __construct()
    {
        Parent::__construct();
        check_login_admin();
        $this->load->model('Common_model', 'common');
    }

    public function index()
    {
        $data['title'] = 'Globel Settings';
        $data['breadcrumb_title'] = 'Globel Settings';
        $data['breadcrumb_menu'] = 'Globel Settings';
        $data['section_title'] = 'Globel Settings';
        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/setting/index');
        $this->load->view('admin/include/footer');
    }

    public function update()
    {
        if (isset($_POST) && !empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $UpdateRow = array(
                    'field_value' => $value,
                );
                $this->db->where('field_key', $key);
                $this->db->update('settings', $UpdateRow);
            }
            $this->session->set_flashdata('success_message', 'Settings update successfully!');
        }
        redirect(base_url('admin/setting'));
    }

    public function updateLevelAmt()
    {
        if (isset($_POST) && !empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $UpdateRow = array(
                    'field_value' => $value,
                );
                $this->db->where('field_key', $key);
                $this->db->update('settings', $UpdateRow);
            }
            $this->session->set_flashdata('success_message', 'Settings update successfully!');
        }
        redirect(base_url('admin/setting'));
    }

    public function delete($id)
    {
        $this->db->delete('users', array('id' => $id));
        echo 'Deleted successfully.';
    }

    public function status()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        if ($status == '1') {
            $st = '0';
        } else {
            $st = '1';
        }
        $UpdateRow = array('status' => $st,);
        $update = $this->common->update($UpdateRow, $id, 'users');
        if ($update) {
            $this->session->set_flashdata('success_message', 'Item status update successfully!');
            redirect(base_url('admin/user'));
        } else {
            $this->session->set_flashdata('error_message', 'Please try again Somthing gone wrong!');
            redirect(base_url('admin/user/edit/' . $id));
        }

    }
}
