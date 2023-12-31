<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH.'third_party/tcpdf/tcpdf.php';
class Pdf extends TCPDF
{
    public $CI;
    public function __construct()
	{
		parent::__construct();
        $this->CI = &get_instance();
        $this->CI->load->library('format_tanggal');
        
	}

    function Kopsurat()
    {
        $image_file = FCPATH . './assets/logo_kampar.png';
        $this->Image($image_file, 20, 10, 25, 30, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $this->SetFont('times', 'B', 18);
        $this->Cell(0, 8, 'PEMERINTAH KABUPATEN KAMPAR', 0, 3, 'C', 0, '', 0, true, 'T', 'M');
        $this->Cell(0, 8, 'KECAMATAN BAGNKINANG KOTA', 0, 3, 'C', 0, '', 0, true, 'T', 'M');
        $this->SetFont('times', 'B', 27);
        $this->Cell(0, 8, 'KEPALA DESA KUMANTAN', 0, 2, 'C', 0, '', 1, true, 'T', 'M');
        $this->SetFont('times', 'B', 12);
        $this->Cell(0, 8, 'Alamat : Jln. Mahmud Marzuki No Kumantan Kode Pos .28451', 0, 3, 'C', 0, '', 1, true, 'T', 'M');
        $this->SetLineWidth(1); 
        $this->Line(15, 42, 210 - 15, 42); 
        $this->SetLineWidth(0.5); 
        $this->Line(15, 43, 210 - 15, 43);
    }

    public function Typesurat($data=null)
    {
        $this->SetFont('times', 'BU', 14);
        $this->Ln(5);
        $this->Cell(0, 5, strtoupper($data->nama_surat), 0, 3, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetFont('times', '', 14);
        $this->Cell(0, 5, 'Nomor: '.$data->id_pengajuan.$data->format_penomoran.date('Y',strtotime($data->tanggal_signatur)), 0, 3, 'C', 0, '', 0, false, 'T', 'M');

        $this->Ln(10);
        $this->SetFont('times', '', 12);
    }

    public function Signatur($dataSurat): void
    {
        $tanggal_surat = $this->CI->format_tanggal->format_tanggal($dataSurat->tanggal_signatur);
        $this->Ln(10);
        $this->SetFont('times', '', 12);
        $this->Cell(80, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'Di Keluarkan di', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('times', '', 12);
        $this->Cell(80, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'Pada Tanggal', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': ' . $tanggal_surat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('times', 'B', 12);
        $this->Cell(80, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, 'KEPALA DESA KUMANTAN', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Ln(5);

        $this->SetLineWidth(0.5);
        $this->Line(101, 225, 210 - 35, 225);
        $this->SetFont('times', 'BU', 14);

        $this->Ln(30);
        $this->SetFont('times', 'BU', 12);
        $this->Cell(80, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, 'MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetFont('times', '', 12);
        $this->Cell(80, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, 'NIPD : 234234343545', 0, 0, 'L', 0, '', 0, false, 'T', 'M');

        $style = array(
            'border' => FALSE,
            'padding' => 5,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        );
        $this->write2DBarcode($dataSurat->signatur_kode, 'QRCODE,H', 100, 226, 40, 40, $style, 'N');
    }

    public function formatSurat($dataPenduduk=null,$fieldData)
    {
        $this->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': '. $dataPenduduk->nama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'Jenis Kelamin', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': '. ($dataPenduduk->jenis_kelamin == 'L' ? 'Laki-laki':'Perempuan'), 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $tanggal_format = $this->CI->format_tanggal->format_tanggal($dataPenduduk->tgl_lahir);
        $this->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'Tempat/Tgl Lahir', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': '. $dataPenduduk->tempat_lahir.', '.$tanggal_format , 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'Bangsa/Agama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': '. $dataPenduduk->bangsa.'/'. $dataPenduduk->agama , 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'Pekerjaan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': '. $dataPenduduk->pekerjaan, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'Alamat', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': '. $dataPenduduk->alamat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(35, 5, 'No.KTP/NIK', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 5, ': '. $dataPenduduk->no_ktp_nik, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->SetLineWidth(0.2); 
        $this->Line(70, 175, 210 - 55, 175);

        $this->SetLineWidth(0.2); 
        $this->Line(70, 200, 210 - 55, 200);

        $this->Ln(5);
        $html = '<p style="text-align: justify; text-indent: 45px;">&emsp;Menurut data yang diperoleh serta keterangan yang bersangkutan di atas benar memiliki usaha di Desa Kumantan Kecamatan Bangkinang Kota, dan benar bahwa ianya mempunyai usaha:</p>';
        $this->writeHTML($html, true, false, true, false, 'J');
        $this->Ln(5);
        $this->SetFont('times', '', 12);
        $this->Cell(0, 5, $fieldData->namausaha, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        $this->SetFont('times', '', 12);
        $this->Cell(0, 5, 'Alamat Usaha : '. $fieldData->alamatusaha, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        $this->Ln(5);
        $this->Cell(0, 5, 'Surat ini dipergunakan untuk :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->Ln(5);
        $this->SetFont('times', '', 12);
        $this->Cell(0, 5, $fieldData->kepentingansurat, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
    }

}


/* End of file Pdf.php and path \application\libraries\Pdf.php */
