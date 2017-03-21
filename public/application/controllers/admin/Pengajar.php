<?php

include 'Admin.php';

class pengajar extends admin {

    function __construct() {
        parent::__construct();
        parent::checkauth();
        $this->data['active_page'] = "pengajar";
        $this->load->model('pengajar_model');
    }

    public function get_tpq() {
        $params_tpq = new stdClass();
        $params_tpq->dest_table_as = 'tb_tpq as tpq';
        $params_tpq->select_values = array('tpq.id as id', 'tpq.nama as nama', 'tpq.wilayah as wilayah');
        $params_tpq->join_tables = array();
        $params_tpq->where_tables = array();
        $params_tpq->or_where_tables = array();
        $tpq = $this->pengajar_model->get($params_tpq);
        return $tpq;
    }

    public function get_kat_pgrs() {
        $params_kat_pgrs = new stdClass();
        $params_kat_pgrs->dest_table_as = 'tb_kategori_pengurus_tpq';
        $params_kat_pgrs->select_values = array('*');
        $params_kat_pgrs->join_tables = array();
        $params_kat_pgrs->where_tables = array();
        $params_kat_pgrs->or_where_tables = array();
        $get_kat_pgrs = $this->pengajar_model->get($params_kat_pgrs);
        return $get_kat_pgrs;
    }

    //Data on Page
    public function data() {
        $this->data['title_page'] = "Data Pengajar";
        $dest_table_as = 'tb_pengajar as pengajar';
        $select_values = array('pengajar.id', 'pengajar.nama', 'pengajar.kelamin', 'pengajar.kontak', 'pengajar.alamat', 'pengajar.email', 'tpq.nama as nama_tpq', 'pc.nama as nama_pc', 'pengajar.link', 'pengajar.status', 'tpq.wilayah', 'pengajar.aktif');
        $join_data1 = array("join_with" => 'tb_tpq as tpq', "join_on" => 'pengajar.id_tpq = tpq.id', "join_type" => '');
        $join_data2 = array("join_with" => 'tb_pc as pc', "join_on" => 'tpq.id_pc = pc.id', "join_type" => '');
        $join_tables = array($join_data1, $join_data2);
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $params->join_tables = $join_tables;
        $params->where_tables = array();
        $params->or_where_tables = array();
        $get = $this->pengajar_model->get($params);
        if ($get['results'] != "") {
            foreach ($get['results'] as $each) {
                $datas['id'] = $each->id;
                $datas['nama'] = $each->nama;
                $datas['kelamin'] = $each->kelamin;
                $datas['kontak'] = $each->kontak;
                $datas['alamat'] = $each->alamat;
                $datas['email'] = $each->email;
                $datas['nama_tpq'] = $each->nama_tpq;
                $datas['wilayah'] = $each->wilayah;
                $datas['nama_pc'] = $each->nama_pc;
                $datas['status'] = $each->status;
                $datas['aktif'] = $each->aktif;
                $datas['link'] = base_url() . 'admin/pengajar/detail/' . $each->link;
                $record[] = $datas;
            }
            if (isset($record)) {
                $this->data['record'] = $record;
            } else {
                $this->data['record'] = '';
            }
        } else {
            $this->data['record'] = '';
        }


        $this->load->view('admin/pengajar/data', $this->data);
    }

    public function detail() {
        $parameter = $this->uri->segment(4);
        $params = new stdClass();
        $params->dest_table_as = 'tb_pengajar as p';
        $params->select_values = array('p.*');
        $params->join_tables = array(array("join_with" => 'tb_tpq as t', "join_on" => 'p.id_tpq = t.id', "join_type" => ''));
        $params->where_tables = array(array("where_column" => 'p.link', "where_value" => $parameter));
        $params->or_where_tables = array();
        $get = $this->pengajar_model->get($params);
        if ($get["results"][0] != "") {
            $get_tpq = $this->get_tpq();
            $this->data['title_page'] = "Detail Pengajar";
            $this->data['detail'] = array("data_pengajar" => $get["results"], "data_tpq" => $get_tpq["results"]);
            $this->load->view("admin/pengajar/detail", $this->data);
        } else {
            redirect('/admin/404');
        }
    }

    public function add() {
        $tpq = $this->get_tpq();
        if ($tpq['response'] == OK_STATUS) {
            $this->data['tpq'] = $tpq['results'];
        } else {
            $this->data['tpq'] = "";
        }
        $this->data['title_page'] = "Tambah Data Pengajar";
        $this->load->view('admin/pengajar/add', $this->data);
    }

    //Data Processing

    public function add_submit() {
        $nama = $this->input->post("nama");
        $kelamin = $this->input->post("kelamin");
        $tmp_lhr = $this->input->post("tmp_lahir");
        $tgl_lhr = $this->input->post("tgl_lahir");
        $pkwn = $this->input->post("pkwn");
        $sts = $this->input->post("sts");
        $tpq = $this->input->post("tpq");
        $kontak = $this->input->post("kontak");
        $alamat = $this->input->post("alamat");
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $link = str_replace('.', '', $nama);
        $link = str_replace("'", '', $link);
        $link = str_replace('"', '', $link);
        $link = str_replace('-', '', $link);
        $link = str_replace(' ', '', $link);
        $link = strtolower($link);
        $link = substr($link, 0, 10);
        $pdkn = $this->input->post("pdkn");
        $pdkn_ket = $this->input->post("pdkn_ket");

        $params_email = new stdClass();
        $params_email->dest_table_as = 'tb_pengajar as p';
        $params_email->select_values = array('p.email');
        $where_data = array("where_column" => 'p.email', "where_value" => $email);
        $params_email->where_tables = array($where_data);
        $params_email->join_tables = array();
        $params_email->or_where_tables = array();
        $check = $this->pengajar_model->get($params_email);
        if (!empty($check['results'])) {
            $params = new stdClass();
            $params->response = FAIL_STATUS;
            $params->message = "Email sudah digunakan !";
            $params->data = "";
            $result = response_custom($params);
            echo json_encode($result);
            exit();
        }

        //CHECK NAME
        $params_check = new stdClass();
        $params_check->dest_table_as = 'tb_pengajar as p';
        $params_check->select_values = array('p.link', 'p.id');
        $where_data = array("where_column" => 'p.link', "where_value" => $link);
        $params_check->where_tables = array($where_data);
        $params_check->join_tables = array();
        $params_check->or_where_tables = array();
        $check = $this->pengajar_model->get($params_check);
        if (!empty($check['results'])) {
            $params = new stdClass();
            $params->response = FAIL_STATUS;
            $params->message = "Nama sudah digunakan !";
            $params->data = "";
            $result = response_custom($params);
            echo json_encode($result);
            exit();
        }


        $params_data = array(
            "nama" => $nama,
            "id_tpq" => $tpq,
            "link" => $link,
            "email" => $email,
            "kontak" => $kontak,
            "alamat" => $alamat,
            "kelamin" => $kelamin,
            "tmp_lahir" => $tmp_lhr,
            "tgl_lahir" => $tgl_lhr,
            "pdkn" => $pdkn,
            "pdkn_ket" => $pdkn_ket,
            "status" => $sts,
            "pkwn" => $pkwn,
            "aktif" => ACTIVE_CONTENT_STATUS,
            "tgl_buat" => date("Y-m-d"),
            "dibuat_oleh" => "admin");
        $dest_table = 'tb_pengajar';
        $add = $this->pengajar_model->add($params_data, $dest_table);
        $id = $add["id"];
        $params_account = array("username" => $email, "password" => $password, "level" => 'P', "id_level" => $id);
        $dest_table_account = 'tb_akun';
        $add_account = $this->pengajar_model->add($params_account, $dest_table_account);

        if (isset($_FILES["foto"])) {
            if ($_FILES["foto"] != "") {
                $upload = image_upload($_FILES["foto"], '1', "assets/images/backend/tpq/" . $tpq . "/pengajar/");
                $image_name = $upload[0];
            } else {
                $image_name = "";
            }
        } else {
            $image_name = "";
        }

        $params_update = new stdClass();
        $params_update->new_data = array("foto" => $image_name);
        $params_update->table_update = 'tb_pengajar';
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_update->where_tables = array($where);
        $update = $this->pengajar_model->update($params_update);
        if ($add['response'] == OK_STATUS AND $add_account['response'] == OK_STATUS) {
            $data = array("link" => base_url() . 'admin/pengajar/detail/' . $link);
            $result = get_success($data);
        } else {
            $result = response_fail();
        }

        echo json_encode($result);
    }

    public function update_submit() {
        $id = $this->input->post("id");
        $nama = $this->input->post("nama");
        $kelamin = $this->input->post("kelamin");
        $tmp_lhr = $this->input->post("tmp_lahir");
        $tgl_lhr = $this->input->post("tgl_lahir");
        $pkwn = $this->input->post("pkwn");
        $sts = $this->input->post("sts");
        $tpq = $this->input->post("tpq");
        $old_tpq = $this->input->post("old_tpq");
        $kontak = $this->input->post("kontak");
        $alamat = $this->input->post("alamat");
        $email = $this->input->post("email");
        $old_foto = $this->input->post("old_foto");
        $password = $this->input->post("password");
        $link = str_replace('.', '', $nama);
        $link = str_replace("'", '', $link);
        $link = str_replace('"', '', $link);
        $link = str_replace('-', '', $link);
        $link = str_replace(' ', '', $link);
        $link = strtolower($link);
        $link = substr($link, 0, 10);
        $pdkn = $this->input->post("pdkn");
        $pdkn_ket = $this->input->post("pdkn_ket");
//        print_r(array($nama, $link, $kelamin, $tmp_lhr, $tgl_lhr, $tpq, $kontak, $pkwn, $status, $alamat, $email, $password, $link, $pdkn_ket, $pdkn));
//        exit();
        //CHECK NAME
        $params_check = new stdClass();
        $params_check->dest_table_as = 'tb_pengajar as p';
        $params_check->select_values = array('p.link', 'p.id');
        $where_data = array("where_column" => 'p.link', "where_value" => $link);
        $params_check->where_tables = array($where_data);
        $params_check->join_tables = array();
        $params_check->or_where_tables = array();
        $check = $this->pengajar_model->get($params_check);
        if (!empty($check['results'])) {
            if ($check['results'][0]->id != $id) {
                $params = new stdClass();
                $params->response = FAIL_STATUS;
                $params->message = "Nama sudah digunakan !";
                $params->data = "";
                $result = response_custom($params);
                echo json_encode($result);
                exit();
            }
        }

        // CHECK EMAIL
        $params_check = new stdClass();
        $params_check->dest_table_as = 'tb_pengajar as p';
        $params_check->select_values = array('p.email', 'p.id');
        $where_data = array("where_column" => 'p.email', "where_value" => $email);
        $params_check->where_tables = array($where_data);
        $params_check->join_tables = array();
        $params_check->or_where_tables = array();
        $check = $this->pengajar_model->get($params_check);
        if (!empty($check['results'])) {
            if ($check['results'][0]->id != $id) {
                print_r($check['results'][0]->id);
                print_r($id);
                $params = new stdClass();
                $params->response = FAIL_STATUS;
                $params->message = "Email sudah digunakan !";
                $params->data = "";
                $result = response_custom($params);
                echo json_encode($result);
                exit();
            }
        }

        //Update Data
        $params_data = new stdClass();
        $params_data->new_data = array(
            "nama" => $nama,
            "id_tpq" => $tpq,
            "link" => $link,
            "email" => $email,
            "kontak" => $kontak,
            "alamat" => $alamat,
            "kelamin" => $kelamin,
            "tmp_lahir" => $tmp_lhr,
            "tgl_lahir" => $tgl_lhr,
            "pdkn" => $pdkn,
            "pdkn_ket" => $pdkn_ket,
            "status" => $sts,
            "pkwn" => $pkwn,
            "aktif" => ACTIVE_CONTENT_CAPTION,
            "tgl_buat" => date("Y-m-d"),
            "dibuat_oleh" => "admin");
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_data->where_tables = array($where);
        $params_data->table_update = 'tb_pengajar';
        $update_tpq = $this->pengajar_model->update($params_data);

        $params_account = new stdClass();
        if ($password != '') {
            $params_account->new_data = array("username" => $email, "password" => $password);
        } else {
            $params_account->new_data = array("username" => $email);
        }
        $where1 = array("where_column" => 'level', "where_value" => 'P');
        $where2 = array("where_column" => 'id_level', "where_value" => $id);
        $params_account->where_tables = array($where1, $where2);
        $params_account->table_update = 'tb_akun';
        $update_account = $this->pengajar_model->update($params_account);
//        if ($tpq != $old_tpq) {
//            $tpq = $tpq;
//        } else {
//            $tpq = $old_tpq;
//        }
        if (isset($_FILES["foto"])) {
            if (!empty($_FILES["foto"]["name"])) {
                $upload = image_upload($_FILES["foto"], '1', "assets/images/backend/tpq/" . $tpq . "/pengajar/");
                if ($tpq != $old_tpq) {
                    $old_dir = './assets/images/backend/tpq/' . $old_tpq . '/pengajar/' . $old_foto;
                    $remove = unlink($old_dir);
                } else {
                    $old_dir = './assets/images/backend/tpq/' . $tpq . '/pengajar/' . $old_foto;
                    $remove = unlink($old_dir);
                }
                $image_name = $upload[0];
            } else {
                $image_name = $old_foto;
            }
        } else {
            if ($tpq != $old_tpq) {
                $old_dir = './assets/images/backend/tpq/' . $old_tpq . '/pengajar/' . $old_foto;
                $new_dir = './assets/images/backend/tpq/' . $tpq . '/pengajar/' . $old_foto;
                $remove = copy($old_dir, $new_dir);
                $remove = unlink($old_dir);
            }
            $image_name = $old_foto;
        }

        $params_update = new stdClass();
        $params_update->new_data = array("foto" => $image_name);
        $where = array("where_column" => 'id', "where_value" => $id);
        $params_update->where_tables = array($where);
        $params_update->table_update = 'tb_pengajar';
        $update_logo_cover = $this->pengajar_model->update($params_update);
        if ($update_tpq['response'] == OK_STATUS AND $update_account['response'] == OK_STATUS) {
//            $result = response_success();
            $params = new stdClass();
            $params->response = OK_STATUS;
            $params->message = OK_MESSAGE;
            $params->data = array('link' => base_url() . 'admin/pengajar/detail/' . $link);
            $result = response_custom($params);
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

    public function delete_submit() {
        $id = $this->uri->segment(4);
        $params_delete_pengajar = new stdClass();        
        $where1 = array("where_column" => 'id', "where_value" => $id);
        $params_delete_pengajar->where_tables = array($where1);
        $params_delete_pengajar->table = 'tb_pengajar';
        $delete_pengajar = $this->pengajar_model->delete($params_delete_pengajar);

        $params_delete_akun = new stdClass();
        $params_delete_akun->table = 'tb_akun';
        $where1 = array("where_column" => 'level', "where_value" => 'P');
        $where2 = array("where_column" => 'id_level', "where_value" => $id);
        $params_delete_akun->where_tables = array($where1, $where2);
        $delete_akun = $this->pengajar_model->delete($params_delete_akun);

        if ($delete_pengajar['response'] == OK_STATUS && $delete_akun['response'] == OK_STATUS) {
            $result = response_success();
        } else {
            $result = response_fail();
        }
        echo json_encode($result);
    }

}
