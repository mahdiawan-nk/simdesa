<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Files extends CI_Controller
{
    public $pdf;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->library('format_tanggal');
        // $this->load->library('rtf');

        $this->pdf = new TCPDF('P', PDF_UNIT, [215.9, 355.6], true, 'UTF-8', false);
    }

    public function index($filename = '')
    {
        // Periksa apakah nama file tidak kosong
        if ($filename != '') {
            // Cek apakah file dengan ekstensi yang diizinkan
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
            $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
            if (in_array($file_extension, $allowed_extensions)) {
                $file = FCPATH . './uploads/' . $filename; // Sesuaikan dengan lokasi file Anda

                // Periksa apakah file ada di lokasi yang ditentukan
                if (file_exists($file)) {
                    // Tentukan header sesuai tipe file
                    header('Content-Type: ' . mime_content_type($file));
                    header('Content-Disposition: inline; filename="' . $filename . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Content-Length: ' . filesize($file));
                    header('Accept-Ranges: bytes');

                    // Baca file dan tampilkan isinya
                    readfile($file);
                    exit;
                } else {
                    echo "File tidak ditemukan.";
                }
            } else {
                echo "Ekstensi file tidak diizinkan.";
            }
        } else {
            echo "Nama file tidak valid.";
        }
    }

    function Kopsurat()
    {
        $image_file = FCPATH . './assets/logo_kampar.png';
        $this->pdf->Image($image_file, 20, 10, 25, 30, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $this->pdf->SetFont('times', 'B', 18);
        $this->pdf->Cell(0, 8, 'PEMERINTAH KABUPATEN KAMPAR', 0, 3, 'C', 0, '', 0, true, 'T', 'M');
        $this->pdf->Cell(0, 8, 'KECAMATAN BAGNKINANG KOTA', 0, 3, 'C', 0, '', 0, true, 'T', 'M');
        $this->pdf->SetFont('times', 'B', 27);
        $this->pdf->Cell(0, 8, 'KEPALA DESA KUMANTAN', 0, 2, 'C', 0, '', 1, true, 'T', 'M');
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->Cell(0, 8, 'Alamat : Jln. Mahmud Marzuki No Kumantan Kode Pos .28451', 0, 3, 'C', 0, '', 1, true, 'T', 'M');
        $this->pdf->SetLineWidth(1);
        $this->pdf->Line(15, 42, 210 - 15, 42);
        $this->pdf->SetLineWidth(0.5);
        $this->pdf->Line(15, 43, 210 - 15, 43);
    }

    public function Typesurat($data = null)
    {
        $this->pdf->SetFont('times', 'BU', 14);
        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, strtoupper($data->nama_surat), 0, 3, 'C', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 14);
        $this->pdf->Cell(0, 5, 'Nomor: ' . $data->id_pengajuan . $data->format_penomoran . date('Y', strtotime($data->tanggal_signatur)), 0, 3, 'C', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(10);
        $this->pdf->SetFont('times', '', 12);
    }

    public function document($id)
    {

        $this->db->join('surat_jenis b', 'a.id_surat=b.id_surat_jenis', 'inner');
        $this->db->where('id_pengajuan', $id);
        $dataSurat = $this->db->get('pengajuan_surat a')->row();
        if (!$dataSurat) {
            echo '<script>
            alert("404!!!. Data Tidak Ditemukan.");
            window.location.href = "' . base_url("panel-user/surat") . '"; // Ganti "halaman_tujuan.php" dengan URL halaman yang ingin Anda tuju
        </script>';
            exit;
        }
        $dataPenduduk = $this->db->get_where('penduduk', ['id_penduduk' => $dataSurat->id_penduduk])->row();
        $fieldData = json_decode($dataSurat->data_surat);

        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Your Name');
        $this->pdf->SetTitle('Sample');
        $this->pdf->SetSubject('Document Subject');
        $this->pdf->SetKeywords('Keywords, PDF, Example');

        $this->pdf->setPrintHeader(false);
        $this->pdf->setPrintFooter(false);
        // $this->pdf->setPageOrientation('P');
        // $this->pdf->setPageUnit('mm');
        $this->pdf->setMargins(20, 10, 20);
        $this->pdf->AddPage();

        $this->pdf->SetFont('helvetica', '', 12);

        $this->Kopsurat();

        $this->Typesurat($dataSurat);
        if ($dataSurat->id_surat_jenis == 1) {
            $this->contenBodysku($dataSurat, $dataPenduduk, $fieldData);
        } elseif ($dataSurat->id_surat_jenis == 2) {
            $this->contenBodyskk($dataSurat, $dataPenduduk, $fieldData);
        } elseif ($dataSurat->id_surat_jenis == 3) {
            $this->contentBodyskl($dataSurat, $dataPenduduk, $fieldData);
        } elseif ($dataSurat->id_surat_jenis == 5) {
            $this->contenBodysktm($dataSurat, $dataPenduduk, $fieldData);
        } elseif ($dataSurat->id_surat_jenis == 6) {
            $this->contenBodyskt($dataSurat, $dataPenduduk, $fieldData);
        } else {
            $this->pdf->Cell(0, 5, 'Template belum di buat atau disetting :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        }



        // $this->pdf->Signatur($dataSurat);
        $file_path = FCPATH . './document/' . 'nama_dokumen.pdf';

        $this->pdf->Output('sample.pdf', 'I');

        exit;
    }

    function contenBodysku($dataSurat, $dataPenduduk, $fieldData)
    {
        $this->pdf->Cell(0, 5, 'Yang bertanda tangan dibwah ini :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Jabatan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kepala Desa Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->Cell(0, 5, 'Dengan ini menerangkan bahwa :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $dataPenduduk->nama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Jenis Kelamin', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . ($dataPenduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'), 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $tanggal_format = $this->format_tanggal->format_tanggal($dataPenduduk->tgl_lahir);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Tempat/Tgl Lahir', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $dataPenduduk->tempat_lahir . ', ' . $tanggal_format, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Bangsa/Agama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $dataPenduduk->bangsa . '/' . $dataPenduduk->agama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pekerjaan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $dataPenduduk->pekerjaan, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Alamat', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $dataPenduduk->alamat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'No.KTP/NIK', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $dataPenduduk->no_ktp_nik, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(5);
        $html = '<p style="text-align: justify; text-indent: 45px;">&emsp;Menurut data yang diperoleh serta keterangan yang bersangkutan di atas benar memiliki usaha di Desa Kumantan Kecamatan Bangkinang Kota, dan benar bahwa ianya mempunyai usaha:</p>';
        $this->pdf->writeHTML($html, true, false, true, false, 'J');
        $this->pdf->Ln(2);
        $this->pdf->SetFont('times', 'U', 12);
        $this->pdf->Cell(0, 5, $fieldData->namausaha, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(0, 5, 'Alamat Usaha : ' . $fieldData->alamatusaha, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(2);
        $this->pdf->Cell(0, 5, 'Surat ini dipergunakan untuk :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(2);
        $this->pdf->SetFont('times', 'U', 12);
        $this->pdf->Cell(0, 5, $fieldData->kepentingansurat, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(2);
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(0, 5, 'Demikian surat keterangan ini kami keluarkan untuk dapat dipergunakan seperlunya.', 0, 1, 'L', 0, '', 0, false, 'T', 'M');


        $tanggal_surat = $this->format_tanggal->format_tanggal($dataSurat->tanggal_signatur);
        $this->pdf->Ln(10);
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Di Keluarkan di', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pada Tanggal', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $tanggal_surat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'KEPALA DESA KUMANTAN', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->SetLineWidth(0.5);
        $this->pdf->Line(131, 213, 215 - 15, 213);
        $this->pdf->SetFont('times', 'BU', 14);

        $this->pdf->Ln(32);
        $this->pdf->SetFont('times', 'BU', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'NIPD : 234234343545', 0, 0, 'L', 0, '', 0, false, 'T', 'M');

        $style = array(
            'border' => FALSE,
            'padding' => 5,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        );
        $this->pdf->write2DBarcode($dataSurat->signatur_kode, 'QRCODE,H', 130, 214, 40, 40, $style, 'N');
    }

    function contenBodyskk($dataSurat, $dataPenduduk, $fieldData)
    {
        $this->pdf->Cell(0, 5, 'Yang bertanda tangan dibwah ini :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Jabatan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kepala Desa Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->Cell(0, 5, 'Dengan ini menerangkan bahwa :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->nama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Jenis Kelamin', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . ($fieldData->jeniskelamin == 'L' ? 'Laki-laki' : 'Perempuan'), 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $tanggal_format = $this->format_tanggal->format_tanggal($fieldData->tanggallahir);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Tempat/Tgl Lahir', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->tempatlahir . ',' . $tanggal_format, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Bangsa/Agama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->bangsa . '/' . $fieldData->agama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pekerjaan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->pekerjaan, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Alamat Terakhir', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->alamatterakhir, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'No.NIK', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->nonik, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(5);
        $html = '<p style="text-align: justify;">Nama yang tersebut diatas adalah benar Penduduk Desa Kumantan Kec.Bangkinang Kota Kabupaten Kampar dan benar telah Meninggal Dunia pada Hari ' . $this->format_tanggal->hari($fieldData->tanggalmeninggal) . ' Tanggal ' . $this->format_tanggal->format_tanggal($fieldData->tanggalmeninggal) . ' di ' . $fieldData->lokasimeninggal . ' karena ' . $fieldData->penyebabmeninggal . '</p>';
        $this->pdf->writeHTML($html, true, false, true, true, 'J');
        $html2 = '<p style="text-align: justify;>Demikian Surat Keterangan ini kami buat untuk dapat dipergunakan seperlunya.</p>';
        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, 'Demikian Surat Keterangan ini kami buat untuk dapat dipergunakan seperlunya.', 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $tanggal_surat = $this->format_tanggal->format_tanggal($dataSurat->tanggal_signatur);
        $this->pdf->Ln(10);
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Di Keluarkan di', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pada Tanggal', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $tanggal_surat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'KEPALA DESA KUMANTAN', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->SetLineWidth(0.5);
        $this->pdf->Line(131, 194.5, 210 - 10, 194.5);
        $this->pdf->SetFont('times', 'BU', 14);

        $this->pdf->Ln(32);
        $this->pdf->SetFont('times', 'BU', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'NIPD : 234234343545', 0, 0, 'L', 0, '', 0, false, 'T', 'M');

        $style = array(
            'border' => FALSE,
            'padding' => 5,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        );
        $this->pdf->write2DBarcode($dataSurat->signatur_kode, 'QRCODE,H', 130, 195, 40, 40, $style, 'N');
    }

    function contentBodyskl($dataSurat, $dataPenduduk, $fieldData)
    {
        $html = '<p style="text-align: justify; text-indent: 45px;">&emsp;Yang bertanda tangan di bawah ini Kepala Desa Kumantan Kec. Bangkinang Kota   Kab. Kampar dengan ini menerangkan bahwa pada :</p>';
        $this->pdf->writeHTML($html, true, false, true, false, 'J');
        $this->pdf->Ln(5);

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Pada Tanggal', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . date('d-m-Y', strtotime($fieldData->tangallahir)), 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Tempat', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->tempatlahir, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Telah lahir seorang anak', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->jeniskelamin, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Yang diberi nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->namaanak, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Alamat', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->alamat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'No KTP/NIK', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->noktpnik, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, 'Nama yang tersebut di atas adalah benar anak kandung dari pernikahan  seorang .', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(2);
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->Cell(0, 5, 'Laki - Laki :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(5);
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->namaortupria, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Tpt/Tgl.Lahir', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->tempatlahirortupria . ', ' . date('d-m-Y', strtotime($fieldData->tanggallahirortupria)), 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Bangsa/Agama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->bangsaortupria . '/' . $fieldData->agamaortupria, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Pekerjaan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->pekerjaanortupria, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Alamat', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->alamatortupria, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'No.KTP/NO.NIK', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->nonikortupria, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, 'Dengan seorang Wanita	:', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->namaortuwanita, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Tpt/Tgl.Lahir', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->tempatlahirortuwanita . ', ' . date('d-m-Y', strtotime($fieldData->tangallahirortuwanita)), 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Bangsa/Agama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->bangsaortuwanita . '/' . $fieldData->agamaortuwanita, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Pekerjaan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->pekerjaanortuwanita, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'Alamat', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->alamatortuwanita, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(45, 5, 'No.KTP/NO.NIK', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->nonikortuwanita, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(5);
        $html = '<p style="text-align: justify;text-indent: 35px;">Demikian surat keterangan ini kami buat dengan sebenarnya untuk dapat di pergunakan seperlunya.</p>';
        $this->pdf->writeHTML($html, true, false, true, true, 'J');

        $tanggal_surat = $this->format_tanggal->format_tanggal($dataSurat->tanggal_signatur);
        $this->pdf->Ln(10);
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Di Keluarkan di', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pada Tanggal', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $tanggal_surat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'KEPALA DESA KUMANTAN', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->SetLineWidth(0.5);
        $this->pdf->Line(131, 254.5, 210 - 10, 254.5);
        $this->pdf->SetFont('times', 'BU', 14);

        $this->pdf->Ln(32);
        $this->pdf->SetFont('times', 'BU', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'NIPD : 234234343545', 0, 0, 'L', 0, '', 0, false, 'T', 'M');

        $style = array(
            'border' => FALSE,
            'padding' => 5,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        );
        $this->pdf->write2DBarcode($dataSurat->signatur_kode, 'QRCODE,H', 130, 255, 40, 40, $style, 'N');
    }

    public function contenBodysktm($dataSurat, $dataPenduduk, $fieldData)
    {
        $this->pdf->Cell(0, 5, 'Yang bertanda tangan dibwah ini :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Jabatan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kepala Desa Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->Cell(0, 5, 'Dengan ini menerangkan bahwa :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->nama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Jenis Kelamin', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . ($fieldData->jeniskelamin == 'L' ? 'Laki-laki' : 'Perempuan'), 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $tanggal_format = $this->format_tanggal->format_tanggal($fieldData->tanggallahir);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Tempat/Tgl Lahir', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->tempatlahir . ',' . $tanggal_format, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Bangsa/Agama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->bangsa . '/' . $fieldData->agama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pekerjaan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->pekerjaan, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'No.NIK', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->nonik, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(5);
        $html = '<p style="text-align: justify; text-indent: 45px;">&emsp;Nama yang tersebut di atas adalah Penduduk Desa Kumantan Kecamatan Bangkinang Kota Kabupaten Kampar menurut keterangan yang bersangkutan serta data – data yang diperdapat ianya benar tergolong kepada tidak mampu.</p>';
        $this->pdf->writeHTML($html, true, false, true, false, 'J');
        $this->pdf->Ln(2);
        $html = '<p style="text-align: justify; text-indent: 45px;">&emsp;Surat keterangan ini dipergunakan untuk :</p>';
        $this->pdf->writeHTML($html, true, false, true, false, 'J');
        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, $fieldData->kegunaansurat, 0, 3, 'C', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, 'Demikian surat keterangan ini kami keluarkan untuk dapat dipergunakan seperlunya.', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $tanggal_surat = $this->format_tanggal->format_tanggal($dataSurat->tanggal_signatur);
        $this->pdf->Ln(10);
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Di Keluarkan di', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pada Tanggal', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $tanggal_surat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'KEPALA DESA KUMANTAN', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->SetLineWidth(0.5);
        $this->pdf->Line(131, 206.5, 215 - 20, 206.5);
        $this->pdf->SetFont('times', 'BU', 14);

        $this->pdf->Ln(32);
        $this->pdf->SetFont('times', 'BU', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'NIPD : 234234343545', 0, 0, 'L', 0, '', 0, false, 'T', 'M');

        $style = array(
            'border' => FALSE,
            'padding' => 5,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        );
        $this->pdf->write2DBarcode($dataSurat->signatur_kode, 'QRCODE,H', 130, 207, 40, 40, $style, 'N');
    }

    public function contenBodyskt($dataSurat, $dataPenduduk, $fieldData)
    {
        $this->pdf->Cell(0, 5, 'Yang bertanda tangan dibwah ini :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Jabatan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kepala Desa Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->Cell(0, 5, 'Dengan ini menerangkan bahwa :', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Nama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->nama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Jenis Kelamin', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . ($fieldData->jeniskelamin == 'L' ? 'Laki-laki' : 'Perempuan'), 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $tanggal_format = $this->format_tanggal->format_tanggal($fieldData->tanggallahir);
        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Tempat/Tgl Lahir', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->tempatlahir . ',' . $tanggal_format, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Bangsa/Agama', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->bangsa . '/' . $fieldData->agama, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pekerjaan', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->pekerjaan, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Cell(15, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'No.NIK', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $fieldData->nonik, 0, 1, 'L', 0, '', 0, false, 'T', 'M');

        $this->pdf->Ln(5);
        $html = 'Nama yang tersebut diatas adalah benar adalah Penduduk Desa Kumantan Kecamatan Bangkinang Kota  Kabupaten Kampar, menurut keterangan yang bersangkutan serta berdasarkan data – data yang diperdapat benar yang bersangkutan tidak bekerja sebagai Pegawai Negeri Sipil ( PNS ). ';
        $this->pdf->writeHTML($html, true, false, true, false, 'J');
        $this->pdf->Ln(2);
        $html = 'Surat Keterangan ini diberikan untuk persyaratan mendapatkan bantuan :';
        $this->pdf->writeHTML($html, true, false, true, false, 'J');
        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, $fieldData->kegunaansurat, 0, 3, 'C', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);
        $this->pdf->Cell(0, 5, 'Demikian surat keterangan ini kami keluarkan untuk dapat dipergunakan seperlunya.', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $tanggal_surat = $this->format_tanggal->format_tanggal($dataSurat->tanggal_signatur);
        $this->pdf->Ln(10);
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Di Keluarkan di', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': Kumantan', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(35, 5, 'Pada Tanggal', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, ': ' . $tanggal_surat, 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', 'B', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'KEPALA DESA KUMANTAN', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Ln(5);

        $this->pdf->SetLineWidth(0.5);
        $this->pdf->Line(131, 206.5, 215 - 20, 206.5);
        $this->pdf->SetFont('times', 'BU', 14);

        $this->pdf->Ln(32);
        $this->pdf->SetFont('times', 'BU', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'MASRI DALMI, S.Sos', 0, 1, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->SetFont('times', '', 12);
        $this->pdf->Cell(110, 5, '', 0, 0, 'L', 0, '', 0, false, 'T', 'M');
        $this->pdf->Cell(0, 5, 'NIPD : 234234343545', 0, 0, 'L', 0, '', 0, false, 'T', 'M');

        $style = array(
            'border' => FALSE,
            'padding' => 5,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        );
        $this->pdf->write2DBarcode($dataSurat->signatur_kode, 'QRCODE,H', 130, 207, 40, 40, $style, 'N');
    }
    function formated()
    {
        include APPPATH . 'third_party/PHPrtflite/PHPRtfLite.php';

        $rtfFilePath = '/document/sk_usaha.rtf';

        // Create a new RTF parser
        PHPRtfLite::registerAutoloader();
        $rtf = new PHPRtfLite();
        $rtf->loadFile($rtfFilePath);

        // Convert RTF content to HTML
        $html = $rtf->getContentAsText();

        // Output the HTML content
        echo $html;

        // $this->db->where('id', 5);
        // $dataSurat = $this->db->get('data_berita')->row();

        // $this->pdf->SetCreator(PDF_CREATOR);
        // $this->pdf->SetAuthor('Your Name');
        // $this->pdf->SetTitle('Sample');
        // $this->pdf->SetSubject('Document Subject');
        // $this->pdf->SetKeywords('Keywords, PDF, Example');

        // $this->pdf->setPrintHeader(false);
        // $this->pdf->setPrintFooter(false);
        // // $this->pdf->setPageOrientation('P');
        // // $this->pdf->setPageUnit('mm');
        // $this->pdf->setMargins(20, 10, 20);
        // $this->pdf->AddPage();

        // $this->pdf->SetFont('helvetica', '', 12);
        // $html = '<h1>Hello, TCPDF!</h1>
        //     <p>This is an example of writing HTML-like content in TCPDF.</p>';

        // $newString= str_ireplace('#tahun','2023',$dataSurat->content);
        // $this->pdf->writeHTML( $newString, false, false, true, false, '');

        // // Output the PDF as a file (download)
        // $this->pdf->Output('sample.pdf', 'I');

        // exit;
    }
}

/* End of file File.php and path \application\controllers\admin\File.php */
