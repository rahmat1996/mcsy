<?php

defined('BASEPATH') or exit('No direct script allowed');

/**
 * Author by Rahmat1996
 */
class Home extends MY_Controller {

    public $data = array(
        'title' => 'Home',
        'main_view' => 'home/home'
    );

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('template', $this->data);
    }

}
