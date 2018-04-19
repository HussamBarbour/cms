<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->_lang = $this->config->item('language');
        $this->load->model('CommentsModel');
        $this->data['lang'] = $this->_lang;
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->data['parent_active'] = 'comments';
        $this->data['sub_active'] = 'comments';
    }

    public function index() {
        $this->data['comments'] = $this->CommentsModel->getByStatus();
        $this->load->view('admin/comments', $this->data);
    }

    public function publish() {
        $this->CommentsModel->updateStatus(1);
        back();
    }
    
    public function delete($id) {
        $this->CommentsModel->delete($id);
        back();
    }

}
