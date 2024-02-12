<?php
defined("BASEPATH") or exit("No direct script access allowed");

class Marketer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_login_admin();
        $this->load->model("Common_model", "common");
    }

    public function index($id = null)
    {
        $data["title"] = "Marketer User";
        $data["breadcrumb_title"] = "Marketer User";
        $data["breadcrumb_menu"] = "Marketer User";
        $data["section_title"] = "Marketer User List";

        if ($id) {
            $plan_id = $id ?? null;
            $plan_period = null;
        } else {
            $plan_id = $_POST["plan_id"] ?? null;
            $plan_period = $_POST["plan_period"] ?? null;
        }

        $ids = [];
        if ($plan_period) {
            $ids[] = $plan_period;
        } else {
            if ($plan_id && $plan_id == "NoPlan") {
                $plans = $this->db
                    ->select("*")
                    ->from("membership_plan")
                    ->where("plan_type", null)
                    ->get()
                    ->result_array();
                $ids[] = $plans[0]["id"];
            } else {
                if ($plan_id) {
                    $plans = $this->db
                        ->select("*")
                        ->from("membership_plan")
                        ->where("plan_type", $plan_id)
                        ->get()
                        ->result_array();
                    foreach ($plans as $key => $plan) {
                        $ids[] = $plan["id"];
                    }
                }
            }
        }

        $data["rows"] = $this->common->getAllMarketer($ids);
        $data["plan_id"] = $plan_id;
        $data["plan_period"] = $plan_period;

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/marketer/index");
        $this->load->view("admin/include/footer");
    }

    public function view()
    {
        $id = $_POST["id"] ? $_POST["id"] : "";
        $marketer = $this->common->getSingleRecordById($id, "users");
        $output = $this->load->view('admin/marketer/view', ['member' => $marketer], true);
        echo json_encode($output);
    }

    public function viewdetails($id = null)
    {
        $id = isset($id) ? $id : "";
        $name = '';
        if ($id) {
            $userData = $this->db->select('*')->from('users')->where('id', $id)->get()->row_array();
            $name = $userData['first_name'] . ' ' . $userData['last_name'];
        }
        $data["title"] = "Member User";
        $data["breadcrumb_title"] = "Member User";
        $data["breadcrumb_menu"] = "Marketer User";
        $data["section_title"] = $name;

        $userRecords = $this->levelWiseMemberCountList($id);

        // Fetch bonus income for the selected user_id
        $totalBonus = $this->db->select('SUM(amount) as total_bonus')->where('user_id', $id)->get('bonus_incomes');
        $bonusIncome = $totalBonus->row_array();
        $totalBonusIncome = 0;
        if($bonusIncome){
            $totalBonusIncome = $bonusIncome['total_bonus'] ?? 0;
        }

        /*echo '<pre>';
        print_r($userRecords);
        exit();*/

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/marketer/viewdetails", ['marketerData' => $userRecords,'totalBonusIncome' => $totalBonusIncome]);
        $this->load->view("admin/include/footer");
    }

    public function levelWiseMemberCountList($userId)
    {
        $usersLevels = array();
        $referralIds = [$userId];
        for ($i = 1; $i <= 100; $i++) {
            $userRecords = [];
            if (!empty($referralIds))
                $userRecords = $this->db->select('*')->from('users')->where_in('refer_by', $referralIds)->get()->result_array();

            /*$userRecords = $this->db->select('*')->from('users as U')
                ->join('transactions as T', 'U.id = T.to_user_id', 'LEFT')
                ->where_in('U.refer_by', $referralIds)
                ->where('T.payment_type', 'Referral Bonus')
                ->get()->result_array();*/

            if (!empty($userRecords)) {

                foreach ($userRecords as $idx => $getData) {
                    $user_id = $getData['id'];
                    $transactions = $this->db->select('amount')->from('transactions')
                        ->where('payment_type', 'Referral Bonus')
                        ->where('to_user_id', $user_id)
                        ->where('user_id', $userId)
                        ->get()->row_array();
                    if ($transactions) {
                        $userRecords[$idx]['amount'] = isset($transactions['amount']) ? $transactions['amount'] : '0';
                    } else {
                        $userRecords[$idx]['amount'] = '0';
                    }
                }

                $usersLevels[] = ['level' => $i, 'levelWiseMemberCount' => count($userRecords), 'levelWiseMember' => $userRecords, 'levelWiseAmountSum' => (string)array_sum(array_column($userRecords, 'amount'))];
                $referralIds = array_column($userRecords, 'id');
            } else {
                $usersLevels[] = ['level' => $i, 'levelWiseMemberCount' => 0, 'levelWiseMember' => [], 'levelWiseAmountSum' => '0.00'];
            }
        }
        return $usersLevels;
    }

    public function add()
    {
        $data["title"] = "Marketer User";
        $data["breadcrumb_title"] = "Marketer User";
        $data["breadcrumb_menu"] = "Add Marketer User";
        $data["section_title"] = "Add Marketer User";

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/marketer/add");
        $this->load->view("admin/include/footer");
    }

    public function save()
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules(
                "first_name",
                "First Name",
                "trim|required"
            );
            $this->form_validation->set_rules(
                "last_name",
                "Last Name",
                "trim|required"
            );
            $this->form_validation->set_rules(
                "email",
                "email",
                "trim|required|is_unique[users.email]"
            );
            $this->form_validation->set_rules(
                "mobile",
                "mobile",
                "trim|required|is_unique[users.mobile]"
            );
            $this->form_validation->set_rules(
                "password",
                "Password",
                "required"
            );
            $this->form_validation->set_rules(
                "confirm_password",
                "Confirm Password",
                "required|matches[password]"
            );

            if ($this->form_validation->run()) {
                $insertRow = [
                    "first_name" => $_POST["first_name"],
                    "last_name" => $_POST["last_name"],
                    "email" => $_POST["email"],
                    "mobile" => $_POST["mobile"],
                    "role" => "Marketer",
                    "password" => md5($_POST["password"]),
                    "address" => $_POST["address"],
                ];

                $insertRow = $this->common->insert("users", $insertRow);

                if ($insertRow) {
                    $this->session->set_flashdata(
                        "success_message",
                        "User Created Successfully!"
                    );
                    redirect(base_url("admin/marketer"));
                } else {
                    $this->session->set_flashdata(
                        "error_message",
                        "Please Try Again Something Gone Wrong!"
                    );
                    redirect(base_url("admin/marketer/add"));
                }
            } else {
                $this->add();
            }
        } else {
            redirect(base_url("admin/marketer/add"));
        }
    }

    public function edit($id)
    {
        $data["title"] = "Marketer User";
        $data["breadcrumb_title"] = "Marketer User";
        $data["breadcrumb_menu"] = "Edit Marketer";
        $data["section_title"] = "Edit Marketer";
        $data["row"] = $this->common->getSingleRecordById($id, "users");
        $total_evidence_size_arr = $this->common->getTotalsizeofEvidences($id);
        $total_evidence_size = $total_evidence_size_arr["size"];
        $total_evidence_size_in_gb = $total_evidence_size / 1024 / 1024;
        $data["total_evidence_size_in_kb"] = round($total_evidence_size);
        $data["total_evidence_size_in_gb"] = round(
            $total_evidence_size_in_gb,
            4
        );
        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/marketer/edit");
        $this->load->view("admin/include/footer");
    }

    public function update($id)
    {
        if (isset($_POST) && !empty($_POST)) {
            $singleRow = $this->common->getSingleRecordById($id, "users");

            $this->form_validation->set_rules(
                "first_name",
                "First Name",
                "trim|required"
            );
            $this->form_validation->set_rules(
                "last_name",
                "Last Name",
                "trim|required"
            );

            if (
                isset($_POST["mobile"]) &&
                !empty($_POST["mobile"]) &&
                $_POST["mobile"] != $singleRow["mobile"]
            ) {
                $this->form_validation->set_rules(
                    "mobile",
                    "mobile",
                    "trim|required|is_unique[users.mobile]"
                );
            } else {
                $this->form_validation->set_rules(
                    "mobile",
                    "mobile",
                    "trim|required"
                );
            }

            if (
                isset($_POST["email"]) &&
                !empty($_POST["email"]) &&
                $_POST["email"] != $singleRow["email"]
            ) {
                $this->form_validation->set_rules(
                    "email",
                    "email",
                    "trim|required|is_unique[users.email]"
                );
            } else {
                $this->form_validation->set_rules(
                    "email",
                    "email",
                    "trim|required"
                );
            }

            if (!empty($_POST["password"])) {
                $this->form_validation->set_rules(
                    "password",
                    "password",
                    "required"
                );
                $this->form_validation->set_rules(
                    "confirm_password",
                    "confirm password",
                    "required|matches[password]"
                );
            }
            if ($this->form_validation->run()) {
                $UpdateRow = [
                    "first_name" => $_POST["first_name"],
                    "last_name" => $_POST["last_name"],
                    "mobile" => $_POST["mobile"],
                    "address" => $_POST["address"],
                    "password" => md5($_POST["password"]),
                ];

                $insertRow = $this->common->update($UpdateRow, $id, "users");

                if ($insertRow) {
                    $this->session->set_flashdata(
                        "success_message",
                        "User Update Successfully!"
                    );
                    redirect(base_url("admin/marketer"));
                } else {
                    $this->session->set_flashdata(
                        "error_message",
                        "Please Try Again Something Gone Wrong!"
                    );
                    redirect(base_url("admin/marketer/edit/" . $id));
                }
            } else {
                $this->edit($id);
            }
        } else {
            redirect(base_url("admin/marketer/edit/" . $id));
        }
    }

    public function delete($id)
    {
        $this->db->delete("users", ["id" => $id]);
        echo "Deleted successfully.";
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
        $UpdateRow = ["status" => $st];
        $update = $this->common->update($UpdateRow, $id, "users");
        if ($update) {
            $this->session->set_flashdata(
                "success_message",
                "User Status Update Successfully!"
            );
            redirect(base_url("admin/marketer"));
        } else {
            $this->session->set_flashdata(
                "error_message",
                "Please Try Again Somthing Gone Wrong!"
            );
            redirect(base_url("admin/marketer/edit/" . $id));
        }
    }

    public function profile()
    {
        $data["title"] = "Profile Manager";
        $data["breadcrumb_title"] = "Profile Manager";
        $data["breadcrumb_menu"] = "Edit Profile";
        $data["section_title"] = "Edit Profile";
        $data["row"] = $this->common->getSingleRecordById(
            $_SESSION["Admin"]["id"],
            "users"
        );

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/marketer/profile");
        $this->load->view("admin/include/footer");
    }

    public function updateprofile($id)
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules(
                "first_name",
                "First Name",
                "trim|required"
            );
            $this->form_validation->set_rules(
                "last_name",
                "Last Name",
                "trim|required"
            );

            $this->form_validation->set_rules(
                "mobile",
                "mobile",
                "trim|required"
            );

            if ($this->form_validation->run()) {
                $UpdateRow = [
                    "first_name" => $_POST["first_name"],
                    "last_name" => $_POST["last_name"],
                    "mobile" => $_POST["mobile"],
                ];
                $insertRow = $this->common->update($UpdateRow, $id, "users");
                if ($insertRow) {
                    $this->session->set_flashdata(
                        "success_message",
                        "Profile update successfully!"
                    );
                    redirect(base_url("admin/marketer/profile"));
                } else {
                    $this->session->set_flashdata(
                        "error_message",
                        "Please try again Somthing gone wrong!"
                    );
                    redirect(base_url("admin/marketer/profile/" . $id));
                }
            } else {
                $this->profile($id);
            }
        } else {
            redirect(base_url("admin/marketer/profile/" . $id));
        }
    }
}
