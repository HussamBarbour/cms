<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ContentsMeta extends CI_Model {

    protected $table = 'contents_meta';
    
    public function getValue($id,$key,$lang='All')
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('post_id', $id);
        $this->db->where('meta_key', $key);
        $this->db->where('meta_lang', $lang);
        $query = $this->db->get();
        $result = $query->row();
        $value = isset($result->meta_value) ? $result->meta_value : '';
        return $value;
    }
    public function getKeyValues($key,$lang='All')
    {
        $this->db->select('meta_key, meta_value, meta_lang');
        $this->db->distinct();
        $this->db->from($this->table);
        $this->db->where('meta_key', $key);
        $this->db->where('meta_lang', $lang);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function insert($data) {
        $query = $this->db->insert($this->table, $data);
        return $query;
    }

    public function update($id, $data) {
        $query = $this->db->update($this->table, $data, "id =" . $id);
        return $query;
    }

    public function updateMeta($post_id, $key, $value) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('post_id', $post_id);
        $this->db->where('meta_key', $key);
        $query = $this->db->get();
        $result = $query->row();
        if (isset($result->meta_value)) {
            $this->db->set('meta_value', $value);
            $this->db->where('post_id', $post_id);
            $this->db->where('meta_key', $key);
            $query = $this->db->update($this->table);
        }else {
            $data['post_id'] = $post_id;
            $data['meta_key'] = $key;
            $data['meta_value'] = $value;
            $query = $this->db->insert($this->table, $data);
        }
        return $value;
    }

    public function delete($id)
    {
        $query = $this->db->delete($this->table, array('post_id' => $id));
        return $query;
    }

}
