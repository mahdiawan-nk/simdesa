<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    protected $table = 'berita_kategori';

    public function __construct()
    {
        parent::__construct();
    }

    public function read($id=false)
    {
        if($id){
            $this->db->where('id_kategori', $id);
        }
        return $this->db->get($this->table);;
    }

   public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($key,$data){
        return $this->db->update($this->table, $data,['id_kategori'=>$key]);
        
    }

    public function delete($key){
        return $this->db->delete($this->table,['id_kategori'=>$key]);
        
    }

    public function countdataBerita()
    {
        $this->db->select('*');
        $this->db->select('(SELECT COUNT(b.kategori_id) FROM data_berita b WHERE a.id_kategori=b.kategori_id)as jml');
        $this->db->from('berita_kategori a');
        return $this->db->get();
    }
}

/* End of file Berita_model.php and path \application\models\admin\Berita_model.php */
