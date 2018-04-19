<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Content extends CI_Controller {

    public $data = array();
    public $_lang;

    public function __construct() {
        parent::__construct();
        checkAdmin();
        $this->_lang = $this->config->item('language');
        $this->load->model('Language');
        $this->load->model('GalleryModel');
        $this->Contents->_lang = $this->_lang;
        $this->data['languages'] = $this->Language->getAll();
        $this->data['csrf'] = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->data['parent_active'] = '';
        $this->data['sub_active'] = '';
    }

    public function index() {
        
    }

    public function typeList($content_type, $parent_id = 0) {
        $this->data['parent_active'] = $content_type;
        $this->data['sub_active'] = 'list' . $content_type;
        if ($parent_id) {
            $this->data['contents'] = $this->Contents->getByContentParentType($content_type, $parent_id);
        } else {
            $this->data['contents'] = $this->Contents->getByContentType($content_type);
        }
        $this->data['parent_id'] = $parent_id;
        $this->data['content_type'] = $this->config->item('content_types')[$content_type];
        if ($this->data['content_type']['sub_content']) {
            $this->data['sub_content_type'] = $this->config->item('content_types')[$this->data['content_type']['sub_content']];
        }
        $this->load->view('admin/content/list', $this->data);
    }

    public function categories($type) {
        $content_type = str_replace('_cat', '', $type);
        $this->data['parent_active'] = $content_type;
        $this->data['sub_active'] = 'categories' . $content_type;
        $this->data['contents'] = $this->Contents->getByContentType($content_type . '_cat');
        $this->data['content_type'] = $this->config->item('content_types')[$content_type];
        $this->load->view('admin/content/categories', $this->data);
    }

    public function add($content_type,$parent_id = 0, $this_cateogry = false) {
        $this->load->helper('form');
        $this->data['parent_active'] = $content_type;
        $this->data['sub_active'] = 'add' . $content_type;
        $this->data['content_type'] = $this->config->item('content_types')[$content_type];
        if ($this_cateogry) {
            $this->data['custom_fields'] = $this->data['content_type']['category_custom_fields'];
            $this->data['content_type_value'] = $this->data['content_type']['type'] . '_cat';
            $this->data['redirect_to'] = 'categories';
        } else {
            $this->data['custom_fields'] = $this->data['content_type']['custom_fields'];
            $this->data['content_type_value'] = $this->data['content_type']['type'];
            $this->data['redirect_to'] = 'typeList';
        }
        $this->data['parent_id'] = $parent_id;
        $this->data['contents'] = $this->Contents->getAll($this->data['content_type']['type'] . '_cat');
        $this->load->view('admin/content/add', $this->data);
    }

    public function edit($content_type, $id = 0, $this_cateogry = false) {
        $this->load->helper('form');
        $this->data['content_type'] = $this->config->item('content_types')[$content_type];
        if ($this_cateogry) {
            $this->data['custom_fields'] = $this->data['content_type']['category_custom_fields'];
            $this->data['content_type_value'] = $this->data['content_type']['type'] . '_cat';
            $this->data['redirect_to'] = 'categories';
        } else {
            $this->data['custom_fields'] = $this->data['content_type']['custom_fields'];
            $this->data['content_type_value'] = $this->data['content_type']['type'];
            $this->data['redirect_to'] = 'typeList';
        }
        $this->data['content'] = $this->Contents->getById($id);
        $this->data['contents'] = $this->Contents->getAll($this->data['content_type']['type'] . '_cat');
        $this->load->model('CommentsModel');
        $this->data['comments'] = $this->CommentsModel->getByContent($id);
        $this->load->view('admin/content/edit', $this->data);
    }

    public function insert() {
        $parent_id = intval($this->input->post('parent_id'));
        $config_content_type = $this->config->item('content_types');
        $content_type = $this->input->post('content_type');
        $config['upload_path'] = 'public/images/content';
        $config['allowed_types'] = 'gif|jpeg|jpg|png|jpe';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if ($this->input->post('redirect_to') == 'categories') {
            $thumb_content_type = str_replace('_cat', '', $content_type);
        } else {
            $thumb_content_type = $content_type;
        }
        if ($this->upload->do_upload('image')) {
            $image = $this->upload->data('file_name');
            $this->load->library('image_lib');
            foreach ($config_content_type[$thumb_content_type]['thumbs'] as $key => $value) {
                $config_thumb['source_image'] = $config['upload_path'] . '/' . $image;
                $config_thumb['create_thumb'] = TRUE;
                $config_thumb['maintain_ratio'] = $value['maintain_ratio'];
                $config_thumb['master_dim'] = $value['master_dim'];
                $config_thumb['width'] = $value['width'];
                $config_thumb['height'] = $value['height'];
                $config_thumb['thumb_marker'] = '_' . $value['width'] . 'x' . $value['height'];
                $this->image_lib->initialize($config_thumb);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
        } else {
            $image = '';
        }


        $data['image'] = $image;
        $data['parent_id'] = $parent_id;
        $data['created_at'] = time();
        $data['updated_at'] = time();
        $data['content_type'] = $content_type;
        $this->Contents->insert($data);


        $meta = $this->input->post('other');
        if (is_array($meta)) {
            foreach ($meta as $key => $value) {
                $meta_data['post_id'] = $this->Contents->last_insert_id;
                $meta_data['meta_key'] = $key;
                $meta_data['meta_value'] = $value;
                if ($value != '') {
                    $this->ContentsMeta->insert($meta_data);
                }
            }
        }
        foreach ($this->input->post() as $key => $value) {
            if (is_array($value)) {
                $trans[] = $key;
            }
        }
        foreach ($this->data['languages'] as $language) {
            $trans_data = array();
            foreach ($trans as $name) {
                if ($name == 'other') {
                    continue;
                } elseif ($name == 'shortcut') {
                    $trans_data['shortcut'] = $this->shortcut($this->input->post('title')[$language->short], $this->input->post('shortcut')[$language->short]);
                } elseif ($name == 'trans_other') {
                    $meta_trans = $this->input->post('trans_other')[$language->short];
                    $this->transMeta($this->Contents->last_insert_id, $language->short, $meta_trans);
                } else {
                    $trans_data[$name] = $this->input->post($name)[$language->short];
                }
            }
            $trans_data['language'] = $language->short;
            $trans_data['content_id'] = $this->Contents->last_insert_id;
            $this->ContentsTranslate->insert($trans_data);
        }
        redirect('../admin/Content/' . $this->input->post('redirect_to') . '/' . $content_type . '/' . $parent_id);
    }

    public function update($id) {
        $parent_id = intval($this->input->post('parent_id'));
        $config_content_type = $this->config->item('content_types');
        $content_type = $this->input->post('content_type');
        $config['upload_path'] = 'public/images/content';
        $config['allowed_types'] = 'gif|jpeg|jpg|png|jpe';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);

        if ($this->input->post('redirect_to') == 'categories') {
            $thumb_content_type = str_replace('_cat', '', $content_type);
        } else {
            $thumb_content_type = $content_type;
        }
        if ($this->upload->do_upload('image')) {
            $image = $this->upload->data('file_name');
            if ($this->input->post('old_image') != '') {
                @unlink($config['upload_path'] . '/' . $this->input->post('old_image'));
                $thumb = explode('.', $this->input->post('old_image'));
                foreach ($config_content_type[$thumb_content_type]['thumbs'] as $key => $value) {
                    @unlink($config['upload_path'] . '/' . $thumb[0] . '_' . $value['width'] . 'x' . $value['height'] . '.' . $thumb[1]);
                }
            }

            $this->load->library('image_lib');
            foreach ($config_content_type[$thumb_content_type]['thumbs'] as $key => $value) {
                $config_thumb['source_image'] = $config['upload_path'] . '/' . $image;
                $config_thumb['create_thumb'] = TRUE;
                $config_thumb['maintain_ratio'] = $value['maintain_ratio'];
                $config_thumb['master_dim'] = $value['master_dim'];
                $config_thumb['width'] = $value['width'];
                $config_thumb['height'] = $value['height'];
                $config_thumb['thumb_marker'] = '_' . $value['width'] . 'x' . $value['height'];
                $this->image_lib->initialize($config_thumb);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
        } else {
            if ($this->input->post('delete_image')) {
                @unlink($config['upload_path'] . '/' . $this->input->post('old_image'));
                $thumb = explode('.', $this->input->post('old_image'));
                foreach ($config_content_type[$thumb_content_type]['thumbs'] as $key => $value) {
                    @unlink($config['upload_path'] . '/' . $thumb[0] . '_' . $value['width'] . 'x' . $value['height'] . '.' . $thumb[1]);
                }
                $image = '';
            } else {
                $image = $this->input->post('old_image');
            }
        }

        $data['image'] = $image;
        $data['parent_id'] = $parent_id;
        $data['updated_at'] = time();
        $data['content_type'] = $content_type;
        $this->Contents->update($id, $data);

        $meta = $this->input->post('other');
        $this->ContentsMeta->delete($id);
        if (is_array($meta)) {
            foreach ($meta as $key => $value) {
                $meta_data['post_id'] = $id;
                $meta_data['meta_key'] = $key;
                $meta_data['meta_value'] = $value;
                if ($value != '') {
                    $this->ContentsMeta->insert($meta_data);
                }
            }
        } else {
            $meta_trans = array();
        }
        foreach ($this->input->post() as $key => $value) {
            if (is_array($value)) {
                $trans[] = $key;
            }
        }
        foreach ($this->data['languages'] as $language) {
            foreach ($trans as $name) {
                if ($name == 'other') {
                    continue;
                } elseif ($name == 'shortcut') {
                    $trans_data['shortcut'] = $this->shortcut($this->input->post('title')[$language->short], $this->input->post('shortcut')[$language->short]);
                } elseif ($name == 'trans_other') {
                    $meta_trans = $this->input->post('trans_other')[$language->short];
                    $this->transMeta($id, $language->short, $meta_trans);
                } else {
                    $trans_data[$name] = $this->input->post($name)[$language->short];
                }
            }
            $trans_data['language'] = $language->short;
            $trans_data['content_id'] = $id;
            $trans_id = $this->ContentsTranslate->getByContentLang($id, $language->short);
            if ($trans_id) {
                $this->ContentsTranslate->update($trans_id->id, $trans_data);
            } else {
                $this->ContentsTranslate->insert($trans_data);
            }
        }
        if ($this->input->post('ok')) {
            redirect('../admin/Content/' . $this->input->post('redirect_to') . '/' . $content_type . '/' . $parent_id);
        } else {
            back();
        }
    }

    public function delete($id) {
        $data['deleted_at'] = time();
        $this->Contents->update($id, $data);
        back();
    }

    public function updateFromEditor($id) {
        $trans_data['language'] = $this->input->post('lang');
        $trans_data['content'] = $this->input->post('content');
        $parent_id = $this->input->post('parent_id');
        $content_type = $this->input->post('content_type');
        $trans_id = $this->ContentsTranslate->getByContentLang($id, $trans_data['language']);
        $this->ContentsTranslate->update($trans_id->id, $trans_data);
        if ($this->input->post('ok')) {
            redirect('../admin/Content/typeList/' . $content_type . '/' . $parent_id);
        } else {
            back();
        }
    }

    public function rankUpdate() {
        foreach ($this->input->post('rank') as $key => $value) {
            $data['rank'] = $value;
            $this->Contents->update($key, $data);
        }
        back();
    }

    public function recycleBin($content_type) {
        $this->data['parent_active'] = $content_type;
        $this->data['sub_active'] = 'recycle_bin' . $content_type;
        $this->data['contents'] = $this->Contents->getTrash($content_type);
        $this->load->view('admin/content/trash', $this->data);
    }

    public function restoration($id) {
        $data['deleted_at'] = '0';
        $this->Contents->update($id, $data);
        back();
    }

    public function deleteForEver($id) {
        $content = $this->Contents->getById($id);
        @unlink('public/images/content/' . $content->image);
        $thumb = explode('.', $content->image);
        @unlink('public/images/content/' . $thumb[0] . '_thumb' . '.' . $thumb[1]);
        $this->Contents->delete($id);
        $this->ContentsMeta->delete($id);
        back();
    }

    public function gallery($id) {
        $this->data['parent_id'] = $id;
        $this->data['images'] = $this->GalleryModel->getByParent($id);
        $this->load->view('admin/content/gallery', $this->data);
    }

    // insert and update functions

    public function shortcut($title, $shortcut) {
        if ($shortcut == '') {
            $shortcut = seo_title($title);
            $check = $this->Contents->getByShortcut($shortcut);
            $x = 1;
            while (isset($check->title)) {
                $shortcut = seo_title($title) . '-' . $x;
                $check = $this->Contents->getByShortcut($shortcut);
                $x++;
            }
        }
        return $shortcut;
    }

    public function transMeta($post_id, $lang, $meta_trans) {
        if (is_array($meta_trans)) {
            foreach ($meta_trans as $key => $value) {
                $meta_data['post_id'] = $post_id;
                $meta_data['meta_key'] = $key;
                $meta_data['meta_value'] = $value;
                $meta_data['meta_lang'] = $lang;
                if ($value != '') {
                    $this->ContentsMeta->insert($meta_data);
                }
            }
        }
    }

}
