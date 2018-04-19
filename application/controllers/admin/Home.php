<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public $data = array();

    public function index() {
        checkAdmin();
        $this->data['parent_active'] = null;
        $this->data['sub_active'] = null;
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('admin/home', $this->data);
    }

}
