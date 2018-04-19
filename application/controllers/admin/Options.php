<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Options extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->_lang = $this->config->item('language');
        $this->data['lang'] = $this->_lang;
        $this->data['parent_active'] = 'settings';
    }

    public function index($setting) {
        $this->load->helper('form');

        $this->data['sub_active'] = $setting;
        $this->data['contact_options'] = $this->config->item('settings')[$setting];
        $this->load->view('admin/settings/options', $this->data);
    }

    public function update() {
        foreach ($this->input->post() as $key => $value) {
            $check = $this->OptionsModel->check($key);
            if ($check) {
                $this->OptionsModel->update($key, $value);
            } else {
                $this->OptionsModel->insert($key, $value);
            }
        }
        back();
    }

}
