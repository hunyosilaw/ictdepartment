<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	/* construct function */
	public function __construct() {
  	parent::__construct();
		$this->load->library('session');
		$this->load->model('employee_model');
  		$this->load->helper('url');
  	}

	public function index() {
		redirect('main', 'refresh');
	}

	public function register () {
		$this->load->library('form_validation');
		$error_msg = array(
	    	'required'      => 'You have not provided %s.',
	    	'is_unique'     => 'This %s already exists.'
	    );
		// shorten form_validation
		$fv = $this->form_validation;
		$fv->set_rules('name','Name', 'required|min_length[8]|is_unique[user.full_name]',$error_msg);
		$fv->set_rules('username','Username','required|min_length[5]|is_unique[user.username]',$error_msg);
		$fv->set_rules('site','Site','required|is_natural_no_zero',array('is_natural_no_zero'=>'The item you selected is not valid'));
		$fv->set_rules('position','Position','required|is_natural_no_zero',array('is_natural_no_zero'=>'The item you selected is not valid'));
		$fv->set_rules('password','Password','required');
		$fv->set_rules('password_2','Repeat Password','required|matches[password]');

		if ($fv->run() == FALSE) {
			$this->load->view('other/login_header');
			$data['position'] = $this->employee_model->get_opt('position');
			$data['site'] = $this->employee_model->get_opt('site');
			$this->load->view('registration_page', $data);
		} else {
			$this->load->library('password_hasher');
			$emp_data = array (
				'full_name' => $this->input->post('name'),
				'position_id' => $this->input->post('position'),
				'site_id' => $this->input->post('site'),
				'username' => $this->input->post('username'),
				'img_url' => $this->input->post('img_url'),
				'password' => $this->password_hasher->password_hash($this->input->post('password'), PASSWORD_BCRYPT)
			);
			$result = ($this->employee_model->insert($emp_data))?'success':'fail';
			$this->session->set_userdata('registration_result', $result);
			redirect('main', 'refresh');
		}
	}

	public function read ($data = null) {
		echo 'read employee';
	}

	public function update () {
		echo 'update employee';
	}

	public function delete () {
		echo 'delete employee';
	}
}
