<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perangkatdesa extends CI_Controller
{

    protected $path_view;
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Perangkatdesa_model', 'perangkat');

        $this->path_view = (object) [
            'view' => 'admins/perangkat/view',
            'create' => 'admins/perangkat/add',
            'edit' => 'admins/perangkat/edit'
        ];
    }

    public function index()
    {

        $this->data['news'] = $this->perangkat->read()->result();
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
    }

    function create()
    {
        $this->data['pages'] = $this->path_view->create;
        $this->load->view('admins/index', $this->data);
    }

    function edit($id = false)
    {

        if ($id) {
            $DataPerangkat = $this->perangkat->read($id)->row();
            if ($DataPerangkat) {
                $this->data['pages'] = $this->path_view->edit;
                $this->data['data'] = $DataPerangkat;
                $this->load->view('admins/index', $this->data);
            } else {
                redirect(base_url('panel-admin/menu'), 'refresh');
            }
        } else {
            redirect(base_url('panel-admin/menu'), 'refresh');
        }
    }

    function save()
    {
        $PostData = $this->input->post();

        $config['upload_path'] = './assets/uploads/perangkatdesa/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']  = '1024';

        $this->load->library('upload', $config);
        if ($_FILES['file']['name']) {
            if (!$this->upload->do_upload('file')) {
                $this->upload->display_errors();
                redirect(base_url('panel-admin/perangkatdesa/add'), 'location');
            } else {
                $data = $this->upload->data();

                $PostData['foto'] = $data['file_name'];
                $this->perangkat->create($PostData);
                redirect(base_url('panel-admin/perangkatdesa'), 'refresh');
            }
        } else {
            $this->perangkat->create($PostData);
            redirect(base_url('panel-admin/perangkatdesa'), 'refresh');
        }
    }

    function update($id)
    {
        $PostData = $this->input->post();

        $config['upload_path'] = './assets/uploads/perangkatdesa/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']  = '1024';

        $this->load->library('upload', $config);
        if ($_FILES['file']['name']) {
            if (!$this->upload->do_upload('file')) {
                $this->upload->display_errors();
                redirect(base_url('panel-admin/perangkatdesa/add'), 'location');
            } else {
                $data = $this->upload->data();

                $PostData['foto'] = $data['file_name'];
                $this->perangkat->update($id,$PostData);
                redirect(base_url('panel-admin/perangkatdesa'), 'refresh');
            }
        } else {
            $this->perangkat->update($id,$PostData);
            redirect(base_url('panel-admin/perangkatdesa'), 'refresh');
        }
    }

    function delete($id)
    {
        $this->perangkat-->delete($id);
        redirect(base_url('panel-admin/perangkatdesa'), 'refresh');
    }
}

/* End of file Perangkatdesa.php and path \application\controllers\admin\Perangkatdesa.php */
