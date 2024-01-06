<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Halaman extends CI_Controller
{

    protected $path_view;
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Halaman_model', 'halamans');
        $this->load->model('admin/Menu_model', 'menus');

        $this->path_view = (object) [
            'view' => 'admins/halaman/view',
            'create' => 'admins/halaman/add',
            'edit' => 'admins/halaman/edit'
        ];
    }

    public function index()
    {
        $dataHalaman = $this->halamans->read()->result_array();
        foreach ($dataHalaman as $key => $value) {
            $dataMennu = $this->menus->read($value['id_menu'])->row();
            $dataHalaman[$key]['nama_menu'] = $dataMennu->nama_menu;
        }

        $this->data['news'] = (object)$dataHalaman;
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
        // $this->output->set_content_type('application/json')->set_output(json_encode($this->data));

    }

    function create()
    {
        $this->data['menu'] = $this->menus->read()->result();
        $this->data['pages'] = $this->path_view->create;
        $this->load->view('admins/index', $this->data);
    }

    function edit($id = false)
    {

        if ($id) {
            $DataHalaman = $this->halamans->read($id)->row();
            if ($DataHalaman) {
                $this->data['menu'] = $this->menus->read()->result();
                $this->data['pages'] = $this->path_view->edit;
                $this->data['halaman'] = $DataHalaman;
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

        unset($PostData['files']);
        unset($PostData['redirect']);
        $this->halamans->create($PostData);
        redirect(base_url('panel-admin/halaman'), 'refresh');
    }

    function update($id)
    {
        $PostData = $this->input->post();
        unset($PostData['files']);
        unset($PostData['redirect']);
        $this->halamans->update($id, $PostData);
        redirect(base_url('panel-admin/halaman'), 'refresh');
    }

    function delete($id)
    {
        $this->halamans->delete($id);
        redirect(base_url('panel-admin/halaman'), 'refresh');
    }

    function upload_image()
    {
        if (isset($_FILES["image"]["name"])) {
            $this->load->library('upload');
            $config['upload_path'] = './assets/uploads/halaman/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/halaman/' . $data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['width'] = 800;
                $config['height'] = 800;
                $config['new_image'] = './assets/uploads/halaman/' . $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . 'assets/uploads/halaman/' . $data['file_name'];
            }
        }
    }

    function delete_image()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }
}

/* End of file Halaman.php and path \application\controllers\admin\Halaman.php */
