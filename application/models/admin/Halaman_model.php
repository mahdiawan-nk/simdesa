<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Halaman_model extends CI_Model 
{
    protected $table = 'halaman';
    protected $primaryKey = 'id_halaman';
    protected $indexKey = 'id_menu';

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

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
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


/* End of file Halaman_model.php and path \application\models\admins\Halaman_model.php */
