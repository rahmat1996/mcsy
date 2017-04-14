<?php

defined('BASEPATH') or exit('No direct script allowed!');

/**
 * Author by Rahmat1996
 */
class Model_holiday extends CI_Model {

    public $tabel = 'holiday';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($limit, $start = 0) {
        $this->db->select('*');
        $this->db->limit($limit, $start);
        if (!empty($_GET['param'])) {
            $this->db->or_like('nm_holiday', $_GET['param']);
        }
        $this->db->order_by('id_holiday', 'DESC');
        $query = $this->db->get($this->tabel);
        return $query->result();
    }

    public function get_edit($id) {
        $this->db->select('*');
        $query = $this->db->get_where($this->tabel, array('id_holiday' => $id), 0, 1);
        return $query->result();
    }

    public function count_all() {
        $this->db->from($this->tabel);
        if (!empty($_GET['param'])) {
            $this->db->or_like('nm_holiday', $_GET['param']);
        }
        return $this->db->count_all_results();
    }

    public function insert_data() {
        $data = array(
            'id_holiday' => NULL,
            'nm_holiday' => $this->input->post('nm_holiday'),
            'date_holiday' => $this->input->post('date_holiday')
        );
        $insert = $this->db->insert($this->tabel, $data);
        if ($insert) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_data() {
        $data = array(
            'nm_holiday' => $this->input->post('nm_holiday'),
            'date_holiday' => $this->input->post('date_holiday'),
        );
        $where = array(
            'id_holiday' => $this->input->post('id')
        );
        $this->db->where($where);
        $update = $this->db->update($this->tabel, $data);
        if ($update) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete_data($id) {
        $where = array('id_holiday' => $id);
        $delete = $this->db->delete($this->tabel, $where);
        if ($delete) {
            return 1;
        } else {
            return 0;
        }
    }

}
