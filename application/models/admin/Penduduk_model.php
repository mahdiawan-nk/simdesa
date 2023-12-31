<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penduduk_model extends CI_Model
{
    protected $table = 'penduduk';
    protected $primaryKey = 'id_penduduk';

    public function __construct()
    {
        parent::__construct();
    }

    public function read($id = false)
    {
        if ($id) {
            $this->db->where($this->primaryKey, $id);
        }
        return $this->db->get($this->table);;
    }

    public function create($data,$batch=false)
    {
        if($batch){
            return $this->db->insert_batch($this->table, $data);
        }else{
            return $this->db->insert($this->table, $data);
        }
        
    }

    public function update($key, $data)
    {
        return $this->db->update($this->table, $data, [$this->primaryKey => $key]);
    }

    public function delete($key)
    {
        return $this->db->delete($this->table, [$this->primaryKey => $key]);
    }
}


/* End of file Penduduk_model.php and path \application\models\admin\Penduduk_model.php */
