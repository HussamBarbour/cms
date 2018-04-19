<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DonationCartModel extends CI_Model{
    protected $table = 'donation_cart';
    
    public function insert($data)
    {
        $query = $this->db->insert($this->table, $data);
        return $query;
    }
    public function update($id, $data) {
        $query = $this->db->update($this->table, $data, "id =" . $id);
        return $query;
    }
    public function getBySession($session)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('session', $session);
        $this->db->order_by('timestamp', 'ASC');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function getBySessionProject($session,$project_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('session', $session);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }
    
    public function delete($id,$session)
    {
        $query = $this->db->delete($this->table, array('id' => $id,'session' => $session));
        return $query;
    }
    
    
    
    
    public function getAll()
    {
        $query = $this->db->get($this->table);
        $result = $query->result();
        return $result;
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
}
