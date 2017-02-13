<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_session extends CI_Controller {

	/* construct function */
	public function __construct() {
  		parent::__construct();
  		$this->load->helper('url');
  		$this->load->helper('form');
		$this->load->library('session');
  	}

	/* function to call upon accessing Main controller */
	public function index() {
		$this->show_login_page();
	}

	private function get_data_based_on_session_state () {
		$data = array(
			'is_lock' => (null != $this->session->userdata('is_lock')),
			'registration_result' => $this->session->userdata('registration_result')
		);
		$this->load->library('password_hasher');
		$emp_data = $this->session->userdata('current_user');
		$emp_data = $this->password_hasher->_decode_arr($emp_data);
		if ($emp_data != null) { 
			$data['name'] = $emp_data['name'];
			$data['img_url'] = $emp_data['img_url'];
			$data['un'] = $emp_data['username'];
		}
		$this->session->unset_userdata('registration_result');
		return $data;
	}

	private function show_login_page () {
		$data = $this->get_data_based_on_session_state();
		
		$this->load->view('other/login_header');
		$this->load->view('login_page', $data);
		$this->load->view('other/login_footer');
	}

	public function verify () {
		$this->load->library('form_validation');

		$fv = $this->form_validation;
		
		$fv->set_rules('username','Username', 'required');
		$fv->set_rules('password','Password', 'required|callback_usercheck');

		if ($fv->run() == FALSE) {
			$this->show_login_page();
		} else { 
			$data = array (
				'is_loggedin' => true
			);
			$this->session->set_userdata($data);
			redirect('main', 'refresh');
		}
	}

	public function usercheck ($pass) {
		$this->load->model('employee_model');
		$this->load->model('time_model');
		$this->load->library('password_hasher');
		$this->load->library('encrypt');

		$un = $this->input->post('username');

		$saved_pass = $this->employee_model->get_pass_by_username($un);
		
		if ($this->password_hasher->password_verify($pass, $saved_pass)) {
			if ($this->password_hasher->password_needs_rehash($saved_pass, PASSWORD_BCRYPT)) {
				$new_pass = $this->password_hasher->password_hash($pass, PASSWORD_BCRYPT);
				$this->employee_model->update_password($new_pass, $un);
			}
			$this->load->library('ict_date');

			$emp_data = $this->employee_model->get(array('username' => $un, 'password' => $saved_pass));
			$time_record = $this->time_model->get_time_record($emp_data['user_id']);

			$time_record['time_ID'] = ($time_record['time_ID'] != '') ? $this->encrypt->encode($time_record['time_ID'], '$2y$10$y.UTcLg7idiH7iKf5hOk9.ahdlzogrY5fFFuPifMJ25Yv') : '';
			$prep_data = array (
				'user_id' => $emp_data['user_id'],
				'username' => $emp_data['username'],
				'name' => $emp_data['full_name'],
				'site_id' => $emp_data['site_id'],
				'position_id' => $emp_data['position_id'],
				'img_url' => $emp_data['image_url'],
				'time_record' => $time_record
			);
			$emp_session_data = array ( 
				'current_user' => $this->password_hasher->_encode_arr($prep_data),
				'session_token' => $this->password_hasher->password_hash($emp_data['user_id']+$emp_data['username'], PASSWORD_BCRYPT)
			);
			$this->session->set_userdata($emp_session_data);
			return true;
		} else {
			$this->form_validation->set_message('usercheck', 'Invalid Username/Password! Please try again...'.$un.'--');
			return false;
		}
    }

	public function logout () {
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}

	public function lock () {
		$this->session->set_userdata('is_lock',true);
		redirect('login', 'refresh');
	}
}
