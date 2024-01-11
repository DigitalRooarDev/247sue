<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bonus extends CI_Controller
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
        $data['title'] = 'Bonus Reward';
        $data['breadcrumb_title'] = 'Bonus Reward';
        $data['breadcrumb_menu'] = 'Add Bonus Reward';
        $data['section_title'] = 'Bonus Reward List';
        $data['rows'] = $this->common->getAllBonus('bonus_rewards', 'desc');

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/bonus/index');
        $this->load->view('admin/include/footer');
    }

    public function add()
    {
        $data['title'] = 'Bonus Reward User';
        $data['breadcrumb_title'] = 'Bonus Reward User';
        $data['breadcrumb_menu'] = 'Add Bonus Reward User';
        $data['section_title'] = 'Add Bonus Reward User';

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/bonus/add');
        $this->load->view('admin/include/footer');
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('total_join_member', 'Total Join Member', 'required');
            $this->form_validation->set_rules('reward', 'Reward', 'required');
            if ($this->form_validation->run()) {
                $insertRow = array(
                    'total_join_member' => $_POST['total_join_member'],
                    'reward' => $_POST['reward'],
                );
                $insertRow = $this->common->insert('bonus_rewards', $insertRow);
                if ($insertRow) {
                    $this->session->set_flashdata('success_message', 'Successfully added!');
                    redirect(base_url('admin/bonus'));
                } else {
                    $this->session->set_flashdata('error_message', 'Please try again, something went wrong!');
                    redirect(base_url('admin/bonus/add'));
                }
            } else {
                $_SESSION['form_data'] = $_POST;
                $this->session->set_flashdata('error_message', 'Fields Required');
                redirect(base_url('admin/bonus/add'));
            }
        } else {
            redirect(base_url('admin/bonus/add'));
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Join Member ';
        $data['breadcrumb_title'] = 'Join Member';
        $data['breadcrumb_menu'] = 'Edit Join Member';
        $data['section_title'] = 'Edit Join Member';
        $data['row'] = $this->common->getSingleRecordById($id, 'bonus_rewards');

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/bonus/edit');
        $this->load->view('admin/include/footer');
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $singleRow = $this->common->getSingleRecordById($id, 'bonus_rewards');

            $this->form_validation->set_rules('total_join_member', 'Total Join Member', 'required');
            $this->form_validation->set_rules('reward', 'Reward', 'required');

            if ($this->form_validation->run()) {
                // Validation passed, proceed with updating
                $updateRow = array(
                    'total_join_member' => $_POST['total_join_member'],
                    'reward' => $_POST['reward'],
                );

                $update = $this->common->update($updateRow, $id, 'bonus_rewards');
                if ($update) {
                    $this->session->set_flashdata('success_message', 'Update successfully!');
                    redirect(base_url('admin/bonus/edit/' . $id));
                } else {
                    $this->session->set_flashdata('error_message', 'Please try again, something went wrong!');
                    redirect(base_url('admin/bonus/edit/' . $id));
                }
            } else {
                $_SESSION['form_data'] = $_POST;
                $this->session->set_flashdata('error_message', 'Fields Required');
                redirect(base_url('admin/bonus/edit/' . $id));
            }
        } else {
            unset($_SESSION['form_data']);
            redirect(base_url('admin/bonus/edit/' . $id));
        }
    }

    public function delete($id)
    {
        $this->db->delete('bonus_rewards', array('id' => $id));
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
        $update = $this->common->update($updateRow, $id, 'bonus_rewards');
        if ($update) {
            $this->session->set_flashdata('success_message', 'Status update successfully!');
            redirect(base_url('admin/bonus'));
        } else {
            $this->session->set_flashdata('error_message', 'Please try again, something went wrong!');
            redirect(base_url('admin/bonus/edit/' . $id));
        }
    }
}
