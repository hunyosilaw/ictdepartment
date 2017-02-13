<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ticket extends CI_Controller {

	/* construct function */
	public function __construct() {
  	parent::__construct();
		$this->load->library('session');
		//$this->load->model('it_ticket');
		$this->load->helper('url');
		$this->load->helper('form');
  	}

	public function index () {
		redirect('main', 'refresh');
	}

	public function it_ticket () {
		$this->load->library('form_validation');

		$f_val = $this->form_validation;
		$f_val->set_rules('task','Task Done', 'required');
		$f_val->set_rules('time_start','Time started','required');
		$f_val->set_rules('time_end','Time Finished','required');
		echo '<pre>';
		print_r($this->input->post());
		if ($f_val->run() == FALSE) {
			//$this->display_site();
			echo 1;
		} else {
			echo 2);
		}
	}
}
