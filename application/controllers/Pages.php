<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    public $data = array();
    public $_lang;
    public $config_pagination = array();
    public $start_page;
    public $langlink;
    public $segment2;
    public $segment3;

    public function __construct() {
        parent::__construct();
        //$this->output->cache('300');
        $this->segments();
        $this->load->helper('text');
        $this->load->library('menus');
        $this->load->model('Language');
        $this->load->model('CommentsModel');
        $this->load->model('GalleryModel');
        $this->Contents->_lang = $this->_lang;
        $this->data['lang'] = $this->_lang;
        $this->data['langlink'] = ($this->_lang == $this->config->item('language')) ? base_url() : base_url() . $this->_lang . '/';
        $this->data['languages'] = $this->Language->getAll();
        $this->data['active_menu'] = '';
        $this->data['search_value'] = '';
        $this->data['locations'] = $this->Contents->getByParent(6);
        $this->menus();
        $this->metaTag();
        $this->contactVar();
        //$this->statistics();
        $this->data['csrf'] = array('name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash());
    }

    public function index() {
        $this->data['header_home'] = true;
        $this->data['active_menu'] = '-1';
        $this->load->view('home', $this->data);
    }

    public function page() {
        if ($this->segment4 == 'editor') {
            $this->editor();
        }
        $this->load->model('GalleryModel');
        $Shortcut = urldecode($this->segment2);
        $this->data['content'] = $this->Contents->getByShortcut($Shortcut);
        if (!$this->data['content']) {
            show_404();
        }
        $total = $this->Contents->total($this->data['content']->content_id);
        $url = $this->langlink . $this->segment2 . '/';
        $this->pagination($total, $url);
        $this->Contents->increment($this->data['content']->content_id);
        $this->data['images'] = $this->GalleryModel->getByParent($this->data['content']->content_id);
        $this->data['next'] = $this->Contents->nextPrev($this->data['content']->content_id, $this->data['content']->parent_id, '>');
        $this->data['prev'] = $this->Contents->nextPrev($this->data['content']->content_id, $this->data['content']->parent_id, '<');
        $this->data['page_title'] = ($this->data['content']->page_title) ? $this->data['content']->page_title : character_limiter($this->data['content']->title, 70);
        $this->data['meta_description'] = ($this->data['content']->meta_description) ? $this->data['content']->meta_description : character_limiter(strip_tags($this->data['content']->content), 160, '');
        $this->data['meta_keywords'] = ($this->data['content']->meta_keywords) ? $this->data['content']->meta_description : word_limiter(strip_tags($this->data['content']->content), 10, '');
        $this->data['similars'] = $this->Contents->getByParent($this->data['content']->parent_id);
        $this->data['content_parent'] = $this->Contents->getById($this->data['content']->parent_id);
        $this->data['active_menu'] = $this->data['content']->content_id;
        $this->data['trans_other'] = json_decode($this->data['content']->trans_other);
        $this->data['subs'] = $this->Contents->getPage($this->data['content']->content_id, $this->start_page, $this->config_pagination['per_page']);
        $this->data['page_type'] = ($this->data['content']->content_type) ? $this->data['content']->content_type : 'page';
        $this->load->view($this->data['page_type'], $this->data);
    }

    public function contact() {
        $this->data['page_type'] = 'contact';
        $this->data['page_title'] = lang('contact');
        $this->data['active_menu'] = '-2';
        $this->load->view('contact', $this->data);
    }

    public function searchCar() {
        $this->data['datefrom'] = $this->input->get('datefrom');
        $this->data['timefrom'] = $this->input->get('timefrom');
        $this->data['pickup'] = $this->input->get('pickup');
        $this->data['dateto'] = $this->input->get('dateto');
        $this->data['timeto'] = $this->input->get('timeto');
        $this->data['return'] = $this->input->get('return');
        $this->data['available_cars'] = $this->Contents->getByPageType('car');
        $this->load->view('search_car', $this->data);
    }

    public function checkout() {
        $this->data['datefrom'] = $this->input->get('datefrom');
        $this->data['timefrom'] = $this->input->get('timefrom');
        $this->data['pickup'] = $this->input->get('pickup');
        $this->data['dateto'] = $this->input->get('dateto');
        $this->data['timeto'] = $this->input->get('timeto');
        $this->data['return'] = $this->input->get('return');
        $this->data['carId'] = $this->input->get('carId');
        $this->load->view('checkout', $this->data);
    }

    public function createReservation() {
        $this->load->library('email');
        $data['datefrom'] = $this->input->get('datefrom');
        $data['timefrom'] = $this->input->get('timefrom');
        $data['pickup'] = $this->input->get('pickup');
        $data['dateto'] = $this->input->get('dateto');
        $data['timeto'] = $this->input->get('timeto');
        $data['return'] = $this->input->get('return');
        $data['carId'] = $this->input->get('carId');
        $data['firstname'] = $this->input->get('firstname');
        $data['lastname'] = $this->input->get('lastname');
        $data['email'] = $this->input->get('email');
        //$data['phone'] = $this->input->get('phone');
        //$data['driverslicence'] = $this->input->get('driverslicence');
        $data['mobile'] = $this->input->get('mobile');
        $data['flightnr'] = $this->input->get('flightnr');
        $data['notes'] = $this->input->get('notes');
        $data['address'] = $this->input->get('address');
        //$data['country'] = $this->input->get('country');
        //$data['zipcode'] = $this->input->get('zipcode');
        //$data['state'] = $this->input->get('state');
        $data['city'] = $this->input->get('city');
        $this->load->model('ReservationModel');
        $message = $this->ReservationModel->insert($data);
        if ($message) {
            $car = $this->Contents->getById($this->input->get('carId'));
            $pickup_l = $this->Contents->getById($this->input->get('pickup'));
            $return_l = $this->Contents->getById($this->input->get('return'));
            $msj = '<table>'
                    . '<tr><th>Car</th><td>' . $car->title . '</td></tr>'
                    . '<tr><th>Pickup Date</th><td>' . $this->input->get('datefrom') . '</td></tr>'
                    . '<tr><th>Pickup Time</th><td>' . $this->input->get('timefrom') . '</td></tr>'
                    . '<tr><th>Return Date</th><td>' . $this->input->get('dateto') . '</td></tr>'
                    . '<tr><th>Return Time</th><td>' . $this->input->get('timeto') . '</td></tr>'
                    . '<tr><th>Pickup Location</th><td>' . $pickup_l->title . '</td></tr>'
                    . '<tr><th>Return Location</th><td>' . $return_l->title . '</td></tr>'
                    . '<tr><th>Firstname</th><td>' . $this->input->get('firstname') . '</td></tr>'
                    . '<tr><th>Lastname</th><td>' . $this->input->get('lastname') . '</td></tr>'
                    . '<tr><th>Email</th><td>' . $this->input->get('email') . '</td></tr>'
                    . '<tr><th>Mobile</th><td>' . $this->input->get('mobile') . '</td></tr>'
                    . '<tr><th>Flight No</th><td>' . $this->input->get('flightnr') . '</td></tr>'
                    . '<tr><th>Notes</th><td>' . $this->input->get('notes') . '</td></tr>'
                    . '<tr><th>Address</th><td>' . $this->input->get('address') . '</td></tr>'
                    . '<tr><th>City</th><td>' . $this->input->get('city') . '</td></tr>'
                    . '<tr><th>center</th><td>' . $this->input->get('center') . '</td></tr>'
                    . '</table>';
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'www.dalamancarhire.info';
            $config['smtp_user'] = 'mail@dalamancarhire.info';
            $config['smtp_pass'] = 'mFJylJc~^LV*';
            $config['mailtype'] = 'html';
            $this->email->initialize($config);
            $this->email->from($this->input->get('email'), $this->input->get('firstname'));
            $this->email->to('info@cheapcardalaman.com');
            $this->email->subject('New Reservation');
            $this->email->message($msj);
            $this->email->send();
        }
        $this->ContentsMeta->updateMeta($data['carId'], 'pickup_date', $data['datefrom']);
        $this->ContentsMeta->updateMeta($data['carId'], 'pickup_time', $data['timefrom']);
        $this->ContentsMeta->updateMeta($data['carId'], 'return_date', $data['dateto']);
        $this->ContentsMeta->updateMeta($data['carId'], 'return_time', $data['timeto']);
        redirect('../thanks');
    }

    public function thanks() {
        $this->load->view('thanks', $this->data);
    }

    public function gorusleriniz() {
        $this->load->view('gorusleriniz', $this->data);
    }

    public function ik() {
        $this->load->view('ik', $this->data);
    }

    public function languages() {
        $this->load->view('languages', $this->data);
    }

    public function search() {
        $this->data['search_value'] = $this->input->get('search');
        $this->data['search'] = $this->Contents->search($this->input->get('search'));
        $this->load->view('search', $this->data);
    }

    public function tags($tag) {
        $tag2 = str_replace('-', ' ', urldecode($tag));
        $this->data['tags'] = $this->Contents->tags($tag2, $this->_lang);
        $this->load->view('tags', $this->data);
    }

    public function pagination($total, $url) {
        $this->load->library('pagination');
        $this->config_pagination['base_url'] = $url;
        $this->config_pagination['total_rows'] = $total;
        $this->config_pagination['per_page'] = 12;
        $this->config_pagination['use_page_numbers'] = TRUE;
        $this->config_pagination['full_tag_open'] = '<ul class="pagination">';
        $this->config_pagination['full_tag_close'] = '</ul>';
        $this->config_pagination['first_link'] = false;
        $this->config_pagination['last_link'] = false;
        $this->config_pagination['first_tag_open'] = '<li>';
        $this->config_pagination['first_tag_close'] = '</li>';
        $this->config_pagination['prev_link'] = '&laquo';
        $this->config_pagination['prev_tag_open'] = '<li class="prev">';
        $this->config_pagination['prev_tag_close'] = '</li>';
        $this->config_pagination['next_link'] = '&raquo';
        $this->config_pagination['next_tag_open'] = '<li>';
        $this->config_pagination['next_tag_close'] = '</li>';
        $this->config_pagination['last_tag_open'] = '<li>';
        $this->config_pagination['last_tag_close'] = '</li>';
        $this->config_pagination['cur_tag_open'] = '<li class="active"><a href="#">';
        $this->config_pagination['cur_tag_close'] = '</a></li>';
        $this->config_pagination['num_tag_open'] = '<li>';
        $this->config_pagination['num_tag_close'] = '</li>';
        $page_num = $this->segment3;
        if (!$page_num) {
            $page_num = 1;
        }
        $this->start_page = ($page_num - 1) * $this->config_pagination['per_page'];
        $this->pagination->initialize($this->config_pagination);
    }

    public function statistics() {
        $data['ip_address'] = $this->input->server('REMOTE_ADDR');
        if ($this->input->server('HTTP_REFERER') != '') {
            $data['referer'] = $this->input->server('HTTP_REFERER');
        }
        $data['user_agent'] = $this->input->server('HTTP_USER_AGENT');
        $data['json'] = '';
        //$data['json'] = file_get_contents('http://ip-api.com/json/'.$this->input->server('REMOTE_ADDR'));
        $data['visit_time'] = time();
        $this->load->model('StatisticsModel');
        $check = $this->StatisticsModel->check($this->input->server('REMOTE_ADDR'));
        if (empty($check->visit_time) || $check->visit_time + 900 < time()) {
            $this->StatisticsModel->insert($data);
        }
    }

    private function editor() {
        checkAdmin();
        $this->data['page_editor'] = true;
    }

    public function menus() {
        $this->load->model('MenusModel');
        $this->data['t_links'] = $this->MenusModel->getMenu('top');
        $this->data['h_links'] = $this->MenusModel->getMenu('header');
        $this->data['f_links'] = $this->MenusModel->getMenu('footer');
    }

    public function metaTag() {
        $this->data['page_title'] = $this->OptionsModel->getByName('site_name');
        $this->data['meta_description'] = $this->OptionsModel->getByName('site_description');
        $this->data['meta_keywords'] = $this->OptionsModel->getByName('site_description');
    }

    public function contactVar() {
        $contact_vars = array('phone', 'mobile', 'fax', 'email', 'address', 'map_latitude', 'map_longitude', 'facebook', 'twitter',
            'googleplus', 'instagram', 'linkedin', 'youtube', 'working_time');
        foreach ($contact_vars as $value) {
            $this->data[$value] = $this->OptionsModel->getByName($value);
        }
    }

    public function segments() {

        $this->_lang = $this->config->item('language');
        $this->langlink = base_url();
        $this->segment2 = $this->uri->segment(1);
        $this->segment3 = $this->uri->segment(2);
        $this->segment4 = $this->uri->segment(3);
        $additional_languages = $this->config->item('additional_languages');
        foreach ($additional_languages as $language) {
            if ($this->uri->segment(1) == $language || $this->uri->segment(1) == $this->config->item('language')) {
                $this->_lang = $this->uri->segment(1);
                $this->langlink = base_url() . $this->_lang . '/';
                $this->segment2 = $this->uri->segment(2);
                $this->segment3 = $this->uri->segment(3);
                $this->segment4 = $this->uri->segment(4);
                break;
            }
        }

        $this->lang->load('cms', $this->_lang);
        $this->lang->load('custom', $this->_lang);
    }

    public function filterAjax() {
        $region = $this->input->post('region');
        $room_number = $this->input->post('room_number');
        $stage = $this->input->post('stage');
        $price_start = $this->input->post('price_start');
        $filter_region = $this->Contents->getByMeta('region', $region, $_content_type = 'projects');
        $filter_room_number = $this->Contents->getByMeta('room_number', $room_number, $_content_type = 'projects');
        $filter_stage = $this->Contents->getByMeta('stage', $stage, $_content_type = 'projects');
        $filter_price_start = $this->Contents->getByMeta('price_start', $price_start, $_content_type = 'projects');
        $this->data['projects'] = $this->Contents->filter($region, $room_number, $stage, $price_start);
        $this->load->view('elements/grid_home', $this->data);
    }

}
