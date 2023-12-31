<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthAdmin extends CI_Controller
{
    protected $post;
    protected $get;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Admins_model', 'admins');

        $this->post = $this->input->post();
        $this->get = $this->input->get();
    }

    public function index()
    {
        $isLoggedIn = $this->session->userdata('login') ?? false;
        $userLevel = $this->session->userdata('level') ?? [];

        $allowedLevels = [1, 2, 3];

        if ($isLoggedIn && array_intersect($userLevel, $allowedLevels)) {
            redirect(base_url('panel-admin/dashboard'), 'refresh', 200);
        } else {
            $this->load->view('admins/login_admin');
        }
    }

    public function checkuser()
    {


        $isEmailExist = $this->admins->checkEmail($this->post['email']);

        if ($isEmailExist) {
            $isPassword = $this->admins->checkPassword($this->post['password']);
            if ($isPassword) {
                $array = array(
                    'username'=>$isEmailExist->username,
                    'uuid' => $isEmailExist->id_admin,
                    'level' => [$isEmailExist->role],
                    'login' => TRUE
                );

                $this->session->set_userdata($array);
                redirect(base_url('panel-admin/dashboard'), 'refresh', 200);
            } else {
                echo 'password salah';
            }
        } else {
            echo 'email tidak terdaftar';
        }
        // $this->output->set_content_type('application/json')->set_output(json_encode($this->post));
    }

    public function Logout()
    {
        $array = array(
            'username'=>null,
            'level' => null,
            'uuid' => null,
            'login' => FALSE
        );
        $this->session->unset_userdata($array); //clear session
        $this->session->sess_destroy(); //tutup session
        redirect(base_url('panel-admin'));
    }
}

/* End of file AuthAdmin.php and path \application\controllers\admin\AuthAdmin.php */
