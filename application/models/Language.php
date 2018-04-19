<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Model{
    protected $table = 'languages';

    public function getAll()
    {
        $this->db->order_by('rank','ASC');
        $query = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
    
    public function getByShort($short)
    {
        $this->db->select('short');
        $this->db->from($this->table);
        $this->db->where('short', $short);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    
    public function update($id,$data)
    {
        $query = $this->db->update($this->table, $data,"id =".$id);
        return $query;
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
