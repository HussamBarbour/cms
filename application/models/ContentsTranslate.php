<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ContentsTranslate extends CI_Model {

    protected $table = 'contents_translate';

    public function getByContent($content_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->order_by('rank', 'ASC');
        $this->db->where('content_id', $content_id);
        $query = $this->db->get();
        $result = $query->result();
    }

    public function getByContentLang($content_id, $language) {
        $query = $this->db->get_where($this->table, array('content_id' => $content_id, 'language' => $language));
        $result = $query->row();
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

    public function updateLangShort($old_short,$short) {
        $data['language'] = $short;
        $query = $this->db->update($this->table, $data, "language ='" . $old_short ."'");
        return $query;
    }

}
