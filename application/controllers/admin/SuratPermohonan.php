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
        if (array_intersect($this->level, [3])) {
            $this->db->where('status', 'Pending');
            $this->db->or_where('status', 'Selesai');
        }
        $dataPermohonan = $this->db->get('v_permohonan_surat')->result_array();
        foreach ($dataPermohonan as $key => $item) {
            $this->db->where('a.id_pengajuan', $item['id_pengajuan']);
            $this->db->join('surat_jenis_syarat b', 'a.id_syarat_surat=b.id_syarat_surat', 'inner');
            $persyaratanFile = $this->db->get('pengajuan_surat_file a')->result();
            $fieldsData = $this->db->get_where('metadata_surat', ['id_metadata' => $item['id_metadata']])->row()->fields;
            $dataPermohonan[$key]['data_surat'] = json_decode($item['data_surat']);
            $dataPermohonan[$key]['persyaratan'] = $persyaratanFile;
            $dataPermohonan[$key]['fields'] = json_decode($fieldsData);
        }
        $this->data['data'] = (object)$dataPermohonan;
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
    }

    public function update($id)
    {
        $DataPost = $this->input->post();
        $GetJenisSurat = $this->db->get_where('pengajuan_surat', ['id_pengajuan' => $id])->row()->id_surat;


        $allowedLevels = [3];
        if (array_intersect($this->level, $allowedLevels)) {
            $DataPost['tanggal_signatur'] = date('Y-m-d');
            $DataPost['signatur_kode'] = $this->generateRandomNumber(16);
            $DataPost['no_surat'] = $this->get_next_number($GetJenisSurat);
        }
        $this->db->where('id_pengajuan', $id);
        $this->db->update('pengajuan_surat', $DataPost);
        redirect(base_url('panel-admin/suratpermohonan'), 'refresh');
    }

    function generateRandomNumber($length = 16)
    {
        $min = pow(10, $length - 1);
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }

    private function get_next_number($jenis_surat)
    {
        $getFormatedPenomoran = $this->db->get_where('surat_jenis', ['id_surat_jenis' => $jenis_surat])->row()->format_penomoran;

        // Mendapatkan nomor terakhir untuk jenis surat tertentu dari database
        $last_number = $this->get_last_number_from_database($jenis_surat);

        // Mengonversi nomor terakhir ke nomor berikutnya dengan format tiga digit (001, 002, dst.)
        $next_number = $last_number + 1;

        // Membuat nomor surat sesuai format yang diinginkan
        $nomor_surat = $next_number . $getFormatedPenomoran . date('Y');

        return $nomor_surat;
    }

    private function get_last_number_from_database($jenis_surat)
    {
        // Contoh pengambilan nomor terakhir dari database
        // Anda harus mengganti bagian ini sesuai dengan cara Anda menyimpan nomor terakhir dari jenis surat tertentu
        // Misalnya, menggunakan model atau query ke database
        $this->db->select('no_surat');
        $this->db->from('pengajuan_surat');
        $this->db->where('id_surat', $jenis_surat);
        $this->db->order_by('id_pengajuan', 'DESC');
        $query = $this->db->get();

        // Mendapatkan nomor terakhir
        if ($query->num_rows() > 0) {
            $last_number = (int) substr($query->row()->no_surat, 0, 3);
        } else {
            // Jika tidak ada nomor sebelumnya, mengembalikan nomor 1
            $last_number = 0;
        }

        return $last_number;
    }
}

/* End of file SuratPermohonan.php and path \application\controllers\admin\SuratPermohonan.php */
