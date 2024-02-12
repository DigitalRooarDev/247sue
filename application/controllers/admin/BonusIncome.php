<?php
defined("BASEPATH") or exit("No direct script access allowed");

class BonusIncome extends CI_Controller
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
        $user_id = $_POST["user_id"] ?? null;

        $data["title"] = "Bonus Income";
        $data["breadcrumb_title"] = "Bonus Income";
        $data["section_title"] = "Bonus Income List";
        $data["bonusIncome"] = $this->common->getAllBonusIncome($user_id);
        $data["user_id"] = $user_id;

        $this->load->view("admin/include/header", $data);
        $this->load->view("admin/include/left");
        $this->load->view("admin/bonus_income/index");
        $this->load->view("admin/include/footer");
    }

}
