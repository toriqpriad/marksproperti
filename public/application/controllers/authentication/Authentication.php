<?php

class authentication extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('authentication_model');
        $this->load->library(array('curl', 'session', 'email'));
        $this->load->helper(array('form', 'url', 'jwt_helper', 'rest_response_helper', 'key_helper', 'send_mail_helper', 'client_access_helper'));
        $this->data = [];
    }

    function register() {
        $this->data['title_page'] = "Register New Guide";
        $this->load->view('backend/guide/register', $this->data);
    }

    function login() {
        $this->data['title_page'] = "Halaman Login";
        $this->load->view('authentication/login', $this->data);
    }

    public function logout() {
        $delete_session = $this->session->sess_destroy();
        echo json_encode(response_success());
    }

    public function submit_login() {
        try {
            $input = json_decode(file_get_contents('php://input'));
            if (!empty($input)) {
                $params = new stdClass();
                $params->username = $input->username;
                $params->password = $input->password;
                $get = $this->authentication_model->login($params);
                if ($get['response'] == OK_STATUS) {
                    $date = date('Y-m-d');
                    $expr_date = date('Y-m-d', time() + 86400);
                    $include = array(
                        'name' => $get['results']->name,
                        'role' => $get['results']->role,
                        'created_date' => $date,
                        'expire_date' => $expr_date
                    );
                    $data['token'] = JWT::encode(get_success($include), SERVER_SECRET_KEY);
                    $data['role'] = $get['results']->role;
                    // SET WEB SESSION //
                    if ($data['token'] == TRUE) {
                        $this->session->set_userdata('web_token', $data['token']);
                        echo json_encode(get_success($data['role']));
                        ////////
                    } else {
                        echo json_encode(response_fail());
                    }
                } else {
                    echo json_encode(response_fail());
                }
            }
        } catch (Exception $e) {
            echo json_encode(response_fail());
        }
    }

    public function submit_register() {
        try {
            $params = json_decode(file_get_contents('php://input'));
            $key = generate_key();
            $data = array(
                'registration_key' => $key,
                'name' => $params->fullname,
                'username' => $params->username,
                'email' => $params->email,
                'password' => md5($params->password),
                'status' => NEW_CONTENT_STATUS,
            );
            $insert = $this->guide_model->add($data);
            $link = WEBAPP_URL . 'guide/verification/' . $key;
            //SENDING EMAIL FUNCTION
            $email_data = new stdClass();
            $email_data->code = $key;
            $email_data->event = "New Guide Registration";
            $email_data->email_destination = $params->email;
            $email_data->email_subject = EMAIL_SUBJECT_GUIDE_REGISTRATION_VERIFICATION;
            $email_data->email_message = "Hello $params->fullname,<br>Thank you for registering your account to be our new guide.<br>To continue the process please verify and activate your account by visit this link : <a href='$link'>$link</a> . <br> Thank you ..";
            $send = send_mail($email_data);
            if ($send == OK_STATUS) {
                $res = get_success(EMAIL_REGISTRATION_SUCCESS_MESSAGE);
            } else {
                $res = response_fail();
            }
        } catch (Exception $e) {
            $res = response_fail();
        }
        echo json_encode($res);
    }

    function verification() {
        try {
            $code = $this->uri->segment(3);
            if ($code == "") {
                $res = response_fail();
            } else {
                $check = $this->log_mail_model->get('code', $code);
                if ($check['response'] == OK_STATUS) {
                    if ($check['data'] != "") {
                        if ($check['data']->status == CLICKED_LOG_MAIL_STATUS) {
                            $res = clicked_status();
                            $res = $res['message'];
                        } else {
                            $params = new stdClass();
                            $params_guide = new stdClass();
                            $params->new_status = CLICKED_LOG_MAIL_STATUS;
                            $params->where = 'seq';
                            $params->value = $check['data']->seq;
                            $change_status = $this->log_mail_model->change_status($params);
                            if ($change_status['response'] == OK_STATUS) {
                                $params_guide->new_status = ACTIVE_CONTENT_STATUS;
                                $params_guide->where = 'registration_key';
                                $params_guide->value = $code;
                                $change_status_guide = $this->guide_model->change_status($params_guide);
                            }
                            if ($change_status['response'] == OK_STATUS AND $change_status_guide['response'] == OK_STATUS) {
                                $res = "Thank you for your verificitaion process, now your guide account is active, login here to create your article";
                            } else {
                                $res = "Sorry, your action is fail.";
                            }
                        }
                    } else {
                        $res = get_not_found();
                        $res = $res['message'];
                    }
                } else {
                    $res = response_fail();
                    $res = $res['message'];
                }
            }
        } catch (Exception $e) {
            $res = response_fail();
            $res = $res['message'];
        }
        echo $res;
    }

    public function checkwebtoken() {
        try {
            $token = json_decode(file_get_contents('php://input'));
            if ($token == "") {
                $response = response_fail();
            } else {
                $decode = JWT::decode($token, SERVER_SECRET_KEY, JWT_ALGHORITMA);
                if (!$decode) {
                    $response = response_fail();
                } else {
                    if ($decode->response != OK_STATUS) {
                        $response = response_fail();
                    } else {
                        if ($decode->data->role != "A") {
                            $response = response_fail();
                        } else {
                            $response = response_success();
                        }
                    }
                }
            }
        } catch (Exception $e) {
            $response = response_fail();
        }
        echo json_encode($response);
    }

}
