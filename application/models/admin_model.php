<?php
class Admin_model extends CI_Model{

	public function __construct(){
	    $this->load->database();
	  }

	public function tambah_pengumuman($user_id, $judul, $post)
	{
		$data = array(
       	'post_by' => $user_id,
       	'judul' => $judul,
       	'keterangan' => $post,
		'create_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('pemberitahuan', $data);
		return $this->db->insert_id();
	} 

	public function get_user_data_mhs() {
		$this->db->select('u.id, u.username, u.password, u.level, u_p.user_id, u_p.nama_mhs, u_p.nim, u_p.kelas, u_p.jurusan ');
		$this->db->from('users u');
		$this->db->join('mhs_profile u_p', 'u.id = u_p.user_id', 'inner');	
		$this->db->where('level', 'Mahasiswa');
	    $query = $this->db->get();
	    return $query->result_array();
  	}

  	public function get_user_data_dsn() {
		$this->db->select('u.id, u.username, u.password, u.level, d_p.user_id, d_p.nama_dsn, d_p.nik, d_p.no_hp, d_p.email');
		$this->db->from('users u');
		$this->db->join('dosen_profile d_p', 'u.id = d_p.user_id', 'inner');	
		$this->db->where('level', 'Dosen');
	    $query = $this->db->get();
	    return $query->result_array();
  	}

  	public function get_user_mhs()
  	{
  		$this->db->select('u.id, u.username, u.password, u.level, u_p.user_id, u_p.nama_mhs, u_p.nim, u_p.kelas, u_p.jurusan ');
		$this->db->from('users u');
		$this->db->join('mhs_profile u_p', 'u.id = u_p.user_id', 'inner');	
		$this->db->where('level', 'Mahasiswa');
	    $query = $this->db->get();
	    return $query->result_array();	
  	}

  	/*public function get_mhs()
  	{
  	$this->db->select('*')
  	$this->db->from('users u');
  	$this->db->join('user_profile u_p', 'u_p.user_id= u_p.user_id', 'inner')
    $this->db->where('level', 'Mahasiswa');
      $query = $this->db->get();
      return $query->result_array();
  	}*/

  	public function get_user_dosen()
  	{
  		$this->db->select('u.id, u.username, u.password, u.level, d_p.user_id, d_p.nama_dsn, d_p.nik, d_p.no_hp, d_p.email');
		$this->db->from('users u');
		$this->db->join('dosen_profile d_p', 'u.id = d_p.user_id', 'inner');	
		$this->db->where('level', 'Dosen');
		$query = $this->db->get();
	    return $query->result_array();
  	}

  	public function add_user($table, $data)
	{
		$this->db->insert($table, $data);

		return $this->db->insert_id();
	}

	public function add_user_mhs($table, $data)
	{
		$this->db->insert($table, $data);

		return $this->db->insert_id();
	}

	public function add_user_dosen($table, $data)
	{
		$this->db->insert($table, $data);

		return $this->db->insert_id();
	}

	public function update_user($table, $data, $where)
	{
		$query = $this->db->update($table, $data, $where);

		return $query;
	}

	public function update_user_dosen($table, $data, $where)
	{
		$query = $this->db->update($table, $data, $where);

		return $query;
	}

	public function update_ppi_data($table, $data, $where)
	{
		$query = $this->db->update($table, $data, $where);

		return $query;
	}

	public function update_ta_data($table, $data, $where)
	{
		$query = $this->db->update($table, $data, $where);

		return $query;
	}

	public function edit($id)
	{
		$this->db->select('u.id, u.username, u.password, u.level, u_p.user_id, u_p.nama_mhs, u_p.nim, u_p.kelas, u_p.jurusan ');
		$this->db->from('users u');
		$this->db->join('mhs_profile u_p', 'u.id = u_p.user_id', 'inner');	
		$this->db->where('user_id', $id);
		$query = $this->db->get();
	    return $query->row_array();
	}

	public function edit_dosen($id)
	{
		$this->db->select('u.id, u.username, u.password, u.level, d_p.user_id, d_p.nama_dsn, d_p.nik, d_p.no_hp, d_p.email');
		$this->db->from('users u');
		$this->db->join('dosen_profile d_p', 'u.id = d_p.user_id', 'inner');	
		$this->db->where('user_id', $id);
		$query = $this->db->get();
	    return $query->row_array();
	}

	public function status_data_ppi($id, $status)
	{
		$data = array(
        'status_ppi' => $status,
		);

		$this->db->where('id', $id);
		$this->db->update('data_ppi', $data);
	}

	public function edit_ppi_data($id)
	{
		$this->db->select('id, nama_magang, pembimbing_magang');
		$this->db->from('data_ppi');	
		$this->db->where('id', $id);
		$query = $this->db->get();
	    return $query->row_array();
	}

	public function edit_ta_data($id)
	{
		$this->db->select('id, judul');
		$this->db->from('data_ta');	
		$this->db->where('id', $id);
		$query = $this->db->get();
	    return $query->row_array();
	}

	public function get_ppi($id)
	{
	    $this->db->select('*');
	    $this->db->from('document_ppi d_i');
	    $this->db->join('dosen_profile d_p', 'd_p.user_id=d_i.pembimbing');
	    $this->db->where('poster', $id);
	    $this->db->where('doc_type', 'PPI');
	    $query = $this->db->get();
	    return $query->result_array();
	 }

	public function get_ta($id)
	{
	    $this->db->select('d.nama_doc, d_p1.nama_dsn as pembimbing1, d_p2.nama_dsn as pembimbing2, d.submission, p1.status1, p2.status2');
	    $this->db->from('dosen_profile d_p1');
	    $this->db->join('document_ta d', 'd_p1.user_id=d.pembimbing1', 'inner');
	    $this->db->join('dosen_profile d_p2', 'd_p2.user_id=d.pembimbing2', 'inner');
	    $this->db->join('pembimbing1_ta p1', 'p1.doc_id=d.id', 'inner');
   		$this->db->join('pembimbing2_ta p2', 'p2.doc_id=d.id', 'inner');
	    $this->db->where('poster', $id);
	    $this->db->where('doc_type', 'TA');
	    $query = $this->db->get();
	    return $query->result_array();
	}

	public function get_pem_ppi($id)
	{
		$this->db->select('d_p.id, u_p.nama_mhs, u_p.kelas, d_p.nim, d_p.nama_magang, d_p.pembimbing_magang');
		$this->db->from('data_ppi d_p');
		$this->db->join('mhs_profile u_p', 'u_p.nim=d_p.nim', 'inner');
		$this->db->where('pembimbing', $id);
		$query = $this->db->get();
	    return $query->result_array();
	}

	public function get_pem_ta1($id)
	{
		$this->db->select('d_t.id, u_p.nama_mhs, d_t.nim, u_p.kelas, d_t.judul');
		$this->db->from('data_ta d_t');
		$this->db->join('mhs_profile u_p', 'u_p.nim=d_t.nim', 'inner');
		$this->db->where('pembimbing1', $id);
		$query = $this->db->get();
	    return $query->result_array();
	}

	public function get_pem_ta2($id)
	{
		$this->db->select('d_t.id, u_p.nama_mhs, d_t.nim, u_p.kelas, d_t.judul');
		$this->db->from('data_ta d_t');
		$this->db->join('mhs_profile u_p', 'u_p.nim=d_t.nim', 'inner');
		$this->db->where('pembimbing2', $id);
		$query = $this->db->get();
	    return $query->result_array();
	}

	function delete_mhs_ppi($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('bimbingan_ppi');
	}

	function delete_mhs_ta1($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("bimbingan_ta");
	}

	function delete_mhs_ta2($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("bimbingan_ta");
	}

	function delete_ppi_data($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("data_ppi");
	}

	function delete_ta_data($id)
	{
		$this->db->where("id",$id);
		$this->db->delete("data_ta");
	}

	public function get_username($data_user)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $data_user[1]['username']);
		foreach ($data_user as $key) {
			$this->db->or_where('username', $key['username']);
		}
		$query = $this->db->get();
		return $query->result_array();

	}

	public function get_data_tugas_akhir()
	{
		$this->db->select('t_a.id, t_a.judul, t_a.nim, d_p1.nama_dsn as pembimbing1, d_p2.nama_dsn as pembimbing2, t_a.status_sidang');
		$this->db->from('data_ta t_a');
		$this->db->join('dosen_profile d_p1', 'd_p1.nik=t_a.pembimbing1', 'inner');
		$this->db->join('dosen_profile d_p2', 'd_p2.nik=t_a.pembimbing2', 'inner');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_data_ppi()
	{
		$this->db->select('p.id, p.nim, d_p.nama_dsn, p.nama_magang, p.pembimbing_magang, p.status_ppi');
		$this->db->from('data_ppi p');
		$this->db->join('dosen_profile d_p', 'd_p.nik=p.pembimbing', 'inner');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_pemberitahuan()
	{
		$this->db->select('u.username, p.judul, p. keterangan, p.create_at');
		$this->db->from('pemberitahuan p');
		$this->db->join('users u', 'u.id=p.post_by', 'inner');
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>