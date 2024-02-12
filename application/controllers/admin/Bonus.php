<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Bonus extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_login_admin();
        $this->load->model("Common_model", "common");
        session_start();
    }

    public function index()
    {
        $data["title"] = "Bonus Reward";
        $data["breadcrumb_title"] = "Bonus Reward";
        $data["breadcrumb_menu"] = "Add Bonus Reward";
        $data["section_title"] = "Bonus Reward List";
        $data["rows"] = $this->common->getAllBonus("bonus_rewards", "desc");

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/bonus/index");
        $this->load->view("admin/include/footer");
    }

    public function add()
    {
        $data["title"] = "Bonus Reward User";
        $data["breadcrumb_title"] = "Bonus Reward User";
        $data["breadcrumb_menu"] = "Add Bonus Reward User";
        $data["section_title"] = "Add Bonus Reward User";

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/bonus/add");
        $this->load->view("admin/include/footer");
    }

    public function save()
    {

        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->form_validation->set_rules(
                "total_join_member", "Join Member", "trim|required|is_unique[bonus_rewards.total_join_member]",
                array(
                    "required" => 'The %s Field is Required.',
                    "is_unique" => 'Entered Join Member Already Exists.'
                )
            );

            $this->form_validation->set_rules(
                "reward", "Reward Per", "trim|required"
            );

            if ($this->form_validation->run()) {
                $insertRow = [
                    "total_join_member" => $this->input->post("total_join_member"),
                    "reward" => $this->input->post("reward")
                ];
                $insertRow = $this->common->insert("bonus_rewards", $insertRow);
                if ($insertRow) {
                    redirect(base_url("admin/bonus"));
                } else {
                    redirect(base_url("admin/bonus/add"));
                }
            } else {
                $this->session->set_flashdata("error_message", validation_errors());
                $_SESSION["form_data"] = $_POST;
                redirect(base_url("admin/bonus/add"));
            }
        } else {
            redirect(base_url("admin/bonus/add"));
        }
    }

    public function edit($id)
    {
        $data["title"] = "Join Member ";
        $data["breadcrumb_title"] = "Join Member";
        $data["breadcrumb_menu"] = "Edit Join Member";
        $data["section_title"] = "Edit Join Member";
        $data["row"] = $this->common->getSingleRecordById($id, "bonus_rewards");

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/bonus/edit");
        $this->load->view("admin/include/footer");
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Prepare data for update
            $updateRow = [
                "total_join_member" => $this->input->post("total_join_member"),
                "reward" => $this->input->post("reward"),
            ];
            // Update the record
            $update = $this->common->update($updateRow, $id, "bonus_rewards");

            if ($update) {
                // Record updated successfully
                redirect(base_url("admin/bonus"));
            } else {
                // Something went wrong with the update
                redirect(base_url("admin/bonus/edit/" . $id));
            }

        } else {
            // Redirect if not a POST request
            redirect(base_url("admin/bonus"));
        }
    }

    public function delete($id)
    {
        $this->db->delete("bonus_rewards", ["id" => $id]);
        echo "Deleted Successfully.";
    }

    public function status()
    {
        $id = $this->uri->segment(4);
        $status = $this->uri->segment(5);
        if ($status == "1") {
            $st = "0";
        } else {
            $st = "1";
        }
        $updateRow = ["status" => $st];
        $update = $this->common->update($updateRow, $id, "bonus_rewards");
        if ($update) {
            $this->session->set_flashdata(
                "success_message",
                "Status Update Successfully!"
            );
            redirect(base_url("admin/bonus"));
        } else {
            $this->session->set_flashdata(
                "error_message",
                "Please Try Again, Something Went Wrong!"
            );
            redirect(base_url("admin/bonus/edit/" . $id));
        }
    }
}
