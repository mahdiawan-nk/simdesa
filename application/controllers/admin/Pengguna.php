<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

    protected $path_view;
    protected $data = [];
    public $admin,$output,$input;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admins_model', 'admin');

        $this->path_view = (object) [
            'view' => 'admins/pengguna/view',
            'create' => 'admins/pengguna/add',
            'edit' => 'admins/pengguna/edit'
        ];
        
    }

    public function index()
    {

        $this->data['data'] = $this->admin->read()->result();
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
    }

    function save(){
        $PostData=$this->input->post();
        
        $this->output->set_content_type('application/json')->set_output(json_encode($PostData));
        
        $this->admin->create($PostData);
        redirect(base_url('panel-admin/pengguna'),'refresh');
        
    }

    function update($id){
        $PostData=$this->input->post();
        if($PostData['password']){
            $PostData['password']=md5($PostData['password']);
        }else{
            unset($PostData['password']);
        }
        
        $this->admin->update($id,$PostData);
        redirect(base_url('panel-admin/pengguna'),'refresh');
    }

    function delete($id){
        $this->admin->delete($id);
        redirect(base_url('panel-admin/pengguna'),'refresh');
    }
}

/* End of file Pengguna.php and path \application\controllers\admin\Pengguna.php */
