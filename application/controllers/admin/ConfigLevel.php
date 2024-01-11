<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ConfigLevel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_login_admin();
        $this->load->model('Common_model', 'common');
        session_start();
    }

    public function index()
    {
        $data['title'] = 'Config Level';
        $data['breadcrumb_title'] = 'Config Level';
        $data['breadcrumb_menu'] = 'Add Config Level';
        $data['section_title'] = 'Config Level List';
        $data['rows'] = $this->common->getAllConfigLevel('config_levels', 'DESC');

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/configlevel/index');
        $this->load->view('admin/include/footer');
    }

    public function add()
    {
        $data['title'] = 'Config Level';
        $data['breadcrumb_title'] = 'Config Level';
        $data['breadcrumb_menu'] = 'Add Config Level';
        $data['section_title'] = 'Add Config Level';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/configlevel/add');
        $this->load->view('admin/include/footer');
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('level', 'Level', 'required|is_unique[config_levels.level]');
            $this->form_validation->set_rules('reward_per', 'Reward Per', 'required');
            $this->form_validation->set_rules('referral_member', 'Referral Member', 'required');

            if ($this->form_validation->run()) {
                $insertRow = array(
                    'level' => $_POST['level'],
                    'reward_per' => $_POST['reward_per'],
                    'referral_member' => $_POST['referral_member'],
                );
                $insertRow = $this->common->insert('config_levels', $insertRow);

                if ($insertRow) {
                    $this->session->set_flashdata('success_message', 'Successfully added!');
                    redirect(base_url('admin/configlevel'));
                } else {
                    $this->session->set_flashdata('error_message', 'Please try again, something went wrong!');
                    redirect(base_url('admin/configlevel/add'));
                }
            } else {
                $_SESSION['form_data'] = $_POST;
                if (form_error('level')) {
                    $this->session->set_flashdata('error_message', form_error('level'));
                } else {
                    $this->session->set_flashdata('error_message', 'Fields Required');
                }
                redirect(base_url('admin/configlevel/add'));
            }
        } else {
            redirect(base_url('admin/configlevel/add'));
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Config Level ';
        $data['breadcrumb_title'] = 'Config Level';
        $data['breadcrumb_menu'] = 'Edit Config Level';
        $data['section_title'] = 'Edit Config Level';
        $data['row'] = $this->common->getSingleRecordById($id, 'config_levels');

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/configlevel/edit');
        $this->load->view('admin/include/footer');
    }

    public function update($id)
    {
        /* ini_set('display_errors', '1');
         ini_set('display_startup_errors', '1');
         error_reporting(E_ALL);*/

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->form_validation->set_rules('level', 'Level', 'required|is_unique[config_levels.level.' . $id . ']');
            $this->form_validation->set_rules('reward_per', 'Reward Per', 'required');
            $this->form_validation->set_rules('referral_member', 'Referral Member', 'required');
            if ($this->form_validation->run()) {
                $updateRow = array(
                    'level' => $_POST['level'],
                    'reward_per' => $_POST['reward_per'],
                    'referral_member' => $_POST['referral_member']
                );

                $update = $this->common->update($updateRow, $id, 'config_levels');
                if ($update) {
                    $this->session->set_flashdata('success_message', 'Update successfully!');
                    redirect(base_url('admin/configlevel/edit/' . $id));
                } else {
                    $this->session->set_flashdata('error_message', 'Please try again, something went wrong!');
                    redirect(base_url('admin/configlevel/edit/' . $id));
                }
            } else {
                $_SESSION['form_data'] = $_POST;
                if (form_error('level')) {
                    $this->session->set_flashdata('error_message', form_error('level'));
                } else {
                    $this->session->set_flashdata('error_message', 'Fields Required');
                }
                redirect(base_url('admin/configlevel/edit/' . $id));
            }
        } else {
            redirect(base_url('admin/configlevel/edit/' . $id));
        }
    }

    public function delete($id)
    {
        $this->db->delete('config_levels', array('id' => $id));
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
        $updateRow = array('status' => $st);
        $update = $this->common->update($updateRow, $id, 'config_levels');
        if ($update) {
            $this->session->set_flashdata('success_message', 'Status update successfully!');
            redirect(base_url('admin/configlevel'));
        } else {
            $this->session->set_flashdata('error_message', 'Please try again, something went wrong!');
            redirect(base_url('admin/configlevel/edit/' . $id));
        }
    }
}
