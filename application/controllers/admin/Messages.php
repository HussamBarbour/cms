<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->_lang = $this->config->item('language');
        $this->load->model('FormsModel');
        $this->data['lang'] = $this->_lang;
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->data['parent_active'] = 'contact';
        $this->data['sub_active'] = 'messages';
    }

    public function index($type = 'contact') {
        $this->data['messages'] = $this->FormsModel->getAll($type);
        $this->data['type'] = $type;
        $this->load->view('admin/messages', $this->data);
    }

    public function delete() {
        $id = $_POST['id'];
        $this->FormsModel->delete($id);
        back();
    }

}
