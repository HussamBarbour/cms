<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MessagesModel extends CI_Model{
    protected $table = 'messages';

    public function getAll($type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('type', $type);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function insert($data)
    {
        $query = $this->db->insert($this->table, $data);
        return $query;
    }
    
    public function total($id)
    {
        $this->db->where('status', '0');
        $query = $this->db->get($this->table);
        $result = $query->num_rows();
        return $result;
    }
    
    public function read()
    {
        $data['status'] = 1;
        $query = $this->db->update($this->table, $data);
        return $query;
    }
    
    public function delete($id)
    {
        $query = $this->db->delete($this->table, array('id' => $id));
        return $query;
    }
}
