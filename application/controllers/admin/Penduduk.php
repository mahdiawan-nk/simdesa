<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Penduduk extends CI_Controller
{

    protected $path_view;
    protected $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Penduduk_model', 'pddk');
        $this->load->library('excel');


        $this->path_view = (object) [
            'view' => 'admins/penduduk/view',
            'create' => 'admins/penduduk/add',
            'edit' => 'admins/penduduk/edit'
        ];
    }

    public function index()
    {
        $this->db->where('hapus', 0);
        $dataHalaman = $this->pddk->read()->result();

        $this->data['data'] = $dataHalaman;
        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
        // $this->output->set_content_type('application/json')->set_output(json_encode($this->data));

    }

    public function save()
    {
        $dataPost = $this->input->post();
        $insert = $this->pddk->create($dataPost);

        if ($insert) {
            redirect(base_url('panel-admin/penduduk'), 'refresh');
        } else {
            // redirect(base_url('panel-admin/penduduk'), 'refresh');
            $this->output->set_content_type('application/json')->set_output(json_encode($dataPost));
            
        }
    }

    public function update($id)
    {
        $dataPost = $this->input->post();
        $update = $this->pddk->update($id,$dataPost);

        if ($update) {
            redirect(base_url('panel-admin/penduduk'), 'refresh');
        } else {
            // redirect(base_url('panel-admin/penduduk'), 'refresh');
            $this->output->set_content_type('application/json')->set_output(json_encode($dataPost));
            
        }
    }

    public function delete($id)
    {
        $update = $this->pddk->update($id,['hapus'=>1]);

        if ($update) {
            redirect(base_url('panel-admin/penduduk'), 'refresh');
        } else {
            // redirect(base_url('panel-admin/penduduk'), 'refresh');
            $this->output->set_content_type('application/json')->set_output(json_encode($dataPost));
            
        }
    }

    public function importexcel()
    {
        if (isset($_FILES["file"]["name"])) {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach ($object->getWorksheetIterator() as $worksheet) {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for ($row = 2; $row <= $highestRow; $row++) {
                    $nik = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $jenis_kelamin = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $tmp_lahir = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tgl_lahir = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $bangsa = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $agama = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $pekerjaan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $temp_data[] = array(
                        'nama'    => $nama,
                        'jenis_kelamin'    => $jenis_kelamin,
                        'tempat_lahir'    => $tmp_lahir,
                        'tgl_lahir'    => $tgl_lahir,
                        'bangsa'    => $bangsa,
                        'pekerjaan'    => $pekerjaan,
                        'alamat'    => $alamat,
                        'no_ktp_nik'    => $nik,
                        'agama'    => $agama,
                    );
                }
            }

            // $this->output->set_content_type('application/json')->set_output(json_encode($temp_data));

            $insert = $this->pddk->create($temp_data, true);
            if ($insert) {
                redirect(base_url('panel-admin/penduduk'), 'refresh');
            } else {
                redirect(base_url('panel-admin/penduduk'), 'refresh');
            }
        } else {
            echo "Tidak ada file yang masuk";
        }
    }
}

/* End of file Penduduk.php and path \application\controllers\admin\Penduduk.php */
