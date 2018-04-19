<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FormsModel extends CI_Model{
    protected $table = 'forms';
    protected $data_table = 'forms_data';

    public function getAll($type)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('form_type', $type);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function insert($form,$data)
    {
        $query = $this->db->insert($this->table, $form);
        $last_insert_id = $this->db->insert_id();
        
        foreach ($data as $key => $value) {
            $data = array();
            $data['form_id'] = $last_insert_id;
            $data['form_data_key'] = $key;
            $data['form_data_value'] = $value;
            $this->db->insert($this->data_table, $data);
        }
        return $query;
    }
    public function getValue($id,$key)
    {
        $this->db->select('*');
        $this->db->from($this->data_table);
        $this->db->where('form_id', $id);
        $this->db->where('form_data_key', $key);
        $query = $this->db->get();
        $result = $query->row();
        $value = isset($result->form_data_value) ? $result->form_data_value : '';
        return $value;
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
        $this->db->delete($this->data_table, array('form_id' => $id));
        $query = $this->db->delete($this->table, array('id' => $id));
        return $query;
    }
}
