<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requests extends CI_Controller {

    public $_lang;

    public function __construct() {
        parent::__construct();
        if ($this->uri->segment(1) != 'tr') {
            $this->_lang = $this->config->item('language');
        } else {
            $this->_lang = $this->uri->segment(1);
        }
        $this->load->model('FormsModel');
    }

    public function sentMessage($type = 'contact') {
        $this->load->helper('date');
        $secret = $this->config->item('google_captcha_secret');
        $response = $this->input->post('g-recaptcha-response');
        $ip = $this->input->server('REMOTE_ADDR');
        $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response . '&ip=' . $ip);
        $resp = json_decode($verify, true);
        if (!$resp['success']) {
            //echo '{ "alert": "error", "Hata" }';
            //exit;
        }
        $fileds = $this->config->item('forms')[$type];
        foreach ($fileds as $filed) {
            if ($filed == 'cv') {

                $config['upload_path'] = 'public/upload/cv';
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $config['max_size'] = 10000;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('cv')) {
                    $data['cv'] = $this->upload->data('file_name');
                }
            } else {
                $data[$filed] = $this->input->post($filed);
            }
        }
        $form['form_type'] = $type;
        $form['sent_at'] = unix_to_human(time(), TRUE, 'eu');
        $message = $this->FormsModel->insert($form, $data);
        if ($message) {
             redirect('../thanks');
        } else {
            
        }
    }

    public function sentComment() {
        $this->load->helper('date');
        $this->load->model('CommentsModel');
        $data['name'] = $this->input->post('name');
        $data['email'] = $this->input->post('email');
        $data['message'] = $this->input->post('message');
        $data['content_id'] = intval($this->input->post('content_id'));
        $data['sent_at'] = time();
        $this->CommentsModel->insert($data);
        back();
    }

}
