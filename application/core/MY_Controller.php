<?php defined('BASEPATH') or exit("No Direct Script Allowd");
/**
* 
*/
class MY_Controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->userdata('login') != TRUE){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger fade in">
									<a class="close" data-dismiss="alert" href="#">×</a>Please Login First!
							</div>');
			redirect('login');
	}
	function index(){
		
		}
	}
}