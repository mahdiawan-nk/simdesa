<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    protected $table = 'menu_sites';

    public function __construct()
    {
        parent::__construct();
    }

    public function read($id = false)
    {
        if ($id) {
            $this->db->where('id_menu', $id);
        }
        return $this->db->get($this->table);;
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($key, $data)
    {
        return $this->db->update($this->table, $data, ['id_menu' => $key]);
    }

    public function delete($key)
    {
        return $this->db->delete($this->table, ['id_menu' => $key]);
    }
}

/* End of file Menu_model.php */
