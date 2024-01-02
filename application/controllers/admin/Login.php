<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        Parent::__construct();
        $this->load->model('Auth_model', 'auth');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('admin/login', $data);
    }

    public function auth()
    {
        if (isset($_POST) && !empty($_POST)) {
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-red m-0" style="margin:0px;">', '</p>');
            if ($this->form_validation->run() == FALSE) {
                $this->index();
            } else {
                $loginUserdata = $this->auth->checklogin();
                if ($loginUserdata) {
                    $userdata = array(
                        $loginUserdata['role'] => array(
                            'id' => $loginUserdata['id'],
                            'role' => $loginUserdata['role'],
                            'first_name' => $loginUserdata['first_name'],
                            'last_name' => $loginUserdata['last_name'],
                            'username' => $loginUserdata['username'],
                            'email' => $loginUserdata['email'],
                            'mobile' => $loginUserdata['mobile'],
                            'profile' => $loginUserdata['profile'],
                            'is_login' => True,
                        ),
                    );
                    $this->session->set_userdata($userdata);
                    redirect(base_url('admin/dashboard'));
                } else {
                    $this->session->set_flashdata('error_message', 'Your email or password do not match');
                    redirect(base_url('admin/login'));
                }
            }
        } else {
            redirect(base_url('admin/login'));
        }
    }

    public function logout()
    {
        session_destroy();
        redirect(base_url('admin/login'));
    }
}
