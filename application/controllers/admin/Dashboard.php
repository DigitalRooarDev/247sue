<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        Parent::__construct();
        //  die('hello')	;
        check_login_admin();
        $this->load->model('Dashboard_model', 'dashboard');
        $this->load->model('Common_model', 'common');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['data_count'] = $this->dashboard->dashboard();

        $data['userData'] = $this->common->getAllUserData();

        /* Plan Wise User Count */
        $totalNoPlans = $this->db->select('*')->from('membership_plan')->get()->result_array();
        $planData = array();
        foreach ($totalNoPlans as $key => $totalNoPlan) {
            $userCount = $this->db->from('users')->where('role', 'Client')->where('plan_id', $totalNoPlan['id'])->get()->num_rows();
            if ($totalNoPlan['plan_type']) {
                $total = $planData[$totalNoPlan['plan_type']][$totalNoPlan['plan_type']];

                $planData[$totalNoPlan['plan_type']][$totalNoPlan['plan_type']] = $total ? $total + $userCount : $userCount;
                //$planData[$totalNoPlan['plan_type']][$totalNoPlan['name']] = $userCount;
            } else {
                $planData['No Plan'][$totalNoPlan['name']] = $userCount;
            }
        }
        $data['planData'] = $planData;

        /*echo "<pre>";
        print_r($planData);
        exit;*/

        $totalNoPlansData = $this->db->select('*')->from('membership_plan')->get()->result_array();
        $planDataIds = array();
        foreach ($totalNoPlansData as $key => $totalNoPlan) {
            if ($totalNoPlan['plan_type']) {
                $planDataIds[$totalNoPlan['plan_type']] = $totalNoPlan['plan_type'] ?? 'no_plan';
                $planDataIds[$totalNoPlan['name']] = $totalNoPlan['id'];
            } else {
                // $planDataIds[$totalNoPlan['name']] = $totalNoPlan['id'];
                $planDataIds[$totalNoPlan['name']] = 'NoPlan';
            }
        }
        $data['totalNoPlansIds'] = $planDataIds;

        /*echo "<pre>";
        print_r($data['totalNoPlansIds']);
        exit;*/

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/dashboard/admindb');
        $this->load->view('admin/include/footer');
    }

    public function dateFilter()
    {

        $create_date = $_POST['create_date'];
        $create_date = explode("-", $create_date);

        $startDate = date('Y-m-d', strtotime($create_date[0]));
        $endDate = date('Y-m-d', strtotime($create_date[1]));

        /* Plan Wise User Count */
        $totalNoPlans = $this->db->select('*')->from('membership_plan')->get()->result_array();
        $planData = array();
        foreach ($totalNoPlans as $key => $totalNoPlan) {
            if ($totalNoPlan['plan_type']) {
                $total = $planData[$totalNoPlan['plan_type']][$totalNoPlan['plan_type'] . ' (Total)'];
                $userCount = $this->db->where('plan_id', $totalNoPlan['id'])->where('DATE(create_date) >=', $startDate)->where('DATE(create_date) <=', $endDate)->from('users')->get()->num_rows();

                $planData[$totalNoPlan['plan_type']][$totalNoPlan['plan_type'] . ' (Total)'] = $total ? $total + $userCount : $userCount;
                $planData[$totalNoPlan['plan_type']][$totalNoPlan['name']] = $this->db->where('plan_id', $totalNoPlan['id'])->where('DATE(create_date) >=', $startDate)->where('DATE(create_date) <=', $endDate)->from('users')->get()->num_rows();
            } else {
                $planData['No Plan'][$totalNoPlan['name']] = $this->db->where('plan_id', $totalNoPlan['id'])->where('DATE(create_date) >=', $startDate)->where('DATE(create_date) <=', $endDate)->from('users')->get()->num_rows();
            }
        }
        $data['planData'] = $planData;

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('DATE(create_date) >=', $startDate);
        $this->db->where('DATE(create_date) <=', $endDate);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $data['userData'] = $query->result_array();

        $data['create_date'] = $create_date;

        $this->load->view('admin/include/header', $data);
        $this->load->view('admin/include/left');
        $this->load->view('admin/dashboard/admindb');
        $this->load->view('admin/include/footer');
    }
}
