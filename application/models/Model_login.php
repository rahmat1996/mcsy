<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Author by Rahmat1996
 */
class Model_login extends CI_Model {

    var $tabel = 'users';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function cekUser($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->where('blokir', 'n');
        $query = $this->db->get($this->tabel);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    function update_password($id) {
        $data = array(
            'password' => $this->input->post('new_pass')
        );
        $where = array(
            'idusers' => $id
        );
        $this->db->where($where);
        $update = $this->db->update($this->tabel, $data);
        if ($update) {
            return 1;
        } else {
            return 0;
        }
    }

}
