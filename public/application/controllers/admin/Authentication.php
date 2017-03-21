<?php

class authentication extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library(array('curl', 'session'));
        $this->load->helper(array('form', 'url', 'jwt_helper', 'rest_response_helper'));
        $this->load->model('authentication_model');
        $this->data = [];
    }

    public function login() {
        $data['title_page'] = "Login Page";
        $this->load->view('authentication/login', $data);
    }

    public function logout() {
        $delete_session = $this->session->sess_destroy();
        echo json_encode(response_success());
    }

    public function submit_login() {                
        $access_from = $this->input->get_request_header('access_from');        
        try {
            $input = json_decode(file_get_contents('php://input'));
            if (!empty($input)) {
                $params = new stdClass();
                $params->username = $input->username;
                $params->password = $input->password;
                $getadmin = $this->authentication_model->login_admin($params);
                
                if ($getadmin['response'] == OK_STATUS) {
                    $data['token'] = JWT::encode(get_success($getadmin['results']->name), SERVER_SECRET_KEY);
                    $data['name'] = $getadmin['results']->name;                    
                    if ($access_from == 'web') {
                        $data['access_from'] = 'web';
                        $json = json_encode(get_success($data));
                        $this->session->set_userdata('token_admin', $data['token']);
                        $this->session->set_userdata('name', $data['name']);
                        $this->session->set_userdata('access_from', $data['access_from']);
                        echo $json;
                    } else {
                        $data['access_from'] = 'mobile';
                        $json = json_encode(get_success($data));
                        echo $json;
                    }
                } else {
                    echo json_encode(response_fail());
                }
            } else {
                echo json_encode(response_fail());
            }
        } catch (Exception $e) {
            echo json_encode(response_fail());
        }
    }

}