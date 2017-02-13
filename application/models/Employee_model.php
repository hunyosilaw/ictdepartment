<?php
class employee_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get ($emp_data = null) {
        if ($emp_data === null)
        {
            $query = $this->db->get('user');
            return $query->result_array();
        }

        $query = $this->db->get_where('user', $emp_data);
        return $query->row_array();
	}

    public function get_pass_by_username ($un = null) {
        if ($un === null) {
            return;
        }
        $this->db->select('password');
        $query = $this->db->get_where('user', array('username'=>$un));
        $result = $query->row_array();
        
        return $result['password'];
    }

    public function update_password ($new_pass, $un) {
        $this->db->set('password', $new_pass);
        $this->db->where('username', $un);
        return $this->db->update('user'); 
    }

    public function insert ($emp_data = null) {
        if ($emp_data != null) {
            return $this->db->insert('user', $emp_data);
        }
        return;
    }

    public function get_opt ($opt, $grp = null) {
        $query = $this->db->get($opt);
        if ($query->num_rows() > 0) {
            return $this->prepare_arr($query->result_array(), $grp);
        }
        return null;
    }

    private function prepare_arr ($arr,  $grp = null) {
        $arranged = array ();
        $arranged['Software'] = array(); 
        $arranged['Hardware'] = array();
        
        if ($grp == null) {
            unset($arranged['Software']);
            unset($arranged['Hardware']);
        }

        foreach ($arr as $key => $val) {

            $keys = array_keys($val);
            if (count($val) < 3 && $grp == null) {
                $arranged['id_'.$val[$keys[0]]] = $val[$keys[1]];
            } else {
                if ($val['type'] == 1) {
                    $arranged['Software']['id_'.$val['ps_id']] = $val['name'];
                } else {
                    $arranged['Hardware']['id_'.$val['ps_id']] = $val['name'];
                }
            }
        }
        return $arranged;
    }
}