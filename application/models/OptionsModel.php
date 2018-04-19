<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OptionsModel extends CI_Model {

    protected $table = 'options';

    public function getByName($name) {
        $this->db->select('option_value');
        $this->db->from($this->table);
        $this->db->where('option_name', $name);
        $query = $this->db->get();
        $result = $query->row();
        if ($result) {
            return $result->option_value;
        } else {
            return '';
        }
    }

    public function check($name) {
        $this->db->select('option_name');
        $this->db->from($this->table);
        $this->db->where('option_name', $name);
        $query = $this->db->get();
        $result = $query->num_rows();
        return $result;
    }

    public function update($option_name, $option_value) {
        $data['option_value'] = $option_value;
        $query = $this->db->update($this->table, $data, "option_name ='" . $option_name . "'");
        return $query;
    }

    public function insert($option_name, $option_value) {
        $data['option_name'] = $option_name;
        $data['option_value'] = $option_value;
        $query = $this->db->insert($this->table, $data);
        return $query;
    }

}
