<?php

include 'Front.php';

class Galeri extends front {

    function __construct() {
        parent::__construct();
        $this->data['active_page'] = "galeri";
    }

    public function get_properti_images($id_properti) {
        $params = new stdClass();
        $params->dest_table_as = 'properti_images as pi';
        $params->select_values = array('pi.*');
        $params->join_tables = array();
        $params->where_tables = array(array("where_column" => 'pi.properti_id', "where_value" => $id_properti));
        $params->or_where_tables = array();
        $get = $this->data_model->get($params);
        $array = [];
        foreach ($get['results'] as $each) {
            array_push($array, $each->image);
        }
        return $array;
    }

    public function foto() {
        $this->data['title_page'] = "Foto";
        $params = new stdClass();
        $dest_table_as = 'properti_images as p';
        $select_values = array('p.id', 'p.image', 'p.properti_id');
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $get = $this->data_model->get($params);
        $images_array = [];
        if ($get["results"] != "") {
            foreach ($get["results"] as $each) {
                $params_title = new stdClass();
                $dest_table_as = 'properti as p';
                $select_values = array('p.id', 'p.judul', 'p.link');
                $params_title->dest_table_as = $dest_table_as;
                $params_title->select_values = $select_values;
                $get_title = $this->data_model->get($params_title);
                $images_array[] = array("title" => $get_title['results'][0]->judul, "image_name" => $each->image);
            }
        }
        $this->data['record'] = $images_array;

        $this->load->view('front/galeri/foto', $this->data);
    }

    public function portfolio() {
        $this->data['title_page'] = "Portfolio";
        $params = new stdClass();
        $dest_table_as = 'portfolio as p';
        $select_values = array('p.id', 'p.image', 'p.nama');
        $params->dest_table_as = $dest_table_as;
        $params->select_values = $select_values;
        $get = $this->data_model->get($params);
        $array = [];
        if ($get["response"] == OK_STATUS) {
            $array = $get['results'];
        }
        $this->data['record'] = $array;
        $this->load->view('front/galeri/portfolio', $this->data);
    }

    public function video() {
        $this->data['title_page'] = "Video";
        $params = new stdClass();
        $params->dest_table_as = 'properti as p';
        $params->select_values = array('p.video_url');
        $get = $this->data_model->get($params);
        $videos = [];
        if (!empty($get["results"][0])) {
            foreach ($get["results"] as $each) {
                array_push($videos, $each->video_url);
            }
            $this->data['record'] = $videos;
            $this->load->view("front/galeri/video", $this->data);
        } else {
            redirect('/notfound');
        }
    }

}
