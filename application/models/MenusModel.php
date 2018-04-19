<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenusModel extends CI_Model{
    protected $table = 'menus';
    
    public function getAll()
    {
        $query = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
    public function getMenu($place)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('m_place', $place);
        $this->db->order_by('m_rank','ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function insert($data)
    {
        $query = $this->db->insert($this->table, $data);
        $this->last_insert_id = $this->db->insert_id();
        return $query;
    }
    public function update($id,$data)
    {
        $query = $this->db->update($this->table, $data,"m_id =".$id);
        return $query;
    }
    public function delete($id)
    {
        $query = $this->db->delete($this->table, array('m_id' => $id));
        return $query;
    }
}
