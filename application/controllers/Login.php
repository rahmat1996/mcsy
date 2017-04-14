<?php

defined('BASEPATH') OR exit("Tidak ada direct access!");

/**
 * Author By Rahmat1996
 */
class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_login', 'login');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('login/login');
    }

    public function verified() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->login->cekUser($username, $password);
        if (!empty($user)) {
            $session = array(
                'id' => $user[0]['idusers'],
                'username' => $user[0]['username'],
                'level' => $user[0]['level'],
                'name' => $user[0]['name'],
                'login' => TRUE
            );
            $this->session->set_userdata($session);
            redirect('monitoring');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger fade in"><a class="close" data-dismiss="alert" href="#">×</a>Incorrect Username or Password!</div>');
            redirect('login');
        }
    }

    public function logout() {
        $data = array('id', 'username', 'level', 'login');
        $this->session->unset_userdata($data);
        redirect('login');
    }

    public function is_admin() {
        if ($this->session->userdata('level') != 'admin') {
            $this->session->set_flashdata('pesan', 'Please login as admin!');
            $data = array('id', 'username', 'level', 'login');
            $this->session->unset_userdata($data);
            redirect('login');
        }
    }

    public function change() {
        $data = array(
            'title' => 'Change Password',
            'main_view' => 'login/change_password'
        );
        $this->load->view('template', $data);
    }

    public function save() {
        $update = $this->login->update_password($this->session->userdata('id'));
        if ($update == 1) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-success fade in"><a class="close" data-dismiss="alert" href="#">×</a>Password has been changed! </div>');
            $this->logout();
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger fade in"><a class="close" data-dismiss="alert" href="#">×</a>Password has not been changed! </div>');
            $this->logout();
        }
    }

}
