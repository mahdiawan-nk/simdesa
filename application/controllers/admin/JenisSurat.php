<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisSurat extends CI_Controller
{

    protected $path_view;
    protected $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Suratjenis_model', 'jsurat');

        $this->path_view = (object) [
            'view' => 'admins/surat_jenis/view',
            'create' => 'admins/surat_jenis/add',
            'edit' => 'admins/surat_jenis/edit'
        ];
    }

    public function index()
    {
        $this->data['data'] = $this->jsurat->read()->result();
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
    }

    public function save()
    {
        $dataPost = $this->input->post();
        unset($dataPost['files']);
        $insert = $this->jsurat->create($dataPost);

        if ($insert) {
            redirect(base_url('panel-admin/jenissurat'), 'refresh');
        } else {
            redirect(base_url('panel-admin/jenissurat'), 'refresh');
        }
    }
    public function update($id)
    {
        $dataPost = $this->input->post();
        unset($dataPost['files']);
        $update = $this->jsurat->update($id,$dataPost);

        if ($update) {
            redirect(base_url('panel-admin/jenissurat'), 'refresh');
        } else {
            redirect(base_url('panel-admin/jenissurat'), 'refresh');
        }
           
    }

    public function delete($id)
    {
        $delete = $this->jsurat->delete($id);

        if ($delete) {
            redirect(base_url('panel-admin/jenissurat'), 'refresh');
        } else {
            redirect(base_url('panel-admin/jenissurat'), 'refresh');
        }
    }
}

/* End of file JenisSurat.php and path \application\controllers\admin\JenisSurat.php */
