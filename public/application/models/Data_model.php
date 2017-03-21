<?php

class data_model extends CI_Model {

    public function get($params) {

        /* This Function Parameter 
          $params = new stdClass();
          $params->dest_table_as = 'table_name';
          $params->select_values = array();
          $params->join_tables = array();
         */

        $select_values = $params->select_values;
        $dest_table_as = $params->dest_table_as;
        $join_tables = $params->join_tables;
        $where_tables = $params->where_tables;
        $or_where_tables = $params->or_where_tables;
        foreach ($select_values as $each_select) {
            $select[] = $this->db->select($each_select);
        }
        $from = $this->db->from($dest_table_as);
        if ((isset($join_tables)) OR $join_tables != "") {
            foreach ($join_tables as $each_join) {
                $join = $this->db->join($each_join['join_with'], $each_join['join_on'], $each_join['join_type']);
            }
        }
        if ((isset($where_tables)) OR $where_tables != "") {
            foreach ($where_tables as $each_where) {
                $where = $this->db->where($each_where['where_column'], $each_where['where_value']);
            }
        }
        if ((isset($or_where_tables)) OR $or_where_tables != "") {
            foreach ($or_where_tables as $each_where) {
                $or_where = $this->db->or_where($each_where['where_column'], $each_where['where_value']);
            }
        }
        $query = $this->db->get();
        $res = $query->result();
        if ($query == TRUE) {
            $response = OK_STATUS;
            $data = array("response" => $response, "results" => $res);
        } else {
            $response = FAIL_STATUS;
            $data = array("response" => $response, "results" => $res);
        }
        return $data;
    }

    public function add($params, $dest_table) {

        /*
          This Function Parameter
          $params = array() for insert;
          $dest_table_as = 'table_name' for insert;
         */

        $query = $this->db->insert($dest_table, $params);
        if ($query == TRUE) {
            $res = $this->db->insert_id();
            $response = OK_STATUS;
            $data = array("response" => $response, "tpq_id" => $res);
        } else {
            $response = FAIL_STATUS;
            $data = array("response" => $response, "tpq_id" => "");
        }
        return $data;
    }

    public function update($params) {

        /*
          This Function Parameter
          $params = array() for update;
          $dest_table_as = 'table_name' for update;
         */

        $query = $this->db->set($params->new_data);
        foreach ($params->where_tables as $each_where) {
            $where = $this->db->where($each_where['where_column'], $each_where['where_value']);
        }
        $update = $this->db->update($params->table_update);
        if ($query == TRUE) {
            $response = OK_STATUS;
            $data = array("response" => $response,);
        } else {
            $response = FAIL_STATUS;
            $data = array("response" => $response, "results" => $this->db->last_query());
        }
        return $data;
    }

    public function delete($params) {
        $where = $params->where_tables;
        $table = $params->table;
        if ((isset($where)) OR $where != "") {
            foreach ($where as $each_where) {
                $where = $this->db->where($each_where['where_column'], $each_where['where_value']);
            }
        }
        $query = $this->db->delete($table);
        if ($query == TRUE) {
            $response = OK_STATUS;
            $data = array("response" => $response,);
        } else {
            $response = FAIL_STATUS;
            $data = array("response" => $response);
        }
        return $data;
    }

}
