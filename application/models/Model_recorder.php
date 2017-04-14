<?php

defined('BASEPATH') or exit('No direct script allowed!');

/**
 * Create by MiniProgrammer
 */
class Model_recorder extends CI_Model {

    private $table = 'recorder';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($limit, $start = 0) {
        $this->db->select('*');
        if (!empty($_GET['param'])) {

            $this->db->like('nm_recorder', trim($_GET['param']));
        }
        $this->db->limit($limit, $start);
        $this->db->order_by('id_recorder', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function count_all() {
        if (!empty($_GET['param'])) {
            $this->db->like('nm_recorder', trim($_GET['param']));
        }

        return $this->db->count_all_results($this->table);
    }

    public function get_edit($id) {
        $this->db->select('*');
        $this->db->where('id_recorder', $id);
        $this->db->limit(1);
        return $this->db->get($this->table)->result();
    }

    public function insert_data() {
        $data = array
            (
            'nm_recorder' => $this->input->post('recorder'),
            'ket' => $this->input->post('ket')
        );
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    public function update_data() {
        $data = array
            (
            'nm_recorder' => $this->input->post('recorder'),
            'ket' => $this->input->post('ket')
        );
        $this->db->where('id_recorder', $this->input->post('id'));
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete_data($id) {
        $this->db->where('id_recorder', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

}
