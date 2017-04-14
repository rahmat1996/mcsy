<?php defined('BASEPATH') or exit('No direct script access!');
/**
* Author by Kucingliar61
*/
class Test extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	function index(){
		$this->load->view('template');
	}
}