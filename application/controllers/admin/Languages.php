<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Languages extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->load->model('Language');
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
    }

    public function index() {
        $this->_lang = $this->config->item('language');
        $this->data['lang'] = $this->_lang;
        $this->data['languages'] = $this->Language->getAll();
        $this->data['parent_active'] = 'settings';
        $this->data['sub_active'] = 'languages';
        $this->load->view('admin/settings/languages', $this->data);
    }

    public function update() {
        foreach ($_POST as $key => $value) {
            $check = $this->Language->getByShort($value['short']);
            if (is_object($check)) {
                continue;
            }
            $data['rank'] = $value['rank'];
            $data['name'] = $value['name'];
            $data['short'] = $value['short'];
            $this->Language->update($key, $data);
            $this->ContentsTranslate->updateLangShort($value['old_short'],$value['short']);
        }
        back();
    }

    public function insert() {
        $data['rank'] = $_POST['rank'];
        $data['name'] = $_POST['name'];
        $data['short'] = $_POST['short'];
        $this->Language->insert($data);
        back();
    }
    public function delete($id) {
        $this->Language->delete($id);
        back();
    }

}
