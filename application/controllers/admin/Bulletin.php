<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bulletin extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->_lang = $this->config->item('language');
        $this->load->model('EmailsModel');
        $this->data['lang'] = $this->_lang;
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->data['parent_active'] = 'contact';
        $this->data['sub_active'] = 'bulletin';
    }

    public function index() {
        $this->data['bulletin'] = $this->EmailsModel->getAll();
        $this->load->view('admin/bulletin', $this->data);
    }
    
    public function delete() {
        $id = $_POST['id'];
        $this->EmailsModel->delete($id);
        back();
    }

}
