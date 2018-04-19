<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->_lang = $this->config->item('language');
        $this->load->model('StatisticsModel');
        $this->data['lang'] = $this->_lang;
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->data['parent_active'] = 'statistics';
        $this->data['sub_active'] = 'statistics';
    }

    public function index() {
        $this->data['statistics'] = $this->StatisticsModel->getAll();
        $this->load->view('admin/statistics', $this->data);
    }
    
    public function delete() {
        $id = $_POST['id'];
        $this->StatisticsModel->delete($id);
        back();
    }

}
