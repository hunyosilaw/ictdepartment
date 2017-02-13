<?php
class time_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function login ($data = null) {
        if ($data != null) {
            return ($this->db->insert('punch_card', $data))?$this->db->insert_id():false;
        }
        return false;
	}

    public function get_time_login ($time_id) {
        $this->db->select('logIn');
        $this->db->where('pcId', $time_id);
        $this->db->limit(1);
        $result = $this->db->get('punch_card');
        return $result->result_array();
    }

    public function update ($data) {
        $this->db->set($data['action'], $data['value']);
        if (isset($data['shift_done'])) {
            $this->db->set('shift_done', 1);
        }
        $this->db->where('pcId', $data['id']);
        return $this->db->update('punch_card'); 
    }

    public function get_time_record ($userid) {
        $this->db->select('pcId,logIn,breakOut,breakIn,logOut,shift_done');
        $this->db->where('user_id', $userid);
        $this->db->where('shift_done', 0);
        $this->db->limit(1);
        $result = $this->db->get('punch_card');
        $arr = array('time_ID'=>'','time_timein'=>'','time_breakout'=>'','time_breakin'=>'','time_timeout'=>'');
        foreach ($result->result() as $row) {
            $arr['time_ID'] = $row->pcId;
            $arr['time_timein'] = $this->is_null($row->logIn);
            $arr['time_breakout'] = $this->is_null($row->breakOut);
            $arr['time_breakin'] = $this->is_null($row->breakIn);
            $arr['time_timeout'] = $this->is_null($row->logOut);
            $arr['shift_done'] = $this->is_null($row->shift_done);
        }
        return $arr;
    }

    private function is_null ($var = null) {
        return ($var==null)?'':$var;
    }
}