<?php
defined("BASEPATH") or exit("No direct script access allowed");

class ConfigLevel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_login_admin();
        $this->load->model("Common_model", "common");
        // session_start();

    }

    public function index()
    {
        $data["title"] = "Config Level";
        $data["breadcrumb_title"] = "Config Level";
        $data["breadcrumb_menu"] = "Add Config Level";
        $data["section_title"] = "Config Level List";
        $data["rows"] = $this->common->getAllConfigLevel("config_levels","DESC");

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/configlevel/index");
        $this->load->view("admin/include/footer");
    }

    public function add()
    {
        $data["title"] = "Config Level";
        $data["breadcrumb_title"] = "Config Level";
        $data["breadcrumb_menu"] = "Add Config Level";
        $data["section_title"] = "Add Config Level";

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/configlevel/add");
        $this->load->view("admin/include/footer");
    }

    // public function save()
    // {
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         $this->form_validation->set_rules(
    //             "level","Level","trim|required|is_unique[config_levels.level]"
    //         );
    //         $this->form_validation->set_rules(
    //             "reward_per","Reward Per","trim|required"
    //         );
    //         $this->form_validation->set_rules(
    //             "referral_member","Referral Member","trim|required"
    //         );

    //         if ($this->form_validation->run()) {
    //             $insertRow = [
    //                 "level" => $_POST["level"],
    //                 "reward_per" => $_POST["reward_per"],
    //                 "referral_member" => $_POST["referral_member"],
    //             ];
    //             $insertRow = $this->common->insert("config_levels", $insertRow);

    //             if ($insertRow) {
    //                 $this->session->set_flashdata(
    //                     "success_message",
    //                     "Successfully added!"
    //                 );
    //                 redirect(base_url("admin/configlevel"));
    //             } else {
    //                 $this->session->set_flashdata(
    //                     "error_message",
    //                     "Please try again, something went wrong!"
    //                 );
    //                 redirect(base_url("admin/configlevel/add"));
    //             }
    //         } else {
    //             $_SESSION["form_data"] = $_POST;
    //             if (form_error("level")) {
    //                 $this->session->set_flashdata("error_message",form_error("level")
    //                 );
    //             } else {
    //                 $this->session->set_flashdata(
    //                     "error_message","Fields Required"
    //                 );
    //             }
    //             redirect(base_url("admin/configlevel/add"));
    //         }
    //     } else {
    //         redirect(base_url("admin/configlevel/add"));
    //     }
    // }

public function save()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $this->form_validation->set_rules(
            "level","Level","trim|required|is_unique[config_levels.level]",
            array(
                "required" => 'The %s Field is Required.',
                "is_unique" => 'The %s Field Must be Unique. The Entered Level Already Exists.'
            )
        );
        $this->form_validation->set_rules(
            "reward_per", "Reward Per","trim|required"
        );
        $this->form_validation->set_rules(
            "referral_member","Referral Member","trim|required"
        );

        if ($this->form_validation->run()) {
            $insertRow = [
                "level" => $_POST["level"],
                "reward_per" => $_POST["reward_per"],
                "referral_member" => $_POST["referral_member"],
            ];

            $insertRow = $this->common->insert("config_levels", $insertRow);

            if ($insertRow) {
                $this->session->set_flashdata(
                    "success_message", "Successfully Added!"
                );
                redirect(base_url("admin/configlevel"));
            } else {
                $this->session->set_flashdata(
                    "error_message", "Please Try Again, Something Went Wrong!"
                );
                redirect(base_url("admin/configlevel/add"));
            }
        } else {
            // Validation failed
            $this->session->set_flashdata("error_message", validation_errors());
            $_SESSION["form_data"] = $_POST;
            redirect(base_url("admin/configlevel/add"));
        }
    } else {
        redirect(base_url("admin/configlevel/add"));
    }
}


// public function save()
// {
//     if(isset($_POST) && !empty($_POST)) {
//         $this->form_validation->set_rules(
//             "level",
//             "Level",
//             "trim|required|is_unique[config_levels.level]",
//             // array(
//             //     "required" => 'The %s Field is Required.',
//             //     "is_unique" => 'The %s Field Must be Unique. The Entered Level Already Exists.'
//             // )
//         );
//         $this->form_validation->set_rules(
//             "reward_per",
//             "Reward Per",
//             "trim|required"
//         );
//         $this->form_validation->set_rules(
//             "referral_member",
//             "Referral Member",
//             "trim|required"
//         );

//         if ($this->form_validation->run()) {
//             $insertRow = [
//                 "level" => $_POST["level"],
//                 "reward_per" => $_POST["reward_per"],
//                 "referral_member" => $_POST["referral_member"],
//             ];

//             $insertRow = $this->common->insert("config_levels", $insertRow);

//             if ($insertRow) {
//                 $this->session->set_flashdata(
//                     "success_message",
//                     "Successfully Added!"
//                 );
//                 redirect(base_url("admin/configlevel"));
//             } else {
//                 $this->session->set_flashdata(
//                     "error_message",
//                     "Please Try Again, Something Went Wrong!"
//                 );
//                 redirect(base_url("admin/configlevel/add"));
//             }
//         } else {
//             // Validation failed
//             // $this->session->set_flashdata("error_message", validation_errors());
//             // $_SESSION["form_data"] = $_POST;
//             // redirect(base_url("admin/configlevel/add"));
//             $this->add();
//         }
//     } else {
//         redirect(base_url("admin/configlevel/add"));
//     }
// }

    public function edit($id)
    {
        $data["title"] = "Config Level ";
        $data["breadcrumb_title"] = "Config Level";
        $data["breadcrumb_menu"] = "Edit Config Level";
        $data["section_title"] = "Edit Config Level";
        $data["row"] = $this->common->getSingleRecordById($id, "config_levels");

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/configlevel/edit");
        $this->load->view("admin/include/footer");
    }

    // public function update($id)
    // {
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //         $this->form_validation->set_rules(
    //             "reward_per","Reward Per","trim|required"
    //         );
    //         $this->form_validation->set_rules(
    //             "referral_member","Referral Member","trim|required"
    //         );

    //         $singleRow = $this->common->getSingleRecordById(
    //             $id,"config_levels"
    //         );

    //         if (
    //             isset($_POST["level"]) &&
    //             !empty($_POST["level"]) &&
    //             $_POST["level"] != $singleRow["level"]
    //         ) {
    //             $this->form_validation->set_rules(
    //                 "level","Level","trim|required|is_unique[config_levels.level]"
    //             );
    //         } else {
    //             $this->form_validation->set_rules(
    //                 "level","Level","trim|required"
    //             );
    //         }

    //         // Check if form validation passed
    //         if ($this->form_validation->run()) {
    //             // Get the existing record for the given $id
    //             $existingRecord = $this->common->getSingleRecordById(
    //                 $id,"config_levels"
    //             );

    //             // Prepare data for update
    //             $updateRow = [
    //                 "reward_per" => $this->input->post("reward_per"),
    //                 "referral_member" => $this->input->post("referral_member"),
    //             ];

    //             // Update 'level' if it's different
    //             if ($existingRecord["level"] !== $this->input->post("level")) {
    //                 $updateRow["level"] = $this->input->post("level");
    //             }

    //             // Update the record
    //             $update = $this->common->update(
    //                 $updateRow, $id, "config_levels"
    //             );

    //             if ($update) {
    //                 // Record updated successfully
    //                 $this->session->set_flashdata(
    //                     "success_message","Update successfully!"
    //                 );
    //                 redirect(base_url("admin/configlevel"));
    //             } else {
    //                 // Something went wrong with the update
    //                 $this->session->set_flashdata(
    //                     "error_message","Please try again, something went wrong!"
    //                 );
    //                 redirect(base_url("admin/configlevel/edit/" . $id));
    //             }
    //         } else {
    //             // Form validation failed
    //             redirect(base_url("admin/configlevel"));
    //         }
    //     } else {
    //         // Redirect if not a POST request
    //         redirect(base_url("admin/configlevel"));
    //     }
    // }

public function update($id)
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $this->form_validation->set_rules(
            "reward_per",
            "Reward Per",
            "trim|required"
        );
        $this->form_validation->set_rules(
            "referral_member",
            "Referral Member",
            "trim|required"
        );

        $singleRow = $this->common->getSingleRecordById($id, "config_levels");

        if (isset($_POST["level"]) && !empty($_POST["level"]) && $_POST["level"] != $singleRow["level"]) {
            $this->form_validation->set_rules(
                "level",
                "Level",
                "trim|required|is_unique[config_levels.level]",
                array(
                    "trim|required" => 'The %s Field is Required.',
                    "is_unique" => 'The %s Field Must be Unique. The Entered Level Already Exists.'
                )
            );
        } else {
            $this->form_validation->set_rules(
                "level",
                "Level",
                "trim|required"
            );
        }

        // Check if form validation passed
        if ($this->form_validation->run()) {
            // Get the existing record for the given $id
            $existingRecord = $this->common->getSingleRecordById($id, "config_levels");

            // Prepare data for update
            $updateRow = [
                "reward_per" => $this->input->post("reward_per"),
                "referral_member" => $this->input->post("referral_member"),
            ];

            // Update 'level' if it's different
            if ($existingRecord["level"] !== $this->input->post("level")) {
                $updateRow["level"] = $this->input->post("level");
            }

            // Update the record
            $update = $this->common->update($updateRow, $id, "config_levels");

            if ($update) {
                // Record updated successfully
                $this->session->set_flashdata(
                    "success_message",
                    "Update Successfully!"
                );
                redirect(base_url("admin/configlevel"));
            } else {
                // Something went wrong with the update
                $this->session->set_flashdata(
                    "error_message",
                    "Please Try Again, Something Went Wrong!"
                );
                redirect(base_url("admin/configlevel/edit/" . $id));
            }
        } else {
            // Form validation failed
            $this->session->set_flashdata(
                "error_message",
                validation_errors()
            );
            redirect(base_url("admin/configlevel/edit/" . $id));
        }
    } else {
        // Redirect if not a POST request
        redirect(base_url("admin/configlevel"));
    }
}



    /* public function delete($id)
    {
        $this->db->delete("config_levels", ["id" => $id]);
        echo "Deleted Successfully.";
    } */

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
        $update = $this->common->update($updateRow, $id, "config_levels");
        if ($update) {
            $this->session->set_flashdata(
                "success_message",
                "Status Update Successfully!"
            );
            redirect(base_url("admin/configlevel"));
        } else {
            $this->session->set_flashdata(
                "error_message",
                "Please Try Again, Something Went Wrong!"
            );
            redirect(base_url("admin/configlevel/edit/" . $id));
        }
    }
}