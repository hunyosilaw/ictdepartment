<?php
class it_ticket_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function insert ($data = null) {
        if ($data != null) {
            return $this->db->insert('ticket_logs', $data);
        }
        return;
    }

    public function get ($id = null) {
        if ($id != null) {
            $this->db->select('ticket_logs.time_started, ticket_logs.time_finished, ticket_logs.agent_assisted, problem_specific.name as psName, problem_type.name as ptName, accounts.name as accName, ticket_logs.tlId, ticket_logs.task');
			$this->db->from('ticket_logs');
            $this->db->join('problem_specific', 'problem_specific.ps_id = ticket_logs.ps_id');
            $this->db->join('problem_type', 'problem_type.pt_id = ticket_logs.pt_id');
            $this->db->join('accounts', 'accounts.acc_id = ticket_logs.acc_id');
            $this->db->where('ticket_logs.pc_id', $id);
            $query = $this->db->get();
            
            return $query->result_array();
        } 
        return array();
    }
}