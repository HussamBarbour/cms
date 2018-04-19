<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menus extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->_lang = $this->config->item('language');
        $this->load->model('MenusModel');
        $this->load->model('Language');
        $this->data['lang'] = $this->_lang;
        $this->data['languages'] = $this->Language->getAll();
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->data['parent_active'] = 'menus';
        $this->data['sub_active'] = 'menus';
    }

    public function index() {
        $this->load->helper('form');
        $this->data['contents'] = $this->Contents->getAll();
        $this->data['all_links'] = $this->MenusModel->getAll('top');
        $this->data['t_links'] = $this->MenusModel->getMenu('top');
        $this->data['h_links'] = $this->MenusModel->getMenu('header');
        $this->data['f_links'] = $this->MenusModel->getMenu('footer');
        $this->load->view('admin/menus', $this->data);
    }

    public function insert() {
        $this->load->helper('security');
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        $this->MenusModel->insert($data);
        back();
    }

    public function update($id) {
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }
        $this->MenusModel->update($id,$data);
        back();
    }

    public function updateRank() {
        foreach ($_POST['m_rank'] as $key => $value) {
            $data['m_rank'] = $value;
            $this->MenusModel->update($key,$data);
        }
        back();
    }
    public function delete($id) {
        $this->MenusModel->delete($id);
        back();
    }

}
