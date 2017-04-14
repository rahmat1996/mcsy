<?php

defined('BASEPATH') or exit('No direct script allowed');

/**
 * Author by Rahmat1996
 */
class Model_monitoring extends CI_Model {

    public $tabel_cctv = 'cctv';
    public $tabel_monitoring = 'monitoring';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_data() {
        $month = date('m');
        $year = date('Y');
        // Kalau data bulan di pilih
        if ($this->input->post('month')) {
            $month = $this->input->post('month');
        }
        // kalau data tahun di pilih
        if ($this->input->post('year')) {
            $year = $this->input->post('year');
        }
        //$cctv = $this->db->query("SELECT *.cctv,model.nm_model FROM cctv INNER JOIN model ON cctv.model = model.id_model")->result();
        $this->db->select('cctv.*,model.nm_model,location.location,type.nm_type,recorder.nm_recorder');
        $this->db->join('model', 'cctv.model = model.id_model'); // join data model
        $this->db->join('location', 'cctv.location = location.id_location'); // join data location
        $this->db->join('type', 'cctv.type = type.id_type'); // type
        $this->db->join('recorder', 'cctv.recorder = recorder.id_recorder');
        $this->db->group_by('id_cctv', 'ASC');

        $cctv = $this->db->get('cctv')->result();

        $sql_monitoring = "SELECT * FROM monitoring WHERE id_cctv = ? AND month(date_monitoring) = ? AND year(date_monitoring) = ?";

        $sql_holiday = "SELECT * FROM holiday WHERE month(date_holiday) = ? AND year(date_holiday) = ?";

        $jumHari = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($a = 0; $a < count($cctv); $a++) {
            $monitoring = $this->db->query($sql_monitoring, array($cctv[$a]->id_cctv, $month, $year))->result();
            $cctv[$a]->monitoring = $monitoring;

            $holiday = $this->db->query($sql_holiday, array($month, $year))->result();
            $cctv[$a]->holiday = $holiday;
        }

        return $cctv;
    }

    public function get_edit($id) {
        $this->db->select('*');
        $query = $this->db->get_where($this->tabel_monitoring, array('id_monitoring' => $id), 0, 1);
        return $query->result();
    }

    public function get_cctv() {
        $this->db->select('id_cctv,ip');
        $query = $this->db->get($this->tabel_cctv);
        return $query->result();
    }

    public function insert_data() {
        $data = array(
            'id_monitoring' => NULL,
            'id_cctv' => $this->input->post('id_cctv'),
            'date_monitoring' => $this->input->post('date_monitoring'),
            'status' => $this->input->post('status'),
            'remark' => $this->input->post('remark')
        );
        $insert = $this->db->insert($this->tabel_monitoring, $data);
        if ($insert) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update_data() {

        $data = array(
            'id_cctv' => $this->input->post('id_cctv'),
            'date_monitoring' => $this->input->post('date_monitoring'),
            'status' => $this->input->post('status'),
            'remark' => $this->input->post('remark'),
        );
        $where = array(
            'id_monitoring' => $this->input->post('id')
        );
        $this->db->where($where);
        $update = $this->db->update($this->tabel_monitoring, $data);

        if ($update) {
            return 1;
        } else {
            return 0;
        }
    }

    public function delete_data($id) {
        $where = array('id_monitoring' => $id);
        $delete = $this->db->delete($this->tabel_monitoring, $where);
        if ($delete) {
            return 1;
        } else {
            return 0;
        }
    }

}
