<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    protected $path_view;
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Menu_model', 'menus');

        $this->path_view = (object) [
            'view' => 'admins/menu/view',
            'create' => 'admins/menu/add',
            'edit' => 'admins/menu/edit'
        ];
    }

    public function index()
    {

        $this->data['news'] = $this->menus->read()->result();
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
    }

    function create(){
        $this->data['pages'] = $this->path_view->create;
        $this->load->view('admins/index', $this->data);
    }

    function edit($id = false)
    {

        if ($id) {
            $DataMenu = $this->menus->read($id)->row();
            if ($DataMenu) {
                $this->data['pages'] = $this->path_view->edit;
                $this->data['menu'] = $DataMenu;
                $this->load->view('admins/index', $this->data);
            } else {
                redirect(base_url('panel-admin/menu'), 'refresh');
            }
        } else {
            redirect(base_url('panel-admin/menu'), 'refresh');
        }
    }

    function save(){
        $PostData=$this->input->post();

        $this->menus->create($PostData);
        redirect(base_url('panel-admin/menu'),'refresh');
        
    }

    function update($id){
        $PostData=$this->input->post();

        $this->menus->update($id,$PostData);
        redirect(base_url('panel-admin/menu'),'refresh');
    }

    function delete($id){
        $this->menus->delete($id);
        redirect(base_url('panel-admin/menu'),'refresh');
    }
}

/* End of file Menu.php and path \application\controllers\admin\Menu.php */
