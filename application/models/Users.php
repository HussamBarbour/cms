<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Users extends CI_Model{
    protected $table = 'users';
    
    public function checkUser($username,$password) {
        $query = $this->db->get_where($this->table, array('username' => $username,'password'=>$password));
        $result = $query->row();
        return $result;
    }
    public function checkUsermode($id,$mode) {
        $query = $this->db->get_where($this->table, array('id' => $id,'usermode'=>$mode));
        $result = $query->row();
        return $result;
    }
    public function getAdmin() {
        $query = $this->db->get_where($this->table, array('id' => 1));
        $result = $query->row();
        return $result;
    }

    public function update($id, $data) {
        $query = $this->db->update($this->table, $data, "id =" . $id);
        return $query;
    }
}
