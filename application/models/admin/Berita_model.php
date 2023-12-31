<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Berita_model extends CI_Model
{

    protected $table = 'data_berita';

    public function __construct()
    {
        parent::__construct();
    }

    public function read($id=false)
    {
        if($id){
            $this->db->where('id', $id);
        }
        return $this->db->get($this->table);;
    }

   public function create($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($key,$data){
        return $this->db->update($this->table, $data,['id'=>$key]);
        
    }

    public function delete($key){
        return $this->db->delete($this->table,['id'=>$key]);
        
    }
}

/* End of file Berita_model.php and path \application\models\admin\Berita_model.php */
