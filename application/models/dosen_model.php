<?php
class Dosen_model extends CI_Model {
	
	public function __construct(){
	    $this->load->database();
	  }

	public function get_doc_ta($id)
	{
		$this->db->select('d.id, u_p.nama_mhs, u_p.nim, u_p.kelas, d.nama_doc, d.submission, p1.status1, p2.status2, d.create_at, d.update_at');
	    $this->db->from('document_ta d');
	    $this->db->join('users u', 'd.poster=u.id', 'inner');
	    $this->db->join('mhs_profile u_p', 'u_p.user_id=u.id', 'left');
	    $this->db->join('pembimbing1_ta p1', 'p1.doc_id=d.id', 'inner');
   		$this->db->join('pembimbing2_ta p2', 'p2.doc_id=d.id', 'inner');
	    $this->db->where('doc_type', 'TA');
	    $this->db->where('pembimbing1', $id);
	    $this->db->or_where('pembimbing2', $id);
	    $this->db->order_by('create_at', 'DESC');
	    $query = $this->db->get();
	    return $query->result_array();
	}

	public function get_doc_ppi($id)
	{
		$this->db->select('d_i.id, u_p.nama_mhs, u_p.nim, u_p.kelas, d_i.nama_doc, d_i.submission, d_i.status_doc, d_i.create_at, d_i.update_at');
	    $this->db->from('document_ppi d_i');
	    $this->db->join('users u', 'd_i.poster=u.id', 'inner');
	    $this->db->join('mhs_profile u_p', 'u_p.user_id=u.id', 'left');
	    $this->db->where('pembimbing', $id);
	    $this->db->where('doc_type', 'PPI');
	    $query = $this->db->get();
	    return $query->result_array();
	}

	public function revisi($table, $data, $where)
	{

	    /*$this->db->where('id', $id);
	    $this->db->update('document', $data);*/
	    $query = $this->db->update($table, $data, $where);
	    return $query;
	}

	public function revisi_sub($id)
	{
	    $this->db->select('*');
	    $this->db->from('document_ta');
	    $this->db->where('id', $id);
	    $query = $this->db->get();
	    return $query->row_array();
	}

	public function revisi_sub_ppi($id)
	{
	    $this->db->select('*');
	    $this->db->from('document_ppi');
	    $this->db->where('id', $id);
	    $query = $this->db->get();
	    return $query->row_array();
	}

	public function get_pembimbing1($id2)
	{
		$this->db->select('id_dosen');
		$this->db->from('pembimbing1_ta');
		$this->db->where('doc_id', $id2);
		$query = $this->db->get();
	    return $query->row_array();
	}

	public function get_pembimbing2($id2)
	{
		$this->db->select('id_dosen');
		$this->db->from('pembimbing2_ta');
		$this->db->where('doc_id', $id2);
		$query = $this->db->get();
	    return $query->row_array();
	}

	public function status_ubah($table, $data, $where)
	{
		$query = $this->db->update($table, $data, $where);
		return $query;
	}

	public function status_ubah_ppi($id, $status)
	{
		$data = array(
        'status_doc' => $status,
		);

		$this->db->where('id', $id);
		$this->db->update('document_ppi', $data);
	}



	public function send_riwayat($id2, $create_by, $keterangan, $status)
	{
		$data = array(
		   'doc_id' => $id2,
		   'create_by' => $create_by,
		   'keterangan' => $keterangan,
		   'status_sub' => $status,
		   'created_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('riwayat', $data);
	}

	public function get_riwayat_ppi($id)
	{
		$this->db->select('r.keterangan, r.created_at as tanggal, d_i.nama_doc, d_i.doc_type, r.status_sub, u_p.nama_mhs, u_p.nim, u_p.kelas');
		$this->db->from('riwayat r');
		$this->db->join('document_ppi d_i', 'r.doc_id=d_i.id', 'left');
		$this->db->join('users u', 'd_i.poster=u.id', 'left');
		$this->db->join('mhs_profile u_p', 'u.id=u_p.user_id', 'inner');
		$this->db->where('create_by', $id);
		$this->db->where('doc_type', 'PPI');
		$query = $this->db->get();
	    return $query->result_array();
	}

	public function get_riwayat_ta($id)
	{
		$this->db->select('r.keterangan, r.created_at as tanggal, d.nama_doc, d.doc_type, r.status_sub, u_p.nama_mhs, u_p.nim, u_p.kelas');
		$this->db->from('riwayat r');
		$this->db->join('document_ta d', 'r.doc_id=d.id', 'left');
		$this->db->join('users u', 'd.poster=u.id', 'left');
		$this->db->join('mhs_profile u_p', 'u.id=u_p.user_id', 'inner');
		$this->db->where('create_by', $id);
		$this->db->where('doc_type', 'TA');
		$query = $this->db->get();
	    return $query->result_array();
	}

	public function add_pengumuman($user_id, $post)
	{
		$data = array(
       	'post_by' => $user_id,
       	'keterangan' => $post,
		'create_at' => date('Y-m-d H:i:s')
		);

		$this->db->insert('pemberitahuan', $data);
		return $this->db->insert_id();
	}

	public function status_data_ta($id, $status)
	{
		$data = array(
        'status_sidang' => $status,
		);

		$this->db->where('id', $id);
		$this->db->update('data_ta', $data);
	}

	public function get_mhs_bimbingan($nik)
	{
		$this->db->select('*');
		$this->db->from('data_ppi d_i');
		$this->db->join('mhs_profile m_p', 'd_i.nim=m_p.nim', 'inner');
		$this->db->where('pembimbing', $nik);
		$query = $this->db->get();
	    return $query->result_array();
	}

	public function get_mhs_bimbingan_ta1($nik)
	{
		$this->db->select('d_t.id, d_t.judul, d_t.nim, d_t.status_sidang, m_p.nama_mhs, m_p.kelas');
		$this->db->from('data_ta d_t');
		$this->db->join('mhs_profile m_p', 'd_t.nim=m_p.nim', 'inner');
		$this->db->where('pembimbing1', $nik);
		$query = $this->db->get();
	    return $query->result_array();
	}

	public function get_mhs_bimbingan_ta2($nik)
	{
		$this->db->select('*');
		$this->db->from('data_ta d_t');
		$this->db->join('mhs_profile m_p', 'd_t.nim=m_p.nim', 'inner');
		$this->db->where('pembimbing2', $nik);
		$query = $this->db->get();
	    return $query->result_array();
	}
	
	public function get_user_dosen($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('dosen_profile', 'users.id = dosen_profile.user_id');
		$this->db->where(array('users.id' => $id));

		$query = $this->db->get();

		return $query->row_array();
	}
	
	public function update_profile($table, $data, $where)
	{
		$query = $this->db->update($table, $data, $where);
		return $query;
	}
}
?>