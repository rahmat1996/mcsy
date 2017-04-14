<?php

defined('BASEPATH') or exit('No direct script allowed!');

/**
 * Create by MiniProgrammer
 */
class Location extends MY_Controller {

    public $data = array(
        'title' => 'Location',
        'main_view' => 'location/location',
        'result' => array(),
        'pagination' => '',
        'search' => 0,
        'start' => 0
    );

    function __construct() {
        parent::__construct();
        $this->load->model('Model_location', 'location'); // load model
    }

    public function index() {
        // Pagination Install
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'location/page/';
        $config['total_rows'] = $this->location->count_all();
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
        $this->data['result'] = $this->location->get_all($config['per_page'], $start); // Ambil data dari model
        $this->data['pagination'] = $this->pagination->create_links();
        $this->data['start'] = $start;
        if (!empty($_GET['param'])) {
            $this->data['search'] = 1;
        }
        $this->load->view('template', $this->data);
    }

    public function add() {
        $this->data['title'] = 'Add Location';
        $this->data['main_view'] = 'location/form_location';
        $this->data['is_edit'] = 0;
        $this->load->view('template', $this->data);
    }

    public function edit($id) {
        $this->data['title'] = 'Edit Location';
        $this->data['main_view'] = 'location/form_location';
        $this->data['is_edit'] = 1;
        $this->data['result'] = $this->location->get_edit($id);
        $this->load->view('template', $this->data);
    }

    public function save() {
        $commit = $this->input->post('commit');
        if ($commit == 'add') {
            $insert = $this->location->insert_data();
            if ($insert > 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success!</strong> One data have been inserted.
				</div>');
                redirect('location');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Fail!</strong> One data have not been inserted.
				</div>');
                redirect('location');
            }
        } else if ($commit == 'edit') {
            $update = $this->location->update_data();
            if ($update > 0) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success!</strong> One data have been updated.
				</div>');
                redirect('location');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Fail!</strong> One data have not been updated.
				</div>');
                redirect('location');
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Error!</strong> There are Something Wrong on System. Please Try Again!
				</div>');
            redirect('location');
        }
    }

    public function delete($id) {
        $delete = $this->location->delete_data($id);
        if ($delete > 0) {
            $this->session->set_flashdata('msg', '<div class="alert alert-success fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Success!</strong> One data have been deleted.
				</div>');
            redirect('location');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong>Fail!</strong> One data have not been deleted.
				</div>');
            redirect('location');
        }
    }

}
