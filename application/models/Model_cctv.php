<?php

defined('BASEPATH') or exit('No direct script allowed');

/**
 * Author by Rahmat1996
 */
class Model_cctv extends CI_Model {

    var $tabel = 'cctv'; // Table Mysql
    var $tabel2 = 'model'; // table model
    var $tabel3 = 'location'; // table location
    var $tabel4 = 'type'; // table type
    var $tabel5 = 'recorder'; // table recorder

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($limit, $start = 0) {
        $this->db->select('cctv.*,model.nm_model,location.location,type.nm_type,recorder.nm_recorder');
        $this->db->join($this->tabel2, 'cctv.model = model.id_model', 'left');
        $this->db->join($this->tabel3, 'cctv.location = location.id_location', 'left');
        $this->db->join($this->tabel4, 'cctv.type = type.id_type', 'left');
        $this->db->join($this->tabel5, "$this->tabel.recorder = $this->tabel5.id_recorder", 'left');
        $this->db->limit($limit, $start);

        if (!empty($_GET['param'])) {
            $like = array(
                'ip' => trim($_GET['param']),
                'model.nm_model' => trim($_GET['param']),
                'location.location' => trim($_GET['param']),
                'type.nm_type' => trim($_GET['param']),
                'recorder' => trim($_GET['param'])
            );
            $this->db->or_like($like);
        }
        //$this->db->order_by('id_cctv', 'DESC');
        $this->db->group_by('id_cctv', 'DESC');
        $query = $this->db->get($this->tabel);
        return $query->result();
    }

    public function count_all() {
        //$this->db->select($this->tabel);
        $this->db->join($this->tabel2, 'cctv.model = model.id_model', 'left');
        $this->db->join($this->tabel3, 'cctv.location = location.id_location', 'left');
        $this->db->join($this->tabel4, 'cctv.type = type.id_type', 'left');
        $this->db->join($this->tabel5, "$this->tabel.recorder = $this->tabel5.id_recorder", 'left');
        if (!empty($_GET['param'])) {
            $like = array(
                'ip' => trim($_GET['param']),
                'model.nm_model' => trim($_GET['param']),
                'location.location' => trim($_GET['param']),
                'type.nm_type' => trim($_GET['param']),
                'recorder' => trim($_GET['param'])
            );
            $this->db->or_like($like);
        }
        return $this->db->count_all_results($this->tabel);
    }

    public function get_edit($id) {
        $this->db->select('*');
        $query = $this->db->get_where($this->tabel, array('id_cctv' => $id), 0, 1);
        return $query->result();
    }

    // get model cctv
    public function get_model() {
        $this->db->select('id_model,nm_model');
        $this->db->order_by('id_model', 'ASC');
        $query = $this->db->get($this->tabel2);
        return $query->result();
    }

    // get location cctv
    public function get_location() {
        $this->db->select('id_location,location');
        $this->db->order_by('id_location', 'ASC');
        $query = $this->db->get($this->tabel3);
        return $query->result();
    }

    public function get_type() {
        $this->db->select('id_type,nm_type');
        $this->db->order_by('id_type', 'ASC');
        $query = $this->db->get($this->tabel4);
        return $query->result();
    }

    public function get_recorder() {
        $this->db->select('id_recorder,nm_recorder');
        $this->db->order_by('id_recorder', 'ASC');
        return $this->db->get($this->tabel5)->result();
    }

    public function insert_data() {
        $data = array(
            'id_cctv' => NULL,
            'ip' => $this->input->post('ip'),
            'model' => $this->input->post('model'),
            'location' => $this->input->post('location'),
            'type' => $this->input->post('type'),
            'recorder' => $this->input->post('recorder')
        );
        $insert = $this->db->insert($this->tabel, $data);
        if ($insert) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_data($id) {
        $data = array(
            'ip' => $this->input->post('ip'),
            'model' => $this->input->post('model'),
            'location' => $this->input->post('location'),
            'type' => $this->input->post('type'),
            'recorder' => $this->input->post('recorder')
        );
        $where = array(
            'id_cctv' => $this->input->post('id')
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
        $where = array('id_cctv' => $id);
        $delete = $this->db->delete($this->tabel, $where);
        if ($delete) {
            return 1;
        } else {
            return 0;
        }
    }

}
