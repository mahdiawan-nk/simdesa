<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    protected $path_view;
    protected $data=[];
    public function __construct()
    {
        parent::__construct();
        $isLoggedIn = $this->session->userdata('login') ?? false;
        $userLevel = $this->session->userdata('level') ?? [];

        $allowedLevels = [1, 2, 3];

        if (!$isLoggedIn && !array_intersect($userLevel, $allowedLevels)) {
            redirect(base_url('panel-admin'), 'refresh', 200);
        }

        $this->path_view = (object) [
            'view' => 'admins/dashboard',
            'create' => 'admins/berita/add',
            'edit' => 'admins/berita/edit'
        ];
    }

    public function index()
    {
        if($this->session->userdata('level')[0] == 'warga'){
            $this->data['data']=$this->statistikwarga();
        }else{
            $this->data['data']=$this->statistik();
        }
        
        $this->data['pages']=$this->path_view->view;
        $this->load->view('admins/index',$this->data);
    }

    function statistik(){
        $dataPenduduk = $this->db->count_all_results('penduduk');
        $dataPerangkatdesa=$this->db->count_all_results('perangkat_desa');
        $dataJenissurat=$this->db->count_all_results('surat_jenis');
        $dataPermohonansurat = $this->db->count_all_results('pengajuan_surat');
        $this->db->where('status', 'Selesai');
        $dataPermohonanSelesai = $this->db->count_all_results('pengajuan_surat');   
        $this->db->where('status', 'Tolak');
        $dataPermohonanTolak = $this->db->count_all_results('pengajuan_surat');
        $dataPostberita = $this->db->count_all_results('data_berita');
        $dataKategori = $this->db->count_all_results('berita_kategori');

        return (object)[
            'penduduk'=>$dataPenduduk,
            'perangkat_desa'=>$dataPerangkatdesa,
            'jenis_surat'=>$dataJenissurat,
            'permohonan_surat'=>$dataPermohonansurat,
            'permohonan_selesai'=>$dataPermohonanSelesai,
            'permohonan_gagal'=>$dataPermohonanTolak,
            'postingan_berita'=>$dataPostberita,
            'kategori_berita'=>$dataKategori
        ];
    }
    
    function statistikwarga(){
        $this->db->where('id_penduduk',$this->session->userdata('uuid'));
        $pengajuanSaya = $this->db->count_all_results('pengajuan_surat');
        $this->db->where('id_penduduk',$this->session->userdata('uuid'));
        $this->db->where('status', 'Selesai');
        $pengajuanSelesai = $this->db->count_all_results('pengajuan_surat');
        return (object)[
            'pengajuan_saya'=>$pengajuanSaya,
            'pengajuan_selesai'=>$pengajuanSelesai
        ];
    }
}

/* End of file Dashboard.php and path \application\controllers\admin\Dashboard.php */
