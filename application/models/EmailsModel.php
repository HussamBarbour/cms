<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailsModel extends CI_Model{
    protected $table = 'emails';

    public function getAll()
    {
        $query = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
    
    public function insert($data)
    {
        $query = $this->db->insert($this->table, $data);
        return $query;
    }
    
    public function delete($id)
    {
        $query = $this->db->delete($this->table, array('id' => $id));
        return $query;
    }
}
