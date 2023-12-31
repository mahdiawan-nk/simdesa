<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userauth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Penduduk_model', 'pddk');
    }

    public function index()
    {
        $isLoggedIn = $this->session->userdata('login') ?? false;
        $userLevel = $this->session->userdata('level') ?? [];

        $allowedLevel = ['warga'];

        if ($isLoggedIn && $userLevel === $allowedLevel) {
            redirect(base_url('panel-user/dashboard'), 'refresh', 200);
        } else {
            $this->load->view('admins/login');
        }
    }

    public function checklogin()
    {
        $this->db->where('no_ktp_nik', $this->input->post('nikuser'));
        $checkNikuser = $this->pddk->read()->row();
        if ($checkNikuser) {
            $this->db->where('no_ktp_nik', $this->input->post('password'));
            $checkPwduser = $this->pddk->read()->row();
            if ($checkPwduser) {

                $array = array(
                    'username'=>$checkNikuser->nama,
                    'uuid' => $checkNikuser->id_penduduk,
                    'level' => ['warga'],
                    'login' => TRUE
                );

                $this->session->set_userdata($array);

                redirect(base_url('panel-admin/dashboard'), 'refresh', 200);
            } else {
                redirect(base_url('login'), 'refresh', 200);
            }
        } else {
            redirect(base_url('login'), 'refresh', 200);
        }
    }

    public function Logout()
    {
        $array = array(
            'username'=>null,
            'level' => '',
            'uuid' => '',
            'login' => FALSE
        );
        $this->session->unset_userdata($array); //clear session
        $this->session->sess_destroy(); //tutup session
        redirect(base_url('login'));
    }
}

/* End of file Userauth.php and path \application\controllers\Userauth.php */
