<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommentsModel extends CI_Model{
    protected $table = 'comments';

    public function getByStatus($status = 0)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('status', $status);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function getLast($limit = 10)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->limit($limit);
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', 1);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function getByContent($content_id,$status = 1)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('content_id', $content_id);
        $this->db->where('status', $status);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function getTotal($content_id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('content_id', $content_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }
    
    public function insert($data)
    {
        $query = $this->db->insert($this->table, $data);
        return $query;
    }
    
    
    public function updateStatus($status = 1)
    {
        $data['status'] = $status;
        $query = $this->db->update($this->table, $data);
        return $query;
    }
    
    public function delete($id)
    {
        $query = $this->db->delete($this->table, array('id' => $id));
        return $query;
    }
}
