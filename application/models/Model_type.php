<?php

defined('BASEPATH') or exit('No direct script allowed!');

/**
 * Created by MiniProgrammer
 */
class Model_type extends CI_Model {

    var $table = 'type';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($limit, $start = 0) {
        if (!empty($_GET['param'])) {
            $this->db->like('nm_type', trim($_GET['param']));
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function count_all() {
        if (!empty($_GET['param'])) {
            $this->db->like('nm_type', trim($_GET['param']));
        }
        return $this->db->count_all_results($this->table);
    }

    public function get_edit($id) {
        $this->db->where('id_type', $id);
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function insert_data() {
        $data = array(
            'nm_type' => $this->input->post('type'),
            'ket' => $this->input->post('ket')
        );
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function update_data() {
        $data = array(
            'nm_type' => $this->input->post('type'),
            'ket' => $this->input->post('ket')
        );
        $this->db->where('id_type', $this->input->post('id'));
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_data($id) {
        $this->db->where('id_type', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

}
