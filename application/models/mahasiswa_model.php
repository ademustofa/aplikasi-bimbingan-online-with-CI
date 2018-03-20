<?php
class Mahasiswa_model extends CI_Model{

  public function __construct(){
    $this->load->database();
  }

  public function chat_user($id, $konten, $send_to)
  {
      $data = array(
        'create_by' => $id,
        'send_to' => $send_to,
        'chat_content' => $konten, 
        'created_at' => date('Y-m-d H:i:s') 
      );

      $this->db->insert('chat', $data);
  }

  public function get_self_chat($id, $id2)
  {
    $this->db->select('*');
    $this->db->from('chat c');
    /*$this->db->join('mhs_profile m_p', 'm_p.user_id = c.send_to', 'inner');*/
    $array1 = array('create_by' => $id, 'send_to' => $id2);
    $this->db->where($array1);
    $array2 = array('create_by' => $id2, 'send_to' => $id);
    $this->db->or_where($array2);
    $query = $this->db->get();
    return $query->result_array();

  }

  /*public function get_other_chat($id, $id2)
  {
    $this->db->select('*');
    $this->db->from('chat c');
    $this->db->join('mhs_profile m_p', 'm_p.user_id = c.send_to', 'inner');
    $this->db->where('create_by', $id2);
    $this->db->where('send_to', $id);
    $query = $this->db->get();
    return $query->result_array();

  }*/

  public function get_profile_mhs($id)
  {
    $this->db->select('*');
    $this->db->from('mhs_profile');
    $this->db->where('user_id', $id);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_dosen_ppi($nim)
  {
    $this->db->select('*');
    $this->db->from('data_ppi d_i');
    $this->db->join('dosen_profile d_p', 'd_i.pembimbing = d_p.nik', 'inner'); 
    $this->db->where('nim', $nim);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_dosen_ta($nim)
  {
    $this->db->select('d_p1.nama_dsn as pembimbing1, d_p2.nama_dsn as pembimbing2');
    $this->db->from('data_ta d_t');
    $this->db->join('dosen_profile d_p1', 'd_t.pembimbing1 = d_p1.nik', 'inner');
    $this->db->join('dosen_profile d_p2', 'd_t.pembimbing2 = d_p2.nik', 'inner'); 
    $this->db->where('nim', $nim);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function add_doc_ta($table, $data)
  {

		$this->db->insert($table, $data);
		return $this->db->insert_id();
	
  }

  function add_pembimbing($table, $data)
  {
    $this->db->insert($table, $data);
  }

  public function add_doc_ppi($type, $nama, $user_id, $file_name, $pembimbing, $status)
  {
      
    $data = array(
       'doc_type' => $type,
       'nama_doc' => $nama,
       'poster' => $user_id,
       'pembimbing' => $pembimbing,
       'submission' => $file_name,
       'status_doc' => $status,
       'create_at' => date('Y-m-d H:i:s')
    );

    $this->db->insert('document_ppi', $data);
    return $this->db->insert_id();
  
  }

  public function status_data_ppi($nim)
  {

    $this->db->select('status_ppi');
    $this->db->from('data_ppi');
    $this->db->where('nim', $nim);
    $query = $this->db->get();
    return $query->row_array();
  }


  public function select_dosen() 
  {
    $this->db->select('u.id, d_p.nama_dsn, d_p.nik');
    $this->db->from('users u');
    $this->db->join('dosen_profile d_p', 'u.id = d_p.user_id', 'inner'); 
    $this->db->where('level', 'Dosen');
    $query = $this->db->get();
    return $query->result_array();
    }

  public function get_doc_ta($id)
  {
    $this->db->select('d.id, d.nama_doc, d_p1.nama_dsn as pembimbing1, d_p2.nama_dsn as pembimbing2, d.submission, p1.status1, p2.status2, p1.file_revisi as revisi1, p2.file_revisi as revisi2');
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


  public function get_doc_ppi($id)
  {
    $this->db->select('d_i.id, d_i.nama_doc, d_i.pembimbing, d_i.submission, d_i.status_doc, d_i.revisi_sub, d_p.nama_dsn,');
    $this->db->from('document_ppi d_i');
    $this->db->join('dosen_profile d_p', 'd_p.user_id=d_i.pembimbing', 'left');
    $this->db->where('poster', $id);
    $this->db->where('doc_type', 'PPI');
    $query = $this->db->get();
    return $query->result_array();
  }


  public function get_riwayat_mhs_ppi($id)
  {
    $this->db->select('r.keterangan, r.created_at as tanggal, d_i.nama_doc, d_i.doc_type, r.status_sub, d_p.nama_dsn, d_p.nik,');
    $this->db->from('riwayat r');
    $this->db->join('document_ppi d_i', 'r.doc_id=d_i.id', 'left');
    $this->db->join('users u', 'r.create_by=u.id', 'left');
    $this->db->join('dosen_profile d_p', 'u.id=d_p.user_id', 'inner');
    $this->db->where('poster', $id);
    $this->db->where('doc_type', 'PPI');
    $query = $this->db->get();
      return $query->result_array();
  }

  public function get_riwayat_mhs_ta($id)
  {
    $this->db->select('r.keterangan, r.created_at as tanggal, d.nama_doc, d.doc_type, r.status_sub, d_p.nama_dsn, d_p.nik,');
    $this->db->from('riwayat r');
    $this->db->join('document_ta d', 'r.doc_id=d.id', 'left');
    $this->db->join('users u', 'r.create_by=u.id', 'left');
    $this->db->join('dosen_profile d_p', 'u.id=d_p.user_id', 'inner');
    $this->db->where('poster', $id);
    $this->db->where('doc_type', 'TA');
    $query = $this->db->get();
      return $query->result_array();
  }

  public function edit_sub($id, $data)
  {

    $this->db->where('id', $id);
    $this->db->update('document_ta', $data);
    /*$query = $this->db->update($table, $data, $where);
    return $query;*/
  }

  public function edit_ppi_sub($id, $data)
  {

    $this->db->where('id', $id);
    $this->db->update('document_ppi', $data);
  }

  public function update_sub($id)
  {
    $this->db->select('*');
    $this->db->from('document_ta');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function edit_sub_ppi($id)
  {
    $this->db->select('*');
    $this->db->from('document_ppi');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_bab1()
  {
    $this->db->select('*');
    $this->db->from('document_ta');
    $this->db->where('nama_doc', 'BAB I');
    $query = $this->db->get();
    return $query->result_array();
  }

}
?>
