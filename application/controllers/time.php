<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time extends CI_Controller {
	private $key = '$2y$10$y.UTcLg7idiH7iKf5hOk9.ahdlzogrY5fFFuPifMJ25Yv';
	/* construct function */
	public function __construct() {
  	parent::__construct();
		$this->load->library('session');
  		$this->load->helper('url');
		$this->load->library('password_hasher');
		$this->load->library('encrypt');
  	}

	public function index() {
		redirect('main', 'refresh', 302);
	}

	private function _ar ($army_time) {
        $regular_time = date( 'g:i A', strtotime( $army_time ) );
        return ($army_time == '') ? '':$regular_time;
	}

	public function time_log ($action) {
		$this->load->library('ict_date');
		$this->load->model('time_model');

		$current_user = $this->check_current_user();
		$is_ajax = $this->input->post('is_ajax');
		date_default_timezone_set('Asia/Manila');

		switch ($action) {
			case 'timein':
				if (isset($current_user['time_record']['time_login']) && $current_user['time_record']['time_login'] != '') {
					redirect('main', 'refresh');
				}  	
				$data = array (
					'user_id' => $current_user['user_id'],
					'date' => $this->ict_date->get_date('Y-m-d'),
					'logIn' => $this->ict_date->get_date('Y-m-d H:i')
				);
				$time = $this->ict_date->get_date('Y-m-d H:i:00');
				$time = $this->_ar($time);

				if ($this->time_model->login($data)) {
					$this->load->library('password_hasher');

					$current_user['time_record']['time_ID'] = $this->encrypt->encode($this->db->insert_id(), $this->key);
					$current_user['time_record']['time_timein'] = $this->ict_date->get_date('Y-m-d H:i:00');
					$this->session->set_userdata('time_id', $current_user['time_record']['time_ID']);
					$this->session->set_userdata('current_user', $this->password_hasher->_encode_arr($current_user));
					$this->_result($is_ajax, 1, 'Login time recorded!', $time);
				} else {
					$this->_result($is_ajax, 0, 'Failed to login... Please try again!');
				}
				break;
			case 'breakout':
				if (isset($current_user['time_record']['time_breakout']) && $current_user['time_record']['time_breakout'] != '') {
					redirect('main', 'refresh');
				} 
				$data = array(
					'action' => 'breakOut',
					'value' => $this->ict_date->get_date('Y-m-d H:i'),
					'id' => $this->encrypt->decode($current_user['time_record']['time_ID'], $this->key)
				);
				$time = $this->ict_date->get_date('Y-m-d H:i:00');
				$time = $this->_ar($time);

				if ($this->time_model->update($data)) {
					$this->load->library('password_hasher');

					$current_user['time_record']['time_breakout'] = $this->ict_date->get_date('Y-m-d H:i:00');
					$this->session->set_userdata('current_user', $this->password_hasher->_encode_arr($current_user));

					$this->_result($is_ajax, 1, 'Break time recorded!', $time);
				} else {
					$this->_result($is_ajax, 0, 'Failed to record break time... Please try again!');
				}
				break;
			case 'breakin':
				if (isset($current_user['time_record']['time_breakin']) && $current_user['time_record']['time_breakin'] != '') {
					redirect('main', 'refresh');
				} 
				$data = array(
					'action' => 'breakIn',
					'value' => $this->ict_date->get_date('Y-m-d H:i'),
					'id' => $this->encrypt->decode($current_user['time_record']['time_ID'], $this->key)
				);
				$time = $this->ict_date->get_date('Y-m-d H:i:00');
				$time = $this->_ar($time);
				if ($this->time_model->update($data)) {
					$this->load->library('password_hasher');

					$current_user['time_record']['time_breakin'] = $this->ict_date->get_date('Y-m-d H:i:00');
					$this->session->set_userdata('current_user', $this->password_hasher->_encode_arr($current_user));

					$this->_result($is_ajax, 1, 'Back time recorded!', $time);
				} else {
					$this->_result($is_ajax, 0, 'Failed to record back time... Please try again!');
				}
				break;
			case 'timeout':
				
				$data = array(
					'action' => 'logOut',
					'value' => $this->ict_date->get_date('Y-m-d H:i'),
					'id' => $this->encrypt->decode($current_user['time_record']['time_ID'], $this->key)
				);
				$time = $this->ict_date->get_date('Y-m-d H:i:00');
				$time = $this->_ar($time);
				if ($this->time_model->update($data)) {
					$this->load->library('password_hasher');

					$current_user['time_record']['time_timeout'] = $this->ict_date->get_date('Y-m-d H:i:00');
					$this->session->set_userdata('current_user', $this->password_hasher->_encode_arr($current_user));

					$this->_result($is_ajax, 1, 'eod');
				} else {
					$this->_result($is_ajax, 0, 'Failed to record logout time... Please try again!');
				}
				break;
			default:
				$this->_result($is_ajax, 0, 'Invalid action... Please do not bypass process.. Thanks! ;)');
				exit;
				break;
		}
	}

	private function _result ($is_ajax, $result, $msg, $time = null) {
		if ($is_ajax) {
			exit(json_encode(array('result'=> $result,'msg'=>$msg, 'time' => $time)));
		} else {
			redirect('main', 'refresh');
		}
	}

	private function check_current_user () {
		$current_user = $this->session->userdata('current_user');
		$current_user = $this->password_hasher->_decode_arr($current_user);
		$sess_token = $this->session->userdata('session_token');
		$raw_token = $current_user['user_id']+$current_user['username'];

		if ($this->password_hasher->password_verify($raw_token, $sess_token)) {
			return $current_user;
		} else {
			session_destroy();
			redirect('login', 'refresh', 302);
		}
	}

}
