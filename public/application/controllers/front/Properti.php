<?php

include 'Front.php';

class properti extends front {

    function __construct() {
        parent::__construct();
        $this->data['active_page'] = "properti";
    }

    public function get_kat_properti() {
        $params = new stdClass();
        $params->dest_table_as = 'kategori_properti as kat';
        $params->select_values = array('kat.id as id', 'kat.name as nama');
        $get = $this->data_model->get($params);
        if ($get['results'] != "") {
            foreach ($get['results'] as $each) {
                $params_properti = new stdClass();
                $params_properti->dest_table_as = 'properti as p';
                $params_properti->select_values = array('p.id as id');
                $params_properti->where_tables = array(array("where_column" => 'p.kat_properti', "where_value" => $each->id));
                $get_properti = $this->data_model->get($params_properti);
                $count_properti_this_kat = count($get_properti['results']);
                $kat_array[] = array("id" => $each->id, "name" => $each->nama, "properti_total" => $count_properti_this_kat);
            }
        }
        return $kat_array;
    }

    public function get_kat_properti_by_id($id) {
        $params = new stdClass();
        $params->dest_table_as = 'kategori_properti as kat';
        $params->select_values = array('kat.id as id', 'kat.name as nama');
        $params->where_tables = array(array("where_column" => 'kat.id', "where_value" => $id));
        $get = $this->data_model->get($params);
        return $get["results"];
    }

    public function get_related_properti($kat_id) {
        $params = new stdClass();
        $params->dest_table_as = 'properti as p';
        $params->select_values = array('p.id,p.judul,p.link, p.deskripsi,p.tgl_dipasang, kp.name as kategori_properti,p.video_url');
        $join_data1 = array("join_with" => 'kategori_properti as kp', "join_on" => 'p.kat_properti = kp.id', "join_type" => '');
        $params->join_tables = array($join_data1);
        $order_by1 = array("order_column" => 'p.id', "order_type" => 'DESC');
        $params->order_by = array($order_by1);
        $where1 = array("where_column" => 'p.kat_properti', "where_value" => $kat_id);
        $params->where_tables = array($where1);
        $params->limit = '4';
        $get = $this->data_model->get($params);
        if ($get["results"] != "") {
            foreach ($get["results"] as $each) {
                $params_image = new stdClass();
                $params_image->dest_table_as = 'properti_images as pi';
                $params_image->select_values = array('pi.image');
                $where1 = array("where_column" => 'pi.properti_id', "where_value" => $each->id);
                $params_image->where_tables = array($where1);
                $params_image->limit = '1';
                $get_image = $this->data_model->get($params_image);
                $array_properti[] = array("id" => $each->id, "judul" => $each->judul, "link" => $each->link, "deskripsi" => $each->deskripsi, "tgl_dipasang" => $each->tgl_dipasang, "kategori_properti" => $each->kategori_properti, "image" => $get_image["results"][0]->image);
            }
        } else {
            $array_properti = [];
        }
        return $array_properti;
    }

    public function get_artikel() {
        $params = new stdClass();
        $params->dest_table_as = 'artikel as a';
        $params->select_values = array('a.*');
        $params->limit = '4';
        $order_by = array("order_column" => "a.id", "order_type" => "DESC");
        $params->order_by = array($order_by);
        $get = $this->data_model->get($params);
        return $get["results"];
    }

    public function get_properti_images($id_properti) {
        $params = new stdClass();
        $params->dest_table_as = 'properti_images as pi';
        $params->select_values = array('pi.*');
        $params->where_tables = array(array("where_column" => 'pi.properti_id', "where_value" => $id_properti));
        $get = $this->data_model->get($params);
        $array = [];
        foreach ($get['results'] as $each) {
            array_push($array, $each->image);
        }
        return $array;
    }

    public function kategori() {
        $parameter = $this->uri->segment(3);
        if ($parameter == "" OR empty($parameter)) {
            parent::notfound();
        } else {
            $params = new stdClass();
            $params->dest_table_as = 'kategori_properti as kp';
            $params->select_values = array('*');
            $params->where_tables = array(array("where_column" => 'kp.name', "where_value" => $parameter));
            $get = $this->data_model->get($params);
            if ($get["results"][0] == "") {
                redirect('notfound');
                exit();
            }
            $id_properti = $get["results"][0]->id;
            $params_properti = new stdClass();
            $params_properti->dest_table_as = 'properti as p';
            $params_properti->select_values = array('p.*');
            $order_by1 = array("order_column" => 'p.id', "order_type" => 'DESC');
            $params_properti->order_by = array($order_by1);
            $params_properti->where_tables = array(array("where_column" => 'p.kat_properti', "where_value" => $id_properti));
            $get_properti = $this->data_model->get($params_properti);

            if ($get_properti["results"] != "") {
                foreach ($get_properti["results"] as $each) {
                    $new_params = new stdClass();
                    $new_params->dest_table_as = 'properti_images as pi';
                    $new_params->select_values = array('pi.image');
                    $where = array("where_column" => 'pi.properti_id', "where_value" => $each->id);
                    $new_params->where_tables = array($where);
                    $get_images = $this->data_model->get($new_params);
                    if (!empty($get_images['results'])) {
                        $image = base_url() . 'assets/images/backend/properti/' . $get_images['results'][0]->image;
                    } else {
                        $image = base_url() . 'assets/images/backend/noimg.png';
                    }
                    $properti_images_data[] = array("id_properti" => $each->id, "properti_link" => $each->link, "judul_properti" => $each->judul, "deskripsi" => $each->deskripsi, "harga" => $each->harga, "image_properti_thumb" => $image);
                }
            } else {
                $properti_images_data = [];
            }
            if (!isset($properti_images_data)) {
                $properti_images_data = [];
            }
            $this->data['title_page'] = $get["results"][0]->name;
            $this->data['properti_list'] = $properti_images_data;
            $this->load->view("front/properti/kategori_properti", $this->data);
        }
    }

    public function detail() {
        $parameter = $this->uri->segment(3);
        $params = new stdClass();
        $params->dest_table_as = 'properti as p';
        $params->select_values = array('p.*');
        $params->where_tables = array(array("where_column" => 'p.link', "where_value" => $parameter));
        $get = $this->data_model->get($params);
        if ($get["results"][0] != "") {
            $get_images = $this->get_properti_images($get['results'][0]->id);
            $get_kat_this_properti = $this->get_kat_properti_by_id($get['results'][0]->kat_properti);
            $this->data['kategori_data'] = $this->get_kat_properti();
            $this->data['artikel_data'] = $this->get_artikel();
            $this->data['properti_related'] = $this->get_related_properti($get["results"][0]->kat_properti);
            $this->data['title_page'] = $get['results'][0]->judul;
            $this->data['detail'] = array(
                "data_properti" => $get["results"][0],
                "kat_this_properti" => $get_kat_this_properti[0],
                "properti_thumb" => $get_images[0],
                "properti_images" => $get_images);
            $this->load->view("front/properti/detail_properti", $this->data);
        } else {
            redirect('notfound');
            exit();
        }
    }

}
