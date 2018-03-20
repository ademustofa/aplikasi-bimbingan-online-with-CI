<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	var $header = 'admin/header';

	public function __construct(){
	    parent::__construct();

	    $level = $this->session->userdata('level');

		if ($level === FALSE) {
			redirect('auth');
		} else if ($level === 'dosen') {
			redirect('dosen');
		} else if ($level === 'mahasiswa') {
			redirect('mahasiswa');
		}

	   $this->load->model('admin_model','',TRUE);
	   $this->load->model('mahasiswa_model','',TRUE);  	
	  }


	public function index()
	{
		$data['user']	= $this->session->userdata('username');
		$data['title']	= 'Welcome Admin';
		$data['header'] = $this->header;
		$data['page']	= 'admin/index';
		$this->load->view('layout/app', $data);
	}

	public function user()
	{
		$data['user']	= $this->session->userdata('username');
		$data['user_mhs']	= $this->admin_model->get_user_data_mhs();
		$data['user_dsn']	= $this->admin_model->get_user_data_dsn();
		$data['title']	= 'Halaman User';
		$data['header'] = $this->header;
		$data['page']	= 'admin/user';
		$this->load->view('layout/app', $data);
	}

	public function data_mhs()
	{
		$data['user']	= $this->session->userdata('username');
		/*$data['ppi'] = $this->admin_model->get_ppi();*/
		$data['mahasiswa']	= $this->admin_model->get_user_mhs();
		$data['title']	= 'Halaman Data Mahasiswa';
		$data['header'] = $this->header;
		$data['page']	= 'admin/data_mhs';
		$this->load->view('layout/app', $data);
	}

	public function upload_data()
	{
		$data['user']	= $this->session->userdata('username');
		$data['data_ta']	= $this->admin_model->get_data_tugas_akhir();
		$data['data_ppi']	= $this->admin_model->get_data_ppi();
		$data['options'] = $this->mahasiswa_model->select_dosen();
		$data['title']	= 'Halaman Tugas Akhir';
		$data['header'] = $this->header;
		$data['page']	= 'admin/ta';
		$this->load->view('layout/app', $data);
	}

	public function get_bimbingan()
	{
		$data["id_dosen"] = $this->input->post("id_dosen"); 
		$id = explode(",",$this->input->post("id_mhs"));
		$data["id_mhs"] = $id[1];

		$this->db->insert("bimbingan_ppi", $data);
	}

	public function get_bimbingan_ta()
	{
		$data["id_dosen"] = $this->input->post("id_dosen"); 
		$id1 = explode(",",$this->input->post("id_mhs1"));
		/*$id2 = explode(",",$this->input->post("id_mhs2"));*/
		$data["id_mhs1"] = $id1[1];
		/*$data["id_mhs2"] = $id2[1];*/

		$this->db->insert("bimbingan_ta", $data);
	}

	public function get_bimbingan_ta2()
	{
		$data["id_dosen"] = $this->input->post("id_dosen"); 
		/*$id1 = explode(",",$this->input->post("id_mhs1"));*/
		$id2 = explode(",",$this->input->post("id_mhs2"));
		/*$data["id_mhs1"] = $id1[1];*/
		$data["id_mhs2"] = $id2[1];

		$this->db->insert("bimbingan_ta", $data);
	}



	public function data_dosen()
	{
		$data['dosen']	= $this->admin_model->get_user_dosen();
		$data['user']	= $this->session->userdata('username');
		$data['title']	= 'Halaman Data Dosen';
		$data['header'] = $this->header;
		$data['page']	= 'admin/data_dosen';
		$this->load->view('layout/app', $data);
		//echo json_encode($mhs);
	}


	public function add_pengumuman()
	{
		$user_id 	= $this->session->userdata('id');
		$judul 		= $this->input->post('judul');
		$post 		= $this->input->post('keterangan');
		$suc_post 	= $this->admin_model->tambah_pengumuman($user_id, $judul, $post);
			if ($suc_post) {
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Pemberitahuan <strong>Berhasil</strong> di Posting.</div>');
				redirect('admin/index');
			}
			else{
				echo "gagal";
			}			
	}

	public function tambah_user()
	{	

			$data_user = array(
				'username'	=> $this->input->post('username', TRUE),
				'password'	=> md5($this->input->post('password', TRUE)),
				'level'		=> $this->input->post('level', TRUE),
				
			);
		
			$user_id = $this->admin_model->add_user('users', $data_user); // ngedapetin user_id dari return $this->db->insert_id()
			if ($this->input->post('level') == 'Mahasiswa') {
				$this->admin_model->add_user_mhs('mhs_profile', array(
					'user_id' 	=> $user_id,
					'nama_mhs'  => '', // diisi nanti saat update profil
					'nim'	=> '', // diisi nanti saat update profil
					'kelas'		=> '', // diisi nanti saat update profil
					'jurusan'	=> '', // diisi nanti saat update profil
				));
			}else if($this->input->post('level') == 'Dosen') {	
				$this->admin_model->add_user_dosen('dosen_profile', array(
					'user_id' 	=> $user_id,
					'nama_dsn'  => '', // diisi nanti saat update profil
					'nik'		=> '', // diisi nanti saat update profil
					'no_hp'		=> '', // diisi nanti saat update profil
					'email'		=> '', // diisi nanti saat update profil
				));
			}

			if ($user_id) {
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Create User <strong>Berhasil</strong>.</div>');
				redirect('admin/user');
			}
			else{
				echo "gagal";
			}				
		
	}

	public function update_profile()
	{
		$user_id = array('user_id' => $this->input->post('user_id', TRUE));

		$data = array(
			/*'user_id'	=> $user_id,*/
			'nama_mhs'	=> $this->input->post('nama_mhs', TRUE),
			'nim'	=> $this->input->post('nim', TRUE),
			'kelas'		=> $this->input->post('kelas', TRUE),
			'jurusan'	=> 'Teknik Informatika'
		);

		$update_succes = $this->admin_model->update_user('mhs_profile', $data, $user_id);
			
		if ($update_succes) {
		// success message
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
	         Update profile <strong>Berhasil</strong>.</div>');

			redirect('admin/user');
		}else{
			echo "gagal";
		}			
	}

	public function update_profile_dosen()
	{
		$user_id = array('user_id' => $this->input->post('user_id', TRUE));

		$data = array(
			/*'user_id'	=> $user_id,*/
			'nama_dsn'	=> $this->input->post('nama_dsn', TRUE),
			'nik'		=> $this->input->post('nik', TRUE),
			'no_hp'		=> $this->input->post('no_hp', TRUE),
			'email'		=> $this->input->post('email', TRUE),
		);

		$update_succes = $this->admin_model->update_user_dosen('dosen_profile', $data, $user_id);
			
		if ($update_succes) {
		// success message
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
	         Update profile <strong>Berhasil</strong>.</div>');

			redirect('admin/user');
		}else{
			echo "gagal";
		}			
	}

	public function update_data_ppi()
	{
		$user_id = array('id' => $this->input->post('id', TRUE));

		$data = array(
			/*'user_id'	=> $user_id,*/
			'pembimbing'		=> $this->input->post('pembimbing', TRUE),
			'nama_magang'		=> $this->input->post('nama_magang', TRUE),
			'pembimbing_magang'	=> $this->input->post('pembimbing_magang', TRUE),
		);
		/*var_dump($data);*/

		$update_succes = $this->admin_model->update_ppi_data('data_ppi', $data, $user_id);
			
		if ($update_succes) {
		// success message
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
	         Update Data PPI <strong>Berhasil</strong>.</div>');

			redirect('admin/upload_data');
		}else{
			echo "gagal";
		}			
	}

	public function update_data_ta()
	{
		$user_id = array('id' => $this->input->post('id', TRUE));

		$data = array(
			/*'user_id'	=> $user_id,*/
			'judul'			=> $this->input->post('judul', TRUE),
			'pembimbing1'	=> $this->input->post('pembimbing1', TRUE),
			'pembimbing2'	=> $this->input->post('pembimbing2', TRUE),
		);
		/*var_dump($data);*/

		$update_succes = $this->admin_model->update_ta_data('data_ta', $data, $user_id);
			
		if ($update_succes) {
		// success message
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
	         Update Data TA <strong>Berhasil</strong>.</div>');

			redirect('admin/upload_data');
		}else{
			echo "gagal";
		}			
	}


	public function edit_data_ppi($id)
	{
		$data = $this->admin_model->edit_ppi_data($id);
		echo json_encode($data);
	}

	public function edit_data_ta($id)
	{
		$data = $this->admin_model->edit_ta_data($id);
		echo json_encode($data);
	}

	public function edit_profile($id)
	{
		$data = $this->admin_model->edit($id);
		echo json_encode($data);
	}

	public function edit_profile_dosen($id)
	{
		$data = $this->admin_model->edit_dosen($id);
		echo json_encode($data);
	}

	public function get_doc_mhs_ppi($id)
	{
		$data = $this->admin_model->get_ppi($id);
		echo json_encode($data);
	}

	public function get_doc_mhs_ta($id)
	{
		$data = $this->admin_model->get_ta($id);
		echo json_encode($data);
	}

	public function get_pembimbing_ppi($id)
	{
		$data = $this->admin_model->get_pem_ppi($id);
		echo json_encode($data);
	}

	public function get_pembimbing_ta1($id)
	{
		$data = $this->admin_model->get_pem_ta1($id);
		echo json_encode($data);
	}

	public function get_pembimbing_ta2($id)
	{
		$data = $this->admin_model->get_pem_ta2($id);
		echo json_encode($data);
	}

	public function delete_ppi_mhs()
	{
		$id= $this->input->post('id');
		$this->admin_model->delete_mhs_ppi($id);
		/*echo "{}";*/
	}

	public function delete_ta1_mhs()
	{
		$id= $this->input->post('id');
		$this->admin_model->delete_mhs_ta1($id);
		/*echo "{}";*/
	}

	public function delete_ta2_mhs()
	{
		$id= $this->input->post('id');
		$this->admin_model->delete_mhs_ta2($id);
		/*echo "{}";*/
	}

	public function delete_data_ppi()
	{
		$id= $this->input->post('id');
		$this->admin_model->delete_ppi_data($id);
		/*echo "{}";*/
	}

	public function delete_data_ta()
	{
		$id= $this->input->post('id');
		$this->admin_model->delete_ta_data($id);
		/*echo "{}";*/
	}

	public function ubah_status_data_ppi()
	{
		$id = $this->input->post('id', TRUE);
		$status = $this->input->post('status_ppi');
		$this->admin_model->status_data_ppi($id, $status);
		echo json_encode($id);
	}

	public function import_excel()
	{
		$config['upload_path']   =   "assets/file_csv/";
		$config['allowed_types'] =   "xls";
		$this->upload->initialize($config);
		$this->load->library('upload',$config);
		if($this->upload->do_upload()){
			$data = $this->upload->data();
			@chmod($data['full_path'], 0777);

			$this->load->library('Spreadsheet_Excel_Reader');
			$this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

			$this->spreadsheet_excel_reader->read($data['full_path']);
			$sheets = $this->spreadsheet_excel_reader->sheets[0];
			error_reporting(0);


			$data_excel = array();
 			for ($i = 2; $i <= $sheets['numRows']; $i++) {
 				if ($sheets['cells'][$i][1] == '') break;

 				$data_excel[$i - 1]['judul'] 			= $sheets['cells'][$i][1];
 				$data_excel[$i - 1]['nim'] 				= $sheets['cells'][$i][2];
 				$data_excel[$i - 1]['pembimbing1'] 		= $sheets['cells'][$i][3];
 				$data_excel[$i - 1]['pembimbing2'] 		= $sheets['cells'][$i][4];
 				$data_excel[$i - 1]['status_sidang'] 	= 'belum siap';
			}

			foreach ($data_excel as $key) {
				$this->db->select('id');
				$this->db->from('data_ta');
				$this->db->where('nim', $key['nim']);
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$this->db->where('nim', $key['nim']);
					$this->db->update('data_ta', $key);
				}else{
					$this->db->insert('data_ta', $key);	
				}

			}
			@unlink($data['full_path']);
		    
			
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
	         Upload Data TA <strong>Berhasil</strong>.</div>');	

			redirect('admin/upload_data');
		}
	}

	public function import_excel_ppi()
	{
		$config['upload_path']   =   "assets/file_csv/";
		$config['allowed_types'] =   "xls";
		$this->upload->initialize($config);
		$this->load->library('upload',$config);
		if($this->upload->do_upload()){
			$data = $this->upload->data();
			@chmod($data['full_path'], 0777);
			
			$this->load->library('Spreadsheet_Excel_Reader');
			$this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

			$this->spreadsheet_excel_reader->read($data['full_path']);
			$sheets = $this->spreadsheet_excel_reader->sheets[0];
			error_reporting(0);

			$data_excel = array();
 			for ($i = 2; $i <= $sheets['numRows']; $i++) {
 				if ($sheets['cells'][$i][1] == '') break;

 				$data_excel[$i - 1]['nim'] 				= $sheets['cells'][$i][1];
 				$data_excel[$i - 1]['pembimbing'] 		= $sheets['cells'][$i][2];
 				$data_excel[$i - 1]['nama_magang'] 		= $sheets['cells'][$i][3];
 				$data_excel[$i - 1]['pembimbing_magang']= $sheets['cells'][$i][4];
 				$data_excel[$i - 1]['status_ppi'] 		= 'belum'; 

			}


			foreach ($data_excel as $key) {
				$this->db->select('id');
				$this->db->from('data_ppi');
				$this->db->where('nim',$key['nim']);
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$this->db->where('nim', $key['nim']);
					$this->db->update('data_ppi', $key);
				}else{
					$this->db->insert('data_ppi', $key);	
				}

			}
			@unlink($data['full_path']);

			$data_user = array();
 			for ($i = 2; $i <= $sheets['numRows']; $i++) {
 				if ($sheets['cells'][$i][1] == '') break;

	 			$data_user[$i - 1]['username'] 	= $sheets['cells'][$i][1];
 				$data_user[$i - 1]['password'] 	= md5($sheets['cells'][$i][1]);
 				$data_user[$i - 1]['level'] 	= 'Mahasiswa'; 

			}

			foreach ($data_user as $key2) {
				$this->db->select('id');
				$this->db->from('users');
				$this->db->where('username', $key2['username']);
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					$this->db->where('username', $key2['username']);
					$this->db->update('users', $key2);
				}else{
					$this->db->insert('users', $key2);	
				}

			}

			$hasil = $this->admin_model->get_username($data_user);
			
			foreach ($hasil as $key) {
				$insert['user_id'] = $key['id'];

				$this->db->select('user_id');
				$this->db->from('mhs_profile');
				$this->db->where('user_id', $key['id']);
				$query = $this->db->get();
				if ($query->num_rows() > 0) {
					
				}else{
					$this->db->insert('mhs_profile', $insert);	
				}
				
			}

			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
	         Upload Data PPI <strong>Berhasil</strong>.</div>');

			redirect('admin/upload_data');
		}
	}
}
