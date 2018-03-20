<?php
class Anotasi_model extends CI_Model{

	public function __construct(){
	    $this->load->database();
	  }

	public function get_anotasi() {

		$this->db->select('*');
		$this->db->from('annotation');
		$query = $this->db->get();
	    return $query->result_array();
  	}

  	public function edit_decode($id, $data)
  	{
  		$this->db->where('id', $id);
    	$this->db->update('annotation', $data);
  	}
}
?>
