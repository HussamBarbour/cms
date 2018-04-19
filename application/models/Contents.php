<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contents extends CI_Model {

    protected $table = 'contents';
    public $_lang;
    protected $translate_table = 'contents_translate';
    protected $meta_table = 'contents_meta';
    public $last_insert_id;

    public function __construct() {
        $this->_lang = $this->config->item('language');
    }

    public function getAll($_content_type = 'All') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('rank', 'ASC');
        $this->db->where('language', $this->_lang);
        if ($_content_type != 'All')
            $this->db->where('content_type', $_content_type);
        $this->db->where('deleted_at', '0');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get() {
        $query = $this->db->get_where($this->table, array('deleted_at' => '0'));
        $result = $query->result();
        return $result;
    }

    public function getTrash($_content_type = 'page') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('rank', 'ASC');
        $this->db->where('language', $this->_lang);
        $this->db->where('content_type', $_content_type);
        $this->db->where('deleted_at !=', '0');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getById($id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->where('content_id', $id);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function getByContentParentType($type, $preant_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('rank', 'ASC');
        $this->db->where('language', $this->_lang);
        $this->db->where('content_type', $type);
        $this->db->where('parent_id', $preant_id);
        $this->db->where('deleted_at', '0');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getByContentType($type, $limit = 'no') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('rank', 'ASC');
        $this->db->where('language', $this->_lang);
        $this->db->where('content_type', $type);
        $this->db->order_by('parent_id', 'ASC');
        $this->db->where('deleted_at', '0');
        if ($limit != 'no') {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getUncategorized($_content_type = 'page') {
        $contents = $this->get();
        $parent_id[] = '';
        foreach ($contents as $content) {
            $parent_id[] = $content->id;
        }
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('rank', 'ASC');
        $this->db->where_not_in('parent_id', $parent_id);
        $this->db->where('language', $this->_lang);
        $this->db->where('content_type', $_content_type);
        $this->db->where('deleted_at', '0');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function insert($data) {
        $query = $this->db->insert($this->table, $data);
        $this->last_insert_id = $this->db->insert_id();
        return $query;
    }

    public function update($id, $data) {
        $query = $this->db->update($this->table, $data, "id =" . $id);
        return $query;
    }

    public function delete($id) {
        $query = $this->db->delete($this->translate_table, array('content_id' => $id));
        $query = $this->db->delete($this->table, array('id' => $id));
        return $query;
    }

    public function increment($id) {
        $this->db->set('readings', 'readings+1', FALSE);
        $this->db->where('id', $id);
        $query = $this->db->update($this->table);
        return $query;
    }

    public function getByShortcut($shortcut) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->where('shortcut', $shortcut);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function getByParent($parent = 0, $_content_type = 'page') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('rank', 'ASC');
        $this->db->order_by('content_id', 'ASC');
        $this->db->where('language', $this->_lang);
        $this->db->where('parent_id', $parent);
        $this->db->where('content_type', $_content_type);
        $this->db->where('deleted_at', '0');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getByMetaLike($meta_key, $meta_value, $_content_type = 'page') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->join($this->meta_table, $this->meta_table . '.post_id = ' . $this->table . '.id');
        $this->db->order_by('rank', 'ASC');
        $this->db->order_by('content_id', 'ASC');
        $this->db->where('meta_key', $meta_key);
        $this->db->like('meta_value', $meta_value);
        $this->db->where('language', $this->_lang);
        $this->db->where('content_type', $_content_type);
        $this->db->where('deleted_at', '0');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function total($parent_id) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('parent_id', $parent_id);
        $this->db->where('deleted_at', '0');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function totalType($type) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('content_type', $type);
        $this->db->where('deleted_at', '0');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getLast($content_type, $limit = 12) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('created_at', 'DESC');
        $this->db->where('language', $this->_lang);
        $this->db->where('content_type', $content_type);
        $this->db->where('deleted_at', '0');
        $this->db->limit($limit);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getPop($content_type, $limit) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('readings', 'DESC');
        $this->db->where('language', $this->_lang);
        $this->db->where('content_type', $content_type);
        $this->db->where('deleted_at', '0');
        $this->db->limit($limit);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function search($search) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->where('language', $this->_lang);
        $this->db->where('deleted_at', '0');
        $this->db->like('title', $search);
        $this->db->or_like('content', $search);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function tags($tags, $lang) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->where('language', $lang);
        $this->db->where('deleted_at', '0');
        $this->db->like('tags', $tags);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getPage($parent_id, $start = 0, $inpage = 24) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->order_by('rank', 'ASC');
        $this->db->where('language', $this->_lang);
        $this->db->where('parent_id', $parent_id);
        $this->db->where('deleted_at', '0');
        $this->db->limit($inpage, $start);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function nextPrev($id, $parent_id, $type = '>') {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join($this->translate_table, $this->translate_table . '.content_id = ' . $this->table . '.id');
        $this->db->where('language', $this->_lang);
        $this->db->where('deleted_at', '0');
        $this->db->where('parent_id', $parent_id);
        if ($type == '<') {
            $this->db->where('content_id <', $id);
            $this->db->order_by('content_id', 'DESC');
        } else {
            $this->db->where('content_id >', $id);
            $this->db->order_by('content_id', 'ASC');
        }
        $this->db->limit(1);
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

}
