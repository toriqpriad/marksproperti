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

    private function get_table_count($table) {
        $dest_table_as = $table;
        $select_values = array('*');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $get = $this->data_model->get($params);
        if ($get['response'] == OK_STATUS) {
            if (!empty($get['results'])) {
                $total = count($get["results"]);
            } else {
                $total = '0';
            }
        } else {
            $total = '0';
        }
        return $total;
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
        $this->data['total_data'] = array(
            "kategori_properti" => $this->get_table_count('kategori_properti'),
            "properti" => $this->get_table_count('properti'),
            "artikel" => $this->get_table_count('artikel'),
            "iklan" => $this->get_table_count('iklan'),
            "developer" => $this->get_table_count('developer'),
            "portfolio" => $this->get_table_count('portfolio'),            
        );
        print_r($this->data);
        $this->load->view('admin/index', $this->data);
    }

    public function notfound() {
        $this->data['active_page'] = "notfound";
        $this->data['title_page'] = "Tidak ditemukan";
        $this->load->view('admin/404', $this->data);
    }

}
