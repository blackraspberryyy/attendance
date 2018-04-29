<?php

class registration_model extends CI_Model {

    public function fetch($table, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by('student_lastname', 'DESC');
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetchasc_first($table, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by('student_lastname', 'asc');
        $this->db->limit(30);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function fetchasc_second($table, $where = NULL) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by('student_lastname', 'asc');
        $this->db->limit(20, 30);
        $query = $this->db->get($table);
        return ($query->num_rows() > 0 ) ? $query->result() : FALSE;
    }

    public function update($data, $where = NULL) {
        $table = "student";
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

}
