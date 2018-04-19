<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SocialMedia extends CI_Controller {

    public $data = array();
    public $_lang;
    
    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->load->model('Social');
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
    }
    
    public function index() {
        $this->_lang = $this->config->item('language');
        $this->data['lang'] = $this->_lang;
        $social = $this->Social->get();
        $this->data['parent_active'] = 'settings';
        $this->data['sub_active'] = 'social_media';
        foreach ($social as $key=>$social)
                $this->data[$key] = $social;
        $this->load->view('admin/settings/social_media', $this->data);
    }
    
    
    public function update() {
        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
            $this->Social->update($data);
        }
        back();
    }
}
