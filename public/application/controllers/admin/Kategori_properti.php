<?php

include 'Admin.php';

class kategori_properti extends admin {

    function __construct() {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "kat_properti";
    }

    public function get_pc() {
        $params_pc = new stdClass();
        $params_pc->dest_table_as = 'tb_pc as pc';
        $params_pc->select_values = array('pc.id as id', 'pc.nama as nama');
        $params_pc->join_tables = array();
        $params_pc->where_tables = array();
        $params_pc->or_where_tables = array();
        $pc = $this->tpq_model->get($params_pc);
        return $pc;
    }

    public function get_kat_pgrs() {
        $params_kat_pgrs = new stdClass();
        $params_kat_pgrs->dest_table_as = 'tb_kategori_pengurus_tpq';
        $params_kat_pgrs->select_values = array('*');
        $params_kat_pgrs->join_tables = array();
        $params_kat_pgrs->where_tables = array();
        $params_kat_pgrs->or_where_tables = array();
        $get_kat_pgrs = $this->tpq_model->get($params_kat_pgrs);
        return $get_kat_pgrs;
    }

    //Data on Page
    public function data() {
        $this->data['title_page'] = "Data Kategori Properti";
        $dest_table_as = 'kategori_properti as kat_properti';
        $select_values = array('kat_properti.id', 'kat_properti.name');
        $join_tables = array();
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $params->join_tables = $join_tables;
        $params->where_tables = array();
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        if ($get['results'] != "") {
            $this->data['record'] = $get['results'];
        } else {
            $this->data['record'] = '';
        }
        $this->load->view('admin/kategori_properti/data', $this->data);
    }

    public function detail() {
        $parameter = $this->uri->segment(4);
        $params = new stdClass();
        $params->dest_table_as = 'kategori_properti as kp';
        $params->select_values = array('*');
        $params->join_tables = array();
        $params->where_tables = array(array("where_column" => 'kp.id', "where_value" => $parameter));
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        if ($get["results"][0] != "") {
            $this->data['title_page'] = "Detail Kategori Properti";
            $this->data['detail'] = $get["results"][0];
            $this->load->view("admin/kategori_properti/detail", $this->data);
        } else {
            redirect('/admin/404');
        }
    }

    public function add() {
        $this->data['title_page'] = "Tambah Data Kategori Properti";
        $this->load->view('admin/kategori_properti/add', $this->data);
    }

    //Data Processing

    public function add_submit() {
        $nama = $this->input->post("nama");
        //CHECK NAME
        $params_check = new stdClass();
        $params_check->dest_table_as = 'kategori_properti as kat';
        $params_check->select_values = array('kat.name', 'kat.id');
        $where_data = array("where_column" => 'kat.name', "where_value" => $nama);
        $params_check->where_tables = array($where_data);
        $params_check->join_tables = array();
        $params_check->or_where_tables = array();
        $check = $this->data_model->get($params_check);
        if (!empty($check['results'])) {
            $params = new stdClass();
            $params->response = FAIL_STATUS;
            $params->message = "Nama sudah digunakan !";
            $params->data = "";
            $result = response_custom($params);
            echo json_encode($result);
            exit();
        }



        $params_data = array("name" => $nama);
        $dest_table = 'kategori_properti';
        $add = $this->data_model->add($params_data, $dest_table);
        if ($add['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/kategori_properti/');
            $result = get_success($data);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

    public function update_submit() {
        $id = $this->input->post("id");
        $nama = $this->input->post("nama");
        //Update Data
        $params_data = new stdClass();
        $params_data->new_data = array("name" => $nama);
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'kategori_properti';
        $update = $this->data_model->update($params_data);
        if ($update['response'] == OK_STATUS) {
            $params = new stdClass();
            $params->response = OK_STATUS;
            $params->message = OK_MESSAGE;
            $params->data = array('link' => base_url() . 'admin/kategori_properti/detail/' . $id);
            $result = response_custom($params);
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
        $params_delete->table = 'kategori_properti';
        $delete = $this->data_model->delete($params_delete);
        if ($delete['response'] == OK_STATUS) {
            $result = response_success();
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

}
