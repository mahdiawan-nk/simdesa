<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Syaratsurat extends CI_Controller {

    protected $path_view;
    protected $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Suratjenis_model','jsurat');
        
        $this->path_view = (object) [
            'view' => 'admins/syarat_surat/view',
            'create' => 'admins/syarat_surat/add',
            'edit' => 'admins/syarat_surat/edit'
        ];
    }

    public function index($id)
    {
        $this->data['surat']=$this->jsurat->read($id)->row();
        $this->data['data']=$this->db->get_where('surat_jenis_syarat',['id_surat'=>$id])->result();
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
    }

    public function save()
    {
        $dataPost = $this->input->post();
        $insert = $this->db->insert('surat_jenis_syarat',$dataPost);

        if ($insert) {
            redirect(base_url('panel-admin/syaratsurat/'.$dataPost['id_surat']), 'refresh');
        } else {
            redirect(base_url('panel-admin/syaratsurat/'.$dataPost['id_surat']), 'refresh');
            
        }
    }

    public function update($id)
    {
        $dataPost = $this->input->post();
        $this->db->where('id_syarat_surat', $id);
        $insert = $this->db->update('surat_jenis_syarat',$dataPost);

        if ($insert) {
            redirect(base_url('panel-admin/syaratsurat/'.$dataPost['id_surat']), 'refresh');
        } else {
            redirect(base_url('panel-admin/syaratsurat/'.$dataPost['id_surat']), 'refresh');
            
        }
    }

    public function delete($id)
    {
        $delete = $this->db->delete('surat_jenis_syarat',['id_syarat_surat'=>$id]);

        if ($delete) {
            redirect(base_url('panel-admin/syaratsurat/'.$id), 'refresh');
        } else {
            redirect(base_url('panel-admin/syaratsurat/'.$id), 'refresh');
            
        }
    }
}

/* End of file Syaratsurat.php and path \application\controllers\admin\Syaratsurat.php */
