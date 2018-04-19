<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->_lang = $this->config->item('language');
        $this->load->model('GalleryModel');
        $this->data['lang'] = $this->_lang;
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->data['parent_active'] = 'upload';
        $this->data['sub_active'] = 'gallery';
    }

    public function index() {
        $this->data['images'] = $this->GalleryModel->get();
        $this->data['contents'] = $this->Contents->getAll();
        $this->load->view('admin/gallery', $this->data);
    }

    public function insert() {
        $config['upload_path'] = 'public/upload/images';
        $config['allowed_types'] = 'gif|jpeg|jpg|png|jpe';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->load->helper('security');
        $filesCount = count($_FILES['images']['name']);
        
        $this->load->library('image_lib');
        for ($i = 0; $i < $filesCount; $i++) {
            $_FILES['image']['name'] = $_FILES['images']['name'][$i];
            $_FILES['image']['type'] = $_FILES['images']['type'][$i];
            $_FILES['image']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
            $_FILES['image']['error'] = $_FILES['images']['error'][$i];
            $_FILES['image']['size'] = $_FILES['images']['size'][$i];

            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data('file_name');
                $config_thumb['source_image'] = $config['upload_path'] . '/' . $image;
                $config_thumb['create_thumb'] = TRUE;
                $config_thumb['maintain_ratio'] = TRUE;
                $config_thumb['width'] = 180;
                $config_thumb['height'] = 115;
                $this->image_lib->clear();
                $this->image_lib->initialize($config_thumb);
                $this->image_lib->resize();
            } else {
                $image = '';
            }
            $data['image'] = $image;
            $data['title'] = xss_clean($_POST['title']);
            $data['parent_id'] = intval($_POST['parent_id']);
            $this->GalleryModel->insert($data);
        }
        back();
    }

    public function delete() {
        $id = $_POST['id'];
        $config['upload_path'] = 'public/upload/images';
        @unlink($config['upload_path'] . '/' . $_POST['image']);
        $thumb = explode('.', $_POST['image']);
        @unlink('public/upload/images/' . $thumb[0] . '_thumb' . '.' . $thumb[1]);
        $this->GalleryModel->delete($id);
        back();
    }

}
