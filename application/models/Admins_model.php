<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admins_model extends CI_Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';

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
    public function checkEmail($email)
    {

        $this->db->where('email', $email);
        return $this->db->get($this->table)->row();
    }

    public function checkPassword($password)
    {
        $this->db->where('password', md5($password));
        return $this->db->get($this->table)->row();
    }
}


/* End of file Admins_model.php and path \application\models\Admins_model.php */
