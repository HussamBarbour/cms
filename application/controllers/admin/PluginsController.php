<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PluginsController extends CI_Controller {
    public $data = array();

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->_lang = $this->config->item('language');
        $this->Contents->_lang = $this->_lang;
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->data['parent_active'] = 'plugins';
        $this->data['sub_active'] = 'plugins';
    }
    public function index() {
        $this->data['plugins'] = $this->plugins->print_plugins();
        $this->load->view('admin/plugins', $this->data);
    }
    public function activate($name) {
        activate($name);
        back();
    }
    public function deactivate($name) {
        deactivate($name);
        back();
    }
}
