<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function cek_user($username)
	{
		$this->db->from('mst_user');
		$this->db->where('username', $username);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_user()
	{
		return $this->db->get('mst_user');
	}

}

/* End of file M_user.php */
/* Location: ./application/models/M_user.php */