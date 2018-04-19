<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GalleryModel extends CI_Model {

    protected $table = 'gallery';

    public function get() {
        $query = $this->db->get($this->table);
        $result = $query->result();
        return $result;
    }
    
    public function getByParent($id) {
        $query = $this->db->get_where($this->table, array('parent_id' => $id));
        $result = $query->result();
        return $result;
    }
    
    public function getByParentLimit($id,$limit = 12) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('parent_id', $id);
        $this->db->limit($limit);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function delete($id) {
        $query = $this->db->delete($this->table, array('id' => $id));
        return $query;
    }

    public function insert($data) {
        $query = $this->db->insert($this->table, $data);
        return $query;
    }

}
