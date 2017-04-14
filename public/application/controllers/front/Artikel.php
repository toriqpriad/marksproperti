<?php

include 'Front.php';

class Artikel extends front {

    function __construct() {
        parent::__construct();
        $this->data['active_page'] = "artikel";        
    }

    public function all() {
        $this->data['title_page'] = "Artikel";
        $dest_table_as = 'artikel as a';
        $select_values = array('a.id', 'a.judul', 'a.link', 'a.content', 'a.tgl_post', 'a.gbr_thumb');
        $params = new stdClass();
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $get = $this->data_model->get($params);
        if ($get['results'] != "") {
            $this->data['record'] = $get['results'];
        } else {
            $this->data['record'] = [];
        }
        $this->load->view('front/artikel/all', $this->data);
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

    public function get_properti() {
        $params = new stdClass();
        $params->dest_table_as = 'properti as p';
        $params->select_values = array('p.id,p.judul,p.link, p.deskripsi,p.tgl_dipasang, kp.name as kategori_properti,p.video_url');
        $join_data1 = array("join_with" => 'kategori_properti as kp', "join_on" => 'p.kat_properti = kp.id', "join_type" => '');
        $params->join_tables = array($join_data1);
        $order_by1 = array("order_column" => 'p.id', "order_type" => 'DESC');
        $params->order_by = array($order_by1);
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
                if (empty($get_image['results'][0]->image)) {
                    $image = "";
                } else {
                    $image = $get_image["results"][0]->image;
                }
                $array_properti[] = array("id" => $each->id, "judul" => $each->judul, "link" => $each->link, "deskripsi" => $each->deskripsi, "tgl_dipasang" => $each->tgl_dipasang, "kategori_properti" => $each->kategori_properti, "image" => $image);
            }
        } else {
            $array_properti = [];
        }
        return $array_properti;
    }

    public function detail() {
        $parameter = $this->uri->segment(3);
        $params = new stdClass();
        $params->dest_table_as = 'artikel as a';
        $params->select_values = array('a.*');
        $params->where_tables = array(array("where_column" => 'a.link', "where_value" => $parameter));
        $get = $this->data_model->get($params);
        if ($get["results"][0]) {
            $check_thumb = file_exists("assets/images/backend/artikel/" . $get["results"][0]->gbr_thumb);
            if (!$check_thumb) {
                $get["results"][0]->gbr_thumb = "";
            }
            $this->data['title_page'] = $get["results"][0]->judul;
            $this->data['artikel_data'] = $this->get_artikel();
            $this->data['kategori_data'] = $this->get_kat_properti();
            $this->data['properti_data'] = $this->get_properti();
            $this->data['detail'] = $get["results"][0];
            $this->load->view("front/artikel/detail_artikel", $this->data);
        } else {
            redirect('/notfound');
        }
    }

}
