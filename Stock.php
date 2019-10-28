<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	function __construct() {
	    parent::__construct();
	}
	
	function index() {
		// Load view here with appropriate Data
	}

	function datatable_source($is_deleted=0) { // This function should be the AJAX source of your datatable
		// Here, I think you should take validation precautions
		// Like, checking if the necessary fields are present in $_POST array
		// Then, just JSON encode the result and echo
		$this->load->model('m_stock');
		echo json_encode($this->m_stock->dt_get_all_items($is_deleted, $_POST));
	}
}