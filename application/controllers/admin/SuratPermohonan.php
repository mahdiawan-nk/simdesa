<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratPermohonan extends CI_Controller
{

    protected $path_view;
    protected $data = [];
    protected $level;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Perangkatdesa_model', 'perangkat');

        $this->path_view = (object) [
            'view' => 'admins/permohonan/view',
            'create' => 'admins/permohonan/add',
            'edit' => 'admins/permohonan/edit'
        ];
        $this->level = $this->session->userdata('level') ?? [];
    }

    public function index()
    {
        $dataPermohonan = $this->db->get('v_permohonan_surat')->result_array();
        foreach ($dataPermohonan as $key=>$item) {
            $this->db->where('a.id_pengajuan', $item['id_pengajuan']);
            $this->db->join('surat_jenis_syarat b', 'a.id_syarat_surat=b.id_syarat_surat', 'inner');
            $persyaratanFile = $this->db->get('pengajuan_surat_file a')->result();
            $fieldsData = $this->db->get_where('metadata_surat',['id_metadata'=>$item['id_metadata']])->row()->fields;
            $dataPermohonan[$key]['data_surat']=json_decode($item['data_surat']);
            $dataPermohonan[$key]['persyaratan']=$persyaratanFile;
            $dataPermohonan[$key]['fields']=json_decode($fieldsData);
        }
        $this->data['data']=(object)$dataPermohonan;
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
        
    }

    public function update($id)
    {
        $DataPost = $this->input->post();
        $allowedLevels = [3];
        if (array_intersect($this->level, $allowedLevels)) {
          $DataPost['tanggal_signatur']=date('Y-m-d');
          $DataPost['signatur_kode']= $this->generateRandomNumber(16);
        }
        $this->db->where('id_pengajuan', $id);
        $this->db->update('pengajuan_surat', $DataPost);
        redirect(base_url('panel-admin/suratpermohonan'),'refresh');
        
    }

    function generateRandomNumber($length = 16) {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }
}

/* End of file SuratPermohonan.php and path \application\controllers\admin\SuratPermohonan.php */
