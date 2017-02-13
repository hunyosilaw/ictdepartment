p<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oerrors extends CI_Controller {

	/* construct function */
	public function __construct() {
  		parent::__construct();
  	}

	/* function to call upon accessing Main controller */
	public function index() {
		// call main view
		$this->load->helper('url');
		$this->load->view('errors/error_404');
	}
}
