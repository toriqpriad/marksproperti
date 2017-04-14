<?php

include 'Admin.php';

class properti extends admin {

    function __construct() {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "properti";
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
        $this->data['title_page'] = "Data Properti";
        $dest_table_as = 'properti as p';
        $select_values = array('p.id', 'p.judul', 'p.alamat', 'p.jenis', 'p.terjual', 'p.harga', 'k.name as kat');
        $join_data1 = array("join_with" => 'kategori_properti as k', "join_on" => 'p.kat_properti = k.id', "join_type" => '');
        $join_tables = array($join_data1);
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
        $this->load->view('admin/properti/data', $this->data);
    }

    public function detail() {
        $parameter = $this->uri->segment(4);
        $params = new stdClass();
        $params->dest_table_as = 'properti as p';
        $params->select_values = array('p.*');
        $params->join_tables = array();
        $params->where_tables = array(array("where_column" => 'p.id', "where_value" => $parameter));
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        if ($get["results"][0] != "") {
            $get_images = $this->get_properti_images($parameter);
            $get_kat_properti = $this->get_kat_properti();
            $this->data['title_page'] = "Detail Properti";
            $this->data['detail'] = array("data_properti" => $get["results"], "kat_properti" => $get_kat_properti, "properti_images" => $get_images);
            $this->load->view("admin/properti/detail", $this->data);
        } else {
            redirect('/admin/404');
        }
    }

    public function add() {
        $kat_properti = $this->get_kat_properti();
        $this->data['kat_properti'] = $kat_properti;
        $this->data['title_page'] = "Tambah Data Properti";
        $this->load->view('admin/properti/add', $this->data);
    }

    //Data Processing

    public function add_submit() {
        $judul = $this->input->post("judul");
        $deskripsi = $this->input->post("deskripsi");
        $alamat = $this->input->post("alamat");
        $kat = $this->input->post("kat_properti");
        $jenis = $this->input->post("jenis_properti");
        $sertifikat = $this->input->post("sertifikat");
        $luas_tanah = $this->input->post("luas_tanah");
        $luas_bangunan = $this->input->post("luas_bangunan");
        $kamar_tidur = $this->input->post("kamar_tidur");
        $kamar_mandi = $this->input->post("kamar_mandi");
        $harga = $this->input->post("harga");
        $video_url = $this->input->post("video_url");

        //CHECK Judul
        $params_check = new stdClass();
        $params_check->dest_table_as = 'properti as p';
        $params_check->select_values = array('p.judul', 'p.id');
        $where_data = array("where_column" => 'p.judul', "where_value" => $judul);
        $params_check->where_tables = array($where_data);
        $params_check->join_tables = array();
        $params_check->or_where_tables = array();
        $check = $this->data_model->get($params_check);
        if (!empty($check['results'])) {
            $params = new stdClass();
            $params->response = FAIL_STATUS;
            $params->message = "Judul sudah digunakan !";
            $params->data = "";
            $result = response_custom($params);
            echo json_encode($result);
            exit();
        }
        $key = generate_key('5');
        $link = str_replace(" ", "-", strtolower(substr($judul, 0, 15))) . '-' . $key . ".html";
        $params_data = array(
            "judul" => $judul,
            "link" => $link,
            "alamat" => $alamat,
            "deskripsi" => $deskripsi,
            "harga" => $harga,
            "luas_tanah" => $luas_tanah,
            "luas_bangunan" => $luas_bangunan,
            "sertifikat" => $sertifikat,
            "kat_properti" => $kat,
            "jenis" => $jenis,
            "kamar_tidur" => $kamar_tidur,
            "kamar_mandi" => $kamar_mandi,
            "video_url" => $video_url,
            "tgl_dipasang" => date("Y-m-d"),
        );


        $dest_table = 'properti';
        $add_data = $this->data_model->add($params_data, $dest_table);
        $image_array = [];
        if (isset($_FILES['gambar1'])) {
            array_push($image_array, $_FILES['gambar1']);
        }
        if (isset($_FILES['gambar2'])) {
            array_push($image_array, $_FILES['gambar2']);
        }
        if (isset($_FILES['gambar3'])) {
            array_push($image_array, $_FILES['gambar3']);
        }
        if (isset($_FILES['gambar4'])) {
            array_push($image_array, $_FILES['gambar4']);
        }
        $images = array();
        foreach ($image_array as $image) {
            if (!empty($image)) {
                $upload = image_upload($image, '1', "assets/images/backend/properti/");
                $image_name = $upload[0];
            } else {
                $image_name = "";
            }
            array_push($images, $image_name);
        }
        foreach ($images as $each) {
            $params_image = array("image" => $each, "properti_id" => $add_data['data']);
            $dest_table_image = 'properti_images';
            $add = $this->data_model->add($params_image, $dest_table_image);
        }
        if ($add['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/properti/detail/' . $add_data['data']);
            $result = get_success($data);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

    public function update_submit() {
        $id = $this->input->post("id");
        $judul = $this->input->post("judul");
        $deskripsi = $this->input->post("deskripsi");
        $alamat = $this->input->post("alamat");
        $kat = $this->input->post("kat_properti");
        $jenis = $this->input->post("jenis_properti");
        $sertifikat = $this->input->post("sertifikat");
        $luas_tanah = $this->input->post("luas_tanah");
        $luas_bangunan = $this->input->post("luas_bangunan");
        $kamar_tidur = $this->input->post("kamar_tidur");
        $kamar_mandi = $this->input->post("kamar_mandi");
        $harga = $this->input->post("harga");
        $video_url = $this->input->post("video_url");
        $gambar_old = json_decode($this->input->post("old_to_delete"));
        $key = generate_key('5');
        $link = str_replace(" ", "-", strtolower(substr($judul, 0, 30)));
        $link = str_replace(".", "", $link) . '-' . $key . ".html";
        $params_data = new stdClass();
        $params_data->new_data = array(
            "judul" => $judul,
            "link" => $link,
            "alamat" => $alamat,
            "deskripsi" => $deskripsi,
            "harga" => $harga,
            "luas_tanah" => $luas_tanah,
            "luas_bangunan" => $luas_bangunan,
            "sertifikat" => $sertifikat,
            "kat_properti" => $kat,
            "jenis" => $jenis,
            "kamar_tidur" => $kamar_tidur,
            "kamar_mandi" => $kamar_mandi,
            "video_url" => $video_url,
        );
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'properti';
        $update = $this->data_model->update($params_data);

        foreach ($gambar_old as $each) {
            if ($each != "") {
                $params_delete = new stdClass();
                $where1 = array("where_column" => 'image', "where_value" => $each);
                $where2 = array("where_column" => 'properti_id', "where_value" => $id);
                $params_delete->where_tables = array($where1, $where2);
                $params_delete->table = 'properti_images';
                $delete = $this->data_model->delete($params_delete);
                $remove_old = unlink('./assets/images/backend/properti/' . $each);
            }
        }

        $image_array = [];
        if (isset($_FILES['gambar1'])) {
            array_push($image_array, $_FILES['gambar1']);
        }
        if (isset($_FILES['gambar2'])) {
            array_push($image_array, $_FILES['gambar2']);
        }
        if (isset($_FILES['gambar3'])) {
            array_push($image_array, $_FILES['gambar3']);
        }
        if (isset($_FILES['gambar4'])) {
            array_push($image_array, $_FILES['gambar4']);
        }

        $images = [];
        foreach ($image_array as $image) {
            if (!empty($image)) {
                $upload = image_upload($image, '1', "assets/images/backend/properti/");
                $image_name = $upload[0];
            } else {
                $image_name = "";
            }
            array_push($images, $image_name);
        }
        foreach ($images as $each) {
            $params_image = array("image" => $each, "properti_id" => $id);
            $dest_table_image = 'properti_images';
            $add = $this->data_model->add($params_image, $dest_table_image);
        }


        if ($update['response'] == OK_STATUS OR $add['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/properti/detail/' . $id);
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
        $params_delete->table = 'properti';
        $delete = $this->data_model->delete($params_delete);
        if ($delete['response'] == OK_STATUS) {
            $result = response_success();
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

}
