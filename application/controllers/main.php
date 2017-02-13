<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	private $key = '$2y$10$y.UTcLg7idiH7iKf5hOk9.ahdlzogrY5fFFuPifMJ25Yv';
	/* construct function */
	public function __construct() {
  	parent::__construct();
		$this->load->model('employee_model');
		$this->load->helper('url');
		$this->load->helper('form');
  	}

	public function index() {
		$this->is_someone_loggedin();
		$user_data = $this->check_current_user();
		
		$this->display_site($user_data);
	}

	private function display_site ($data = null, $page='main_page') {
		$data['tp'] = $this->employee_model->get_opt('problem_type');
		$data['ps'] = $this->employee_model->get_opt('problem_specific', true);
		$data['acc'] = $this->employee_model->get_opt('accounts');
		$data['it_ticket_result'] = $this->session->flashdata('it_ticket_result');
		$data['form_error'] = $this->session->flashdata('form_error');
		$data['it_ticket_logs'] = $this->get_it_ticket_logs();

		$this->load->view('other/header');
		$this->load->view('menu/navigation_bar', $data);
		$this->load->view('menu/left_menu');
		$this->load->view($page, $data);
		$this->load->view('menu/right_menu');
		$this->load->view('other/footer');
	}

	private function get_it_ticket_logs () {
		$this->load->model('it_ticket_model');
		if ($this->session->userdata('time_id') != null) {
			$this->load->library('encrypt');
			$id = $this->encrypt->decode($this->session->userdata('time_id'), $this->key);

			return $this->it_ticket_model->get($id);
		} else {
			return array();
		}
	}

	public function end_of_day () {
		$this->is_someone_loggedin();
		$data = $this->check_current_user(true);
		$this->display_site($data, 'eod_page');
	}

	private function is_someone_loggedin () {
		if ($this->session->userdata('is_loggedin')==null) {
			// go to login page
			redirect('login', 'refresh', 302);
		}
	}

	private function check_current_user ($eod = false) {
		$this->load->library('password_hasher');
		$current_user = $this->session->userdata('current_user');
		$current_user = $this->password_hasher->_decode_arr($current_user);

		if ($current_user['time_record']['time_timeout'] != '' && $current_user['time_record']['shift_done'] == 0 && !$eod) {
			redirect('end_of_day', 'refresh');
		}

		$sess_token = $this->session->userdata('session_token');
		$raw_token = $current_user['user_id']+$current_user['username'];

		if ($this->password_hasher->password_verify($raw_token, $sess_token)) {
			return $current_user;
		} else {
			session_destroy();
			redirect('login', 'refresh', 302);
		}
	}

	public function it_ticket () {
		$this->load->library('form_validation');
		if ($this->session->userdata('time_id') == null) {
			$this->session->set_flashdata('it_ticket_result', 'You need to login first...');
			redirect ('main', 'refresh');
		}
		$f_val = $this->form_validation;
		$f_val->set_rules('task','Task Done', 'required');
		$f_val->set_rules('time_start','Time started','required');
		$f_val->set_rules('time_end','Time Finished','required');
		
		if ($f_val->run() == FALSE) {
			$this->session->set_flashdata('form_error', $f_val->error_array());
		} else {
			$this->load->library('encrypt');
			$it_ticket_data = array (
				'task' => $this->input->post('task'),
				'acc_id' => (null != $this->input->post('account'))?$this->decode_id($this->input->post('account')):1,
				'ps_id' => (null != $this->input->post('problem_specific'))?$this->decode_id($this->input->post('problem_specific')):1,
				'pt_id' => (null != $this->input->post('problem_type'))?$this->decode_id($this->input->post('problem_type')):1,
				'time_started' => $this->input->post('time_start'),
				'time_finished' => $this->input->post('time_end'),
				'agent_assisted' => $this->input->post('agent'),
				'pc_id' => $this->encrypt->decode($this->session->userdata('time_id'), $this->key)
			);

			$this->load->model('it_ticket_model');

			if (!$this->it_ticket_model->insert($it_ticket_data)) {
				$this->session->set_flashdata('it_ticket_result', 'Failed to add log. Please try again!');
			} 
		}
		redirect('main', 'refresh');
	}

	private function decode_id ($str) {
		$str = base64_decode($str);
		return str_replace("id_","",$str);
	}
}
