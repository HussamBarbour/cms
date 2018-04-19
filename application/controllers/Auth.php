<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
        $this->_lang = $this->config->item('language');
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->model('Users');
    }

    public function index() {
        if ($this->session->userdata('admin')) {
            redirect('../admin/Home');
        }
        else {
            $this->load->view('admin/login', $this->data);
        }
    }

    public function check() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $check = $this->Users->checkUser($username, $password);
        if ($check) {
            $mode = $this->Users->checkUsermode($check->id, 'admin');
            if ($mode) {
                $cookie = array('name' => 'admin','value' => 'adminpage','expire' => time() + 86500,);
                set_cookie($cookie);
                $admin_data = array('admin' => TRUE,'id' => $check->id,'username' => $check->username,'usermode' => $check->usermode);
                $this->session->set_userdata($admin_data);
                redirect('../admin/Home');
            }
        } else {redirect($this->input->server('HTTP_REFERER'));}
    }

    public function logout() {
        $admin_data = array('admin', 'id', 'username', 'usermode');
        $this->session->unset_userdata($admin_data);
        redirect('../Auth');
    }

    public function updateprofile() {
        if (!$this->session->userdata('admin')) {exit;}
        $username = $this->input->post('username');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $re_password = $this->input->post('re_password');
        $check = $this->Users->getAdmin();
        if (md5($old_password) == $check->password) {
            if ($new_password == $re_password) {
                $data['username'] = $username;
                $data['password'] = md5($new_password);
                $this->Users->update(1, $data);
                $this->session->set_userdata('profile_message', lang('information_updated'));
                $this->session->set_userdata('username', $username);
            } else {
                $this->session->set_userdata('profile_message', 'Erorr');
            }
        } else { $this->session->set_userdata('profile_message', 'Erorr');}
        back();
    }

}
