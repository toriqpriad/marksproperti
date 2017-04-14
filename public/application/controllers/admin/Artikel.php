<?php

include 'Admin.php';

class artikel extends admin {

    function __construct() {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "artikel";
    }

    public function get_kat_properti() {
        $params = new stdClass();
        $params->dest_table_as = 'kategori_properti as kat';
        $params->select_values = array('kat.id as id', 'kat.name as nama');
        $params->join_tables = array();
        $params->where_tables = array();
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        return $get["results"];
    }

    public function get_properti_images($id_properti) {
        $params = new stdClass();
        $params->dest_table_as = 'properti_images as pi';
        $params->select_values = array('pi.*');
        $params->join_tables = array();
        $params->where_tables = array(array("where_column" => 'pi.properti_id', "where_value" => $id_properti));
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        return $get["results"];
    }

    //Data on Page
    public function data() {
        $this->data['title_page'] = "Data Artikel";
        $dest_table_as = 'artikel as a';
        $select_values = array('a.id', 'a.judul', 'a.content', 'a.tgl_post');
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
        $this->load->view('admin/artikel/data', $this->data);
    }

    public function detail() {
        $parameter = $this->uri->segment(4);
        $params = new stdClass();
        $params->dest_table_as = 'artikel as a';
        $params->select_values = array('a.*');
        $params->join_tables = array();
        $params->where_tables = array(array("where_column" => 'a.id', "where_value" => $parameter));
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        if ($get["results"][0]) {
            $check_thumb = file_exists("assets/images/backend/artikel/" . $get["results"][0]->gbr_thumb);
            if (!$check_thumb) {
                $get["results"][0]->gbr_thumb = "";
            }
            $this->data['title_page'] = "Detail Artikel";
            $this->data['detail'] = $get["results"][0];

            $this->load->view("admin/artikel/detail", $this->data);
        } else {
            redirect('/admin/404');
        }
    }

    public function add() {
        $this->data['title_page'] = "Tambah Data Artikel";
        $this->load->view('admin/artikel/add', $this->data);
    }

    //Data Processing


    public function add_submit() {
        $judul = $this->input->post("judul");
        $isi = $this->input->post("isi");
        $key = generate_key('5');
        $link = str_replace(" ", "-", strtolower(substr($judul, 0, 15))) . '-' . $key . ".html";
        if (isset($_FILES['thumb'])) {
            if (!empty($_FILES['thumb']['name'])) {
                $image = $_FILES['thumb'];
                $upload = image_upload($image, '1', "assets/images/backend/artikel/");
                $image_name = $upload[0];
            } else {
                $image_name = "";
            }
        }

        $params = array("judul" => $judul, "link" => $link, "content" => $isi, "tgl_post" => date('Y-m-d'), "gbr_thumb" => $image_name);
        $dest_table = 'artikel';
        $add = $this->data_model->add($params, $dest_table);

        if ($add['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/artikel/detail/' . $add['data']);
            $result = get_success($data);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

    public function update_submit() {
        $id = $this->input->post("id");
        $judul = $this->input->post("judul");
        $isi = $this->input->post("isi");
        $old_thumb = $this->input->post("old_thumb");
        $key = generate_key('5');
        $link = str_replace(" ", "-", strtolower(substr($judul, 0, 15))) . '-' . $key . ".html";
        if (isset($_FILES['thumb'])) {
            if ($_FILES['thumb']['name'] != "") {
                $upload = image_upload($_FILES['thumb'], '1', "assets/images/backend/artikel/");
                $image_name = $upload[0];
                if ($old_thumb != "") {
                    $old_dir = './assets/images/backend/artikel/' . $old_thumb;
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
            $params_data->new_data = array(
                "judul" => $judul,
                "link" => $link,
                "content" => $isi,
                "gbr_thumb" => $image_name,
            );
        } else {
            $params_data->new_data = array(
                "judul" => $judul,
                "link" => $link,
                "content" => $isi,
            );
        }
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'artikel';
        $update = $this->data_model->update($params_data);


        if ($update['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/artikel/detail/' . $id);
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
        $params_delete->table = 'artikel';
        $delete = $this->data_model->delete($params_delete);
        if ($delete['response'] == OK_STATUS) {
            $result = response_success();
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

}
