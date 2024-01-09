<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita extends CI_Controller
{
    protected $path_view;
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Berita_model', 'news');
        $this->load->model('admin/Kategori_model', 'kategori');

        $this->path_view = (object) [
            'view' => 'admins/berita/view',
            'create' => 'admins/berita/add',
            'edit' => 'admins/berita/edit',
            'view_k' => 'admins/kategori/view',
            'create_k' => 'admins/kategori/add',
            'edit_k' => 'admins/kategori/edit',
        ];
    }

    public function index()
    {
        $berita = $this->news->read()->result_array();
        foreach ($berita as $key => $item) {
            $berita[$key]['nama_kategori'] = $this->kategori->read($item['kategori_id'])->row()->nama_kategori;
        }
        $this->data['news'] = (object)$berita;
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
        // $this->output->set_content_type('application/json')->set_output(json_encode($this->data));
    }

    function create()
    {
        $this->data['kategori'] = $this->kategori->read()->result();
        $this->data['pages'] = $this->path_view->create;
        $this->load->view('admins/index', $this->data);
    }

    function edit($id = false)
    {

        if ($id) {
            $DataBerita = $this->news->read($id)->row();
            if ($DataBerita) {
                $this->data['kategori'] = $this->kategori->read()->result();
                $this->data['pages'] = $this->path_view->edit;
                $this->data['news'] = $DataBerita;
                $this->load->view('admins/index', $this->data);
            } else {
                redirect(base_url('panel-admin/berita'), 'refresh');
            }
        } else {
            redirect(base_url('panel-admin/berita'), 'refresh');
        }
    }

    function save()
    {
        $PostData = [
            'title' => $this->input->post('title'),
            'slug' => $this->input->post('slugs'),
            'status' => $this->input->post('status'),
            'content' => $this->input->post('content'),
            'kategori_Id' => $this->input->post('kategori_id')
        ];


        $config['upload_path'] = './assets/uploads/berita/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']  = '1024';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $this->upload->display_errors();
            redirect(base_url('panel-admin/berita/create'), 'location');
        } else {
            $data = $this->upload->data();

            $PostData['thumbnail'] = $data['file_name'];
            $this->news->create($PostData);
            redirect(base_url('panel-admin/berita'), 'refresh');
        }
    }

    function update($id)
    {
        $PostData = [
            'title' => $this->input->post('title'),
            'slug' => $this->input->post('slugs'),
            'status' => $this->input->post('status'),
            'content' => $this->input->post('content'),
            'kategori_Id' => $this->input->post('kategori_id')
        ];

        if ($_FILES['file']['name']) {
            $config['upload_path'] = './assets/uploads/berita/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']  = '1024';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $this->upload->display_errors();
                redirect(base_url('panel-admin/berita/edit' . $id), 'location');
            } else {
                $data = $this->upload->data();

                $PostData['thumbnail'] = $data['file_name'];
                $this->news->update($id, $PostData);
                redirect(base_url('panel-admin/berita'), 'refresh');
            }
        } else {
            $this->news->update($id, $PostData);
            redirect(base_url('panel-admin/berita'), 'refresh');
        }
    }
    function upload_image()
    {
        if (isset($_FILES["image"]["name"])) {
            $this->load->library('upload');
            $config['upload_path'] = './assets/uploads/berita/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();
                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/uploads/berita/' . $data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['width'] = 800;
                $config['height'] = 800;
                $config['new_image'] = './assets/uploads/berita/' . $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . 'assets/uploads/berita/' . $data['file_name'];
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

    function delete($id)
    {
        $this->db->delete('data_berita', ['id' => $id]);
        redirect(base_url('panel-admin/berita'), 'refresh');
    }

    function kategori()
    {
        $this->data['kategori'] = $this->kategori->read()->result();
        $this->data['pages'] = $this->path_view->view_k;
        $this->load->view('admins/index', $this->data);
    }

    function savekategori($id = null)
    {
        $dataPost = $this->input->post();
        if ($id == null) {
            $this->kategori->create($dataPost);
        } else {
            $this->kategori->update($id, $dataPost);
        }

        redirect(base_url('panel-admin/berita/kategori'), 'refresh');
    }

    function deletekategori($id)
    {
        $this->kategori->delete($id);
        redirect(base_url('panel-admin/berita/kategori'), 'refresh');
    }
}


/* End of file Berita.php and path \application\controllers\admin\Berita.php */
