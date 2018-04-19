<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContentTypeModel extends CI_Model{
    protected $table = 'content_types';

    public function getAll()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function getByType($type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('type', $type);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    
    public function insert($data)
    {
        $query = $this->db->insert($this->table, $data);
        return $query;
    }
    public function update($id, $data) {
        $query = $this->db->update($this->table, $data, "id =" . $id);
        return $query;
    }
    
    
    public function delete($id)
    {
        $query = $this->db->delete($this->table, array('id' => $id));
        return $query;
    }
}
