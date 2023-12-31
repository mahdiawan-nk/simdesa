<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratUser extends CI_Controller
{

    protected $path_view;
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Suratjenis_model', 'jsurat');
        $this->path_view = (object) [
            'view' => 'user/pengajuan/view',
            'create' => 'user/pengajuan/add',
            'edit' => 'user/pengajuan/edit'
        ];
    }

    public function index()
    {
        $this->db->select('a.*,b.nama_surat');
        $this->db->join('surat_jenis b', 'a.id_surat=b.id_surat_jenis', 'inner');
        $dataSurat = $this->db->get('pengajuan_surat a')->result();
        $this->data['surat'] = $this->jsurat->read()->result();
        $this->data['data'] = $dataSurat;
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
    }

    public function pengajuan($slug)
    {
        $this->db->where('slug', $slug);
        $dataSurat = $this->jsurat->read()->row();
        $metaData = $this->db->get_where('metadata_surat', ['id_jenis_surat' => $dataSurat->id_surat_jenis])->row();
        $this->data['surat'] = $dataSurat;
        $this->data['syarat'] = $this->db->get_where('surat_jenis_syarat', ['id_surat' => $dataSurat->id_surat_jenis])->result();
        $this->data['metadata'] = (object)['id_metadata' => $metaData->id_metadata, 'fields' => json_decode($metaData->fields)];
        $this->data['pages'] = $this->path_view->create;
        $this->load->view('admins/index', $this->data);
        // $this->output->set_content_type('application/json')->set_output(json_encode($this->data));

    }

    public function save($slug)
    {
        $syarat = $this->db->get_where('surat_jenis_syarat', ['id_surat' => $this->input->post('id_surat')])->result_array();
        $dataSurat = $this->input->post();
        unset($dataSurat['id_surat']);
        unset($dataSurat['id_metadata']);
        $dataPost = [
            'id_penduduk' => $this->session->userdata('uuid'),
            'id_surat' => $this->input->post('id_surat'),
            'id_metadata' => $this->input->post('id_metadata'),
            'data_surat' => json_encode($dataSurat),
            'tanggal_pengajuan' => date('Y-m-d'),
            'status' => 'Prosess'
        ];

        $insert = $this->db->insert('pengajuan_surat', $dataPost);
        $latId =$this->db->insert_id();

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|pdf|jpeg';

        $this->load->library('upload', $config);

        foreach ($_FILES['files']['name'] as $key => $value) {
            $_FILES['file']['name'] = $_FILES['files']['name'][$key][$syarat[$key]['id_syarat_surat']];
            $_FILES['file']['type'] = $_FILES['files']['type'][$key][$syarat[$key]['id_syarat_surat']];
            $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$key][$syarat[$key]['id_syarat_surat']];
            $_FILES['file']['error'] = $_FILES['files']['error'][$key][$syarat[$key]['id_syarat_surat']];
            $_FILES['file']['size'] = $_FILES['files']['size'][$key][$syarat[$key]['id_syarat_surat']];
            if ($_FILES['file']['name']) {
                $encrypted_name = md5(uniqid(rand(), true)) . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

                $config['file_name'] = $encrypted_name;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('file')) {
                    // Berhasil diunggah
                    $uploadData = $this->upload->data();
                    $dataFile[]=[
                        'id_pengajuan'=>$latId,
                        'id_syarat_surat'=>$syarat[$key]['id_syarat_surat'],
                        'file'=>$uploadData['file_name']
                    ];
                }
            }else{
                $dataFile[]=[
                    'id_pengajuan'=>$latId,
                    'id_syarat_surat'=>$syarat[$key]['id_syarat_surat'],
                    'file'=>NULL
                ];
            }
        }

        $this->db->insert_batch('pengajuan_surat_file', $dataFile);
        
        
        if ($insert) {
            redirect(base_url('panel-user/surat'));
        } else {
            redirect(base_url('panel-user/surat/pengajuan/' . $slug));
        }
    }
}

/* End of file SuratUser.php and path \application\controllers\SuratUser.php */
