<?php

defined('BASEPATH') or exit('No direct script allowed!');

/**
 * Created by MiniProgrammer
 */
class Type extends MY_Controller {

    public $data = array(
        'title' => 'Type',
        'main_view' => 'type/type',
        'result' => array(),
        'pagination' => '',
        'search' => 0,
        'start' => 0
    );

    function __construct() {
        parent::__construct();
        $this->load->model('Model_type', 'type');
    }

    public function index() {
        // Pagination Install
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'type/page/';
        $config['total_rows'] = $this->type->count_all();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE;
        // Bootstrap Style
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        // End Bootstrap Style
        $this->pagination->initialize($config);
        // End Pagination Install
        $start = $this->uri->segment(3, 0);
        $this->data['result'] = $this->type->get_all($config['per_page'], $start); // Ambil data dari model
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['start'] = $start;
        if (!empty($_GET['param'])) {
            $this->data['search'] = 1;
        }
        $this->load->view('template', $this->data);
    }

    public function add() {
        $this->data['title'] = 'Add Type';
        $this->data['main_view'] = 'type/form_type';
        $this->data['is_edit'] = 0;
        $this->load->view('template', $this->data);
    }

    public function edit($id) {
        $this->data['title'] = 'Edit Type';
        $this->data['main_view'] = 'type/form_type';
        $this->data['is_edit'] = 1;
        $this->data['result'] = $this->type->get_edit($id);
        $this->load->view('template', $this->data);
    }

    public function save() {
        $commit = $this->input->post('commit');
        if ($commit == 'add') {
            $insert = $this->type->insert_data();
            if ($insert > 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success!</strong> One data have been inserted.
				</div>');
                redirect('type');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Fail!</strong> One data have not been inserted.
				</div>');
                redirect('type');
            }
        } else if ($commit == 'edit') {
            $update = $this->type->update_data();
            if ($update > 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success!</strong> One data have been updated.
				</div>');
                redirect('type');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Fail!</strong> One data have not been updated.
				</div>');
                redirect('type');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error!</strong> There are Something Wrong on System. Please Try Again!
				</div>');
            redirect('type');
        }
    }

    public function delete($id) {
        $delete = $this->type->delete_data($id);
        if ($delete > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success!</strong> One data have been deleted.
				</div>');
            redirect('type');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Fail!</strong> One data have not been deleted.
				</div>');
            redirect('type');
        }
    }

}
