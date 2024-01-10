<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Templatesurat extends CI_Controller
{

    protected $path_view;
    protected $data = [];
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/Suratjenis_model', 'jsurat');

        $this->path_view = (object) [
            'view' => 'admins/surat_jenis/listmeta',
            'create' => 'admins/surat_jenis/add',
            'edit' => 'admins/surat_jenis/edit'
        ];
    }

    public function setting($id)
    {
        $metada = $this->db->get_where('metadata_surat', ['id_jenis_surat' => $id])->row();
        $this->data['detail'] = $this->jsurat->read($id)->row();

        if ($metada && $metada->fields !== 'null') {
            $this->data['idmeta'] = $id;
            $this->data['data'] = json_decode($metada->fields);
        } else {
            $this->data['idmeta'] = $id;
            $this->data['data'] = [];
        }

        $this->data['pages'] = $this->path_view->view;
        $this->load->view('admins/index', $this->data);
        // $this->output->set_content_type('application/json')->set_output(json_encode($this->data));

    }

    protected function samplefield()
    {

        $data = [];

        return $data;
    }

    public function create($id)
    {
        $metada = $this->db->get_where('metadata_surat', ['id_jenis_surat' => $id])->row();
        $datas = $this->input->post();
        $datas['required'] = $this->input->post('required') == 'false' ? false : true;
        if ($this->input->post('options') == 'false') {
            $datas['options'] = false;
        } else {
            $options = explode(',', $datas['options']);
            $datas['options'] = $options;
        }
        if ($metada) {
            $array_data = json_decode($metada->fields, true);

            $array_data[] = $datas;
            $new_json_data = json_encode($array_data);

            $this->db->where('id_jenis_surat', $id);
            $result = $this->db->update('metadata_surat', ['fields' => $new_json_data]);
        } else {

            $new_json_data = json_encode([$datas]);

            $result = $this->db->insert('metadata_surat', ['id_jenis_surat' => $id, 'fields' => $new_json_data]);
        }


        redirect(base_url('panel-admin/templatesurat/' . $id), 'refresh');
    }

    public function update($id)
    {
        $metada = $this->db->get_where('metadata_surat', ['id_jenis_surat' => $id])->row();

        $array_data = json_decode($metada->fields, true);
        $datas = $this->input->post();
        unset($datas['oldlabel']);
        $datas['required'] = $this->input->post('required') == 'false' ? false : true;
        if ($this->input->post('options') == 'false') {
            $datas['options'] = false;
        } else {
            $options = explode(',', $datas['options']);
            $datas['options'] = $options;
        }

        foreach ($array_data as $key => $data) {
            if ($data['label'] === $this->input->post('oldlabel')) {
                $array_data[$key] = $datas;
                break; // Keluar dari loop setelah data ditemukan
            }
        }

        $new_json_data = json_encode($array_data);

        $this->db->where('id_jenis_surat', $id);
        $result = $this->db->update('metadata_surat', ['fields' => $new_json_data]);

        redirect(base_url('panel-admin/templatesurat/' . $id), 'refresh');
    }
    public function delete($id)
    {
        $metada = $this->db->get_where('metadata_surat', ['id_jenis_surat' => $id])->row();

        $array_data = json_decode($metada->fields, true);
        // Label data yang ingin dihapus (misalnya, kita ingin menghapus data dengan label "Jenis Kelamin")
        $labelToDelete = $this->input->post('label');;

        // Mencari dan menghapus data dari array
        foreach ($array_data as $key => $data) {
            if ($data['label'] === $labelToDelete) {
                unset($array_data[$key]); // Menghapus data dari array
                break; // Keluar dari loop setelah data ditemukan dan dihapus
            }
        }
        $new_json_data = json_encode($array_data);

        $this->db->where('id_jenis_surat', $id);
        $result = $this->db->update('metadata_surat', ['fields' => $new_json_data]);

        redirect(base_url('panel-admin/templatesurat/' . $id), 'refresh');
    }

    public function format($id)
    {
        $metada = $this->db->get_where('surat_layout', ['id_surat' => $id])->row();
        $this->data['detail'] = $this->jsurat->read($id)->row();

        if ($metada && $metada->data_layout !== 'null') {
            $this->data['idmeta'] = $id;
            $this->data['data'] = json_decode($metada->data_layout);
        } else {
            $this->data['idmeta'] = $id;
            $this->data['data'] = [];
        }

        $this->data['pages'] = 'admins/surat_jenis/format';
        $this->load->view('admins/index', $this->data);
    }
}

/* End of file TemplateSurat.php and path \application\controllers\admin\TemplateSurat.php */
