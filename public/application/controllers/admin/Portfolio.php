<?php

include 'Admin.php';

class portfolio extends admin {

    function __construct() {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "portfolio";
    }

    //Data on Page
    public function data() {
        $this->data['title_page'] = "Data Portfolio";
        $dest_table_as = 'portfolio as p';
        $select_values = array('p.id', 'p.nama');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $params->join_tables = array();
        $params->where_tables = array();
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        if ($get['results'] != "") {
            $this->data['record'] = $get['results'];
        } else {
            $this->data['record'] = '';
        }
        $this->load->view('admin/portfolio/data', $this->data);
    }

    public function detail() {
        $parameter = $this->uri->segment(4);
        $params = new stdClass();
        $params->dest_table_as = 'portfolio as p';
        $params->select_values = array('p.*');
        $params->join_tables = array();
        $params->where_tables = array(array("where_column" => 'p.id', "where_value" => $parameter));
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        if ($get["results"][0]) {
            $check_thumb = file_exists("assets/images/backend/portfolio/" . $get["results"][0]->image);
            if (!$check_thumb) {
                $get["results"][0]->image = "";
            }
            $this->data['title_page'] = "Detail Iklan";
            $this->data['detail'] = $get["results"][0];

            $this->load->view("admin/portfolio/detail", $this->data);
        } else {
            redirect('/admin/404');
        }
    }

    public function add() {
        $this->data['title_page'] = "Tambah Data Portfolio";
        $this->load->view('admin/portfolio/add', $this->data);
    }

    //Data Processing


    public function add_submit() {
        $nama = $this->input->post("nama");
        if (isset($_FILES['image'])) {
            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image'];
                $upload = image_upload($image, '1', "assets/images/backend/portfolio/");
                $image_name = $upload[0];
            } else {
                $image_name = "";
            }
        }

        $params = array("nama" => $nama, "image" => $image_name);
        $dest_table = 'portfolio';
        $add = $this->data_model->add($params, $dest_table);

        if ($add['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/portfolio/detail/' . $add['data']);
            $result = get_success($data);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

    public function update_submit() {
        $id = $this->input->post("id");
        $nama = $this->input->post("nama");
        $old_img = $this->input->post("old_image");
        if (isset($_FILES['image'])) {
            if ($_FILES['image']['name'] != "") {
                $upload = image_upload($_FILES['image'], '1', "assets/images/backend/portfolio/");
                $image_name = $upload[0];
                if ($old_img != "") {
                    $old_dir = './assets/images/backend/portfolio/' . $old_img;
                    $remove = unlink($old_dir);
                }
            } else {
                $image_name = "";
            }
        }

//        print_r($gambar_old);
//        exit();

        $params_data = new stdClass();
        if (isset($image_name)) {
            $params_data->new_data = array("nama" => $nama, "image" => $image_name);
        } else {
            $params_data->new_data = array("nama" => $nama,);
        }
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'portfolio';
        $update = $this->data_model->update($params_data);


        if ($update['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/portfolio/detail/' . $id);
            $result = get_success($data);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

    public function delete_submit() {
        $id = $this->uri->segment(4);
        $params_delete = new stdClass();
        $where1 = array("where_column" => 'id', "where_value" => $id);
        $params_delete->where_tables = array($where1);
        $params_delete->table = 'portfolio';
        $delete = $this->data_model->delete($params_delete);
        if ($delete['response'] == OK_STATUS) {
            $result = response_success();
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

}