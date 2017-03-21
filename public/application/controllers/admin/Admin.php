<?php

class admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->library(array('curl', 'session'));
        $this->load->helper(array('form', 'url', 'jwt_helper', 'rest_response_helper', 'key_helper', 'image_process_helper', 'file'));
        $this->data = [];
        $this->checkauth();
    }

    public function checkauth() {
        if ($this->session->userdata('web_token') == "") {
            redirect('login');
            exit();
        } else {
            $decode = JWT::decode($this->session->userdata('web_token'), SERVER_SECRET_KEY, JWT_ALGHORITMA);
            if ($decode->response != OK_STATUS) {
                redirect('login');
                exit;
            } else {
                if ($decode->data->role != "A") {
                    redirect('login');
                    exit;
                }
            }
        }
    }

    public function dashboard() {
        $this->data['active_page'] = "dashboard";
        $this->data['title_page'] = "Dashboard";
        $this->load->view('admin/index', $this->data);
    }

    public function notfound() {
        $this->data['active_page'] = "notfound";
        $this->data['title_page'] = "Tidak ditemukan";
        $this->load->view('admin/404', $this->data);
    }

}
