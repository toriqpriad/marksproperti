<?php

include 'Front.php';

class vendor extends front {

    function __construct() {
        parent::__construct();
        $this->data['active_page'] = "vendor";
        $this->data['title_page'] = "vendor";
    }

    public function all() {
        $params = new stdClass();
        $params->dest_table_as = 'developer as d';
        $params->select_values = array('d.*');
        $get = $this->data_model->get($params);
        if ($get['results'] != "") {
            $this->data['record'] = $get['results'];
        } else {
            $this->data['record'] = [];
        }
        $this->load->view('front/vendor/all', $this->data);
    }

}
