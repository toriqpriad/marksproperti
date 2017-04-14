<?php

include 'Front.php';

class home extends front {

    function __construct() {
        parent::__construct();
        $this->data['title_page'] = "Marksproperti";
    }

    private function search_in_table($key, $table_name) {
        $dest_table_as = $table_name;
        $select_values = array('*');
        $params = new stdClass();
        $where1 = array("where_column" => 'judul', "where_value" => $key);
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $params->where_tables_like = array($where1);
        $get = $this->data_model->get($params);
        if ($get['response'] == OK_STATUS) {
            $total = $get["results"];
        } else {
            $total = [];
        }
        return $total;
    }

    public function get_properti_slide() {
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

    private function get_properti_newest($limit) {
        $params = new stdClass();
        $params->dest_table_as = 'properti as p';
        $params->select_values = array('p.judul, p.deskripsi,p.tgl_dipasang,p.video_url');
        $order_by1 = array("order_column" => 'p.id', "order_type" => 'DESC');
        $params->order_by = array($order_by1);
        $params->limit = $limit;
        $get = $this->data_model->get($params);
        return $get["results"];
    }

    private function get_properti_and_image_newest($limit) {
//        $params = new stdClass();
//        $params->dest_table_as = 'properti as p';
//        $params->select_values = array('p.judul, p.link, p.harga, p.deskripsi,p.tgl_dipasang,pi.image, kp.name as kategori_properti,p.video_url');
//        $join_data1 = array("join_with" => 'properti_images as pi', "join_on" => 'pi.properti_id = p.id', "join_type" => '');
//        $join_data2 = array("join_with" => 'kategori_properti as kp', "join_on" => 'p.kat_properti = kp.id', "join_type" => '');
//        $params->join_tables = array($join_data1, $join_data2);
//        $order_by1 = array("order_column" => 'p.id', "order_type" => 'DESC');
//        $params->order_by = array($order_by1);
//        $params->limit = $limit;
//        $get = $this->data_model->get($params);
//        return $get["results"];
        $params = new stdClass();
        $params->dest_table_as = 'properti as p';
        $params->select_values = array('p.id,p.judul,p.link, p.harga, p.deskripsi,p.tgl_dipasang, kp.name as kategori_properti,p.video_url');
        $join_data1 = array("join_with" => 'kategori_properti as kp', "join_on" => 'p.kat_properti = kp.id', "join_type" => '');
        $params->join_tables = array($join_data1);
        $order_by1 = array("order_column" => 'p.id', "order_type" => 'DESC');
        $params->order_by = array($order_by1);
        $params->limit = $limit;
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
                $array_properti[] = array("id" => $each->id, "judul" => $each->judul, "harga" => $each->harga, "link" => $each->link, "deskripsi" => $each->deskripsi, "tgl_dipasang" => $each->tgl_dipasang, "kategori_properti" => $each->kategori_properti, "image" => $image);
            }
        } else {
            $array_properti = [];
        }
        return $array_properti;
    }

    private function get_artikel_newest() {
        $params = new stdClass();
        $params->dest_table_as = 'artikel as a';
        $params->select_values = array('a.*');
        $order_by1 = array("order_column" => 'a.id', "order_type" => 'DESC');
        $params->order_by = array($order_by1);
        $params->limit = '4';
        $get = $this->data_model->get($params);
        return $get["results"];
    }

    private function get_images_newest() {
        $params = new stdClass();
        $params->dest_table_as = 'properti as p';
        $params->select_values = array('p.id, p.judul');
        $params->limit = '3';
        $get = $this->data_model->get($params);
        if ($get["results"] != "") {
            foreach ($get["results"] as $each) {
                $new_params = new stdClass();
                $new_params->dest_table_as = 'properti_images as pi';
                $new_params->select_values = array('pi.image');
                $where = array("where_column" => 'pi.properti_id', "where_value" => $each->id);
                $new_params->where_tables = array($where);
                $get_images = $this->data_model->get($new_params);
                $array_image = [];
                if ($get_images['results'] != "") {
                    foreach ($get_images['results'] as $image) {
                        array_push($array_image, $image->image);
                    }
                }
                if ($get_images['results'] != "") {
                    $properti_images_data[] = array("id_properti" => $each->id, "judul_properti" => $each->judul, "images_properti" => $array_image);
                }
            }
        } else {
            $properti_images_data = [];
        }
        return $properti_images_data;
    }

    public function index() {
        $this->data['newest_slide_properti'] = $this->get_properti_slide();
        $this->data['newest_properti'] = $this->get_properti_and_image_newest('6');
//        print_r($this->data['newest_properti']);exit();
        $this->data['newest_artikel'] = $this->get_artikel_newest();
        $this->data['newest_images'] = $this->get_images_newest();
        $this->data['newest_properti_video'] = $this->get_properti_newest('4');
        $this->load->view('front/index', $this->data);
    }

    public function konsultan_projek() {
        $this->data['title_page'] = "Konsultan Projek";
        $this->load->view('front/konsultan_projek/konsultan_projek', $this->data);
    }

    public function tentang_kami() {
        $this->data['title_page'] = "Tentang Kami";
        $this->load->view('front/tentang_kami/tentang', $this->data);
    }

    public function search_submit() {
        $key = $this->input->post('key');
        $this->data['title_page'] = "Hasil pencarian '" . $key . "'";
        $this->data['key'] = $key;
        $search_in_properti = $this->search_in_table($key, 'properti');
        if ($search_in_properti != "") {
            foreach ($search_in_properti as $each) {
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
                $properti_images_data[] = array("id" => $each->id, "link" => $each->link, "harga" => $each->harga, "judul" => $each->judul, "deskripsi" => $each->deskripsi, "image" => $image);
            }
        } else {
            $properti_images_data = [];
        }
        if (!isset($properti_images_data)) {
            $properti_images_data = [];
        }
        $this->data['search_in_properti'] = $properti_images_data;
        $this->data['search_in_artikel'] = $this->search_in_table($key, 'artikel');
        $this->load->view('front/search_result', $this->data);
    }

}
