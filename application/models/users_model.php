<?php
class Users_model extends CI_Model{

	public function __construct(){
	    $this->load->database();
	  }

	public function cek_user($data) {
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->where($data);
		$query = $this->db->get();
		return $query;
  	}

  	public function get_user($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('mhs_profile', 'users.id = mhs_profile.user_id');
		$this->db->where(array('users.id' => $id));

		$query = $this->db->get();

		return $query->row_array();
	}


	public function update_user($table, $data, $where)
	{
		$query = $this->db->update($table, $data, $where);
		return $query;
	}

	public function get_pass($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function update_password($table, $data, $where)
	{
	    $query = $this->db->update($table, $data, $where);
	    return $query;
	}

	public function profile_mhs($id)
	{
		$this->db->select('*');
		$this->db->from('mhs_profile u_p');
		$this->db->join('users u', 'u.id = u_p.user_id');
		$this->db->where('u_p.user_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function profile_dsn($id)
	{
		$this->db->select('*');
		$this->db->from('dosen_profile d_p');
		$this->db->join('users u', 'u.id = d_p.user_id');
		$this->db->where('d_p.user_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_user_chat()
	{
		$this->db->select('*');
		$this->db->from('users u');
		$this->db->join('mhs_profile u_p', 'u_p.user_id = u.id');
		$this->db->order_by('nama_mhs', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>
