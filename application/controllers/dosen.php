<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	var $header = 'dosen/header';

	public function __construct(){
	    parent::__construct();

	    $level = $this->session->userdata('level');

		if ($level === FALSE) {
			redirect('auth');
		} else if ($level === 'admin') {
			redirect('admin');
		} else if ($level === 'mahasiswa') {
			redirect('mahasiswa');
		}
	   


		$this->load->library('session');
		$this->load->model('users_model','',TRUE);
		$this->load->model('dosen_model','',TRUE);
	  }


	public function index()
	{
		$data['user']	= $this->session->userdata('nama_dsn');
		$data['title']	= 'Welcome Dosen';
		$data['header'] = $this->header;
		$data['page']	= 'dosen/index';
		$this->load->view('layout/app', $data);
	}

	public function ppi()
	{
		$id 				= $this->session->userdata('id');
		$data['nik']        = $this->session->userdata('nik');
		$data['user']		= $this->session->userdata('nama_dsn');
		$data['docs_ppi']	= $this->dosen_model->get_doc_ppi($id);	
		$data['title']		= 'Halaman PPI';
		$data['header'] 	= $this->header;
		$data['page']		= 'dosen/ppi';
		$this->load->view('layout/app', $data);
	}

	public function ubah_status_data_ta()
	{
		$id = $this->input->post('id', TRUE);
		$status = $this->input->post('status_ta');
		$this->dosen_model->status_data_ta($id, $status);
		echo json_encode($id);
	}

	public function get_bimbingan_mhs_ppi()
	{
		$nik  = $this->session->userdata('nik');
		$data = $this->dosen_model->get_mhs_bimbingan($nik);
		echo json_encode($data);
	}

	public function get_bimbingan_mhs_ta1()
	{
		$nik = $this->session->userdata('nik');
		$data = $this->dosen_model->get_mhs_bimbingan_ta1($nik);
		echo json_encode($data);
	}

	public function get_bimbingan_mhs_ta2()
	{
		$nik = $this->session->userdata('nik');
		$data = $this->dosen_model->get_mhs_bimbingan_ta2($nik);
		echo json_encode($data);
	}

	public function tugas_akhir()
	{
		$id = $this->session->userdata('id');
		$data['nik'] = $this->session->userdata('nik');
		$data['docs_ta'] = $this->dosen_model->get_doc_ta($id);	
		$data['user']	= $this->session->userdata('nama_dsn');
		$data['title']	= 'Halaman Tugas Akhir';
		$data['header'] = $this->header;
		$data['page']	= 'dosen/tugas_akhir';
		$this->load->view('layout/app', $data);
	}

	public function ubah_status()
	{
		$id = array('doc_id' => $this->input->post('id', TRUE));
		$id2 = $this->input->post('id');
		$status = $this->input->post('status');

		$cek_pem1 = $this->dosen_model->get_pembimbing1($id2);
		$cek_pem2 = $this->dosen_model->get_pembimbing2($id2);

		if($this->session->userdata('id') == $cek_pem1['id_dosen'])
		{
			$data = array(
			'status1'	=> $status
			);

			$this->dosen_model->status_ubah('pembimbing1_ta', $data, $id);
		}elseif($this->session->userdata('id') == $cek_pem2['id_dosen'])
		{
			
			$data = array(
			'status2'	=> $status
			);

			$this->dosen_model->status_ubah('pembimbing2_ta', $data, $id);
		}
		

		/*$id2 = $this->input->post('id');*/
		$create_by  = $this->session->userdata('id');
		$keterangan = $this->input->post('keterangan');
		$this->dosen_model->send_riwayat($id2, $create_by, $keterangan, $status);

		echo json_encode($id);
	}

	public function ubah_status_ppi()
	{
		$id = $this->input->post('id', TRUE);
		$status = $this->input->post('status');
		$this->dosen_model->status_ubah_ppi($id, $status);

		$create_by  = $this->session->userdata('id');
		$keterangan = $this->input->post('keterangan');
		$this->dosen_model->send_riwayat($id, $create_by, $keterangan, $status);

		echo json_encode($id);
	}


	public function riwayat()
	{
		$id = $this->session->userdata('id');	
		$data['user']	= $this->session->userdata('nama_dsn');
		$data['riwayat_ppi']= $this->dosen_model->get_riwayat_ppi($id);
		$data['riwayat_ta']= $this->dosen_model->get_riwayat_ta($id);
		$data['title']	= 'Halaman Riwayat';
		$data['header'] = $this->header;
		$data['page']	= 'dosen/riwayat';
		$this->load->view('layout/app', $data);
	}

	public function password()
	{
		$data['user_id'] = $this->session->userdata('id');
		$data['user']	 = $this->session->userdata('nama_dsn');
		$data['title']	 = 'Halaman Ganti Password';
		$data['header']  = $this->header;
		$data['page']	 = 'dosen/password';
		$this->load->view('layout/app', $data);
	}

	public function change_password()
	{
		$config_rules = array(
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => 'Masukan Password Lama.',
                ),
			),
			array(
				'field' => 'newpass',
				'label' => 'New Password',
				'rules' => 'required|min_length[6]|max_length[20]|trim',
				'errors' => array(
                        'required' => 'Masukan Password Baru.',
                ),
			),

			array(
				'field' => 'confirmpass',
				'label' => 'Confirm Password',
				'rules' => 'required|min_length[6]|max_length[20]|trim',
				'errors' => array(
                        'required' => 'Masukan Konfirmasi Password',
                ),
			),
		);

		
		$id 		= $this->session->userdata('id');
		$user 		= $this->users_model->get_pass($id);
		$old_pass 	= md5($this->input->post('password', TRUE));

		$user_id 	= array('id' => $this->input->post('user_id', TRUE));
		$new_pass 	= array(
			'password'		=> md5($this->input->post('newpass', TRUE))	
		);

		$this->form_validation->set_rules($config_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->password();
		} else {
			if ($old_pass != $user['password'] ) {

				// success message
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-danger">
          		Password Lama <strong>Salah</strong>.</div>');

          		redirect('dosen/password');

          	}elseif ($this->input->post('confirmpass') != $this->input->post('newpass')) {

          		// success message
          		$this->session->set_flashdata('message', '<br><br><div class="alert alert-danger">
          		Password Baru atau Konfirmasi Password <strong>Salah</strong>.</div>');

          		redirect('dosen/password');
          	
			}elseif ($this->input->post('confirmpass') == $this->input->post('newpass')) {

				$this->users_model->update_password('users', $new_pass, $user_id);
			
				// success message
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
	          	Update Password <strong>Berhasil</strong>.</div>');

				redirect('dosen/password');
			}
			
		}


	}

	public function profile()
	{
		$id = $this->session->userdata('id');
		$user = $this->dosen_model->get_user_dosen($id);
		if ($user == TRUE) {
			$data = array(
				"user_id"	=> $user["user_id"],
				"nama_dsn" 	=> $user["nama_dsn"],
				"nik"		=> $user["nik"],
				"no_hp"		=> $user["no_hp"],
				"email"		=> $user["email"],
				"title"		=> 'Halaman Profile Dosen',
				"header"	=> $this->header,
				"page"		=> 'dosen/profile'
			);
			$this->load->view('layout/app', $data);
		}
	}

	public function profile_update()
	{
		$config_rules = array(
			array(
				'field' => 'nama_dsn',
				'label' => 'Nama_dsn',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => 'Masukan Nama Lengkap dengan benar.',
                ),
			),
			array(
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => 'Masukan %s dengan benar.',
                ),
			),

			array(
				'field' => 'no_hp',
				'label' => 'No_hp',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => 'Masukan nama Nomor Handphone dengan benar.',
                ),
			),

			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => 'Masukan %s dengan benar.',
                ),
			),
		);
		
		$user_id = array('user_id' => $this->input->post('user_id'));

		$data = array(
			'nama_dsn'		=> $this->input->post('nama_dsn'),
			'nik'			=> $this->input->post('nik'),
			'no_hp'			=> $this->input->post('no_hp'),
			'email'			=> $this->input->post('email'),
			
		);

		$this->form_validation->set_rules($config_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->profile();
		} else {
			// insert into mhs_profiles
			echo "<pre>";
			print_r($data);
			echo "</pre>";
			$this->dosen_model->update_profile('dosen_profile', $data, $user_id);
			
			// success message
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          	Update profile <strong>Berhasil</strong>.</div>');

			redirect('dosen/profile');			
		}
	}

	public function bantuan()
	{
		$data['user']	= $this->session->userdata('nama_dsn');
		$data['title']	= 'Halaman Bantuan';
		$data['header'] = $this->header;
		$data['page']	= 'dosen/bantuan';
		$this->load->view('layout/app', $data);
	}

	public function post_pengumuman()
	{
		$user_id = $this->session->userdata('id');
		$post = $this->input->post('keterangan');
		$suc_post = $this->dosen_model->add_pengumuman($user_id, $post);
			if ($suc_post) {
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Pemberitahuan <strong>Berhasil</strong> di Posting.</div>');
				redirect('dosen/index');
			}
			else{
				echo "gagal";
			}			
	}

	public function revisi_sub()
	{
		$id = array('doc_id' => $this->input->post('id', TRUE));
		$id2 = $this->input->post('id');
		$cek_pem1 = $this->dosen_model->get_pembimbing1($id2);
		$cek_pem2 = $this->dosen_model->get_pembimbing2($id2);

		$config['file_type'] 	 =	 "pdf";
		$config['upload_path']   =   "assets/pdfjs/web/uploads/";
		$config['allowed_types'] =   "pdf"; 
		$config['max_size']      =   "10000";
       	$this->upload->initialize($config);
		$this->load->library('upload',$config);
		$this->upload->overwrite = true;

		if(!$this->upload->do_upload()){
			echo $this->upload->display_errors();
		}
		else{
			$finfo = $this->upload->data();
			$file_name = $finfo['file_name'];

			if($this->session->userdata('id') == $cek_pem1['id_dosen'])
			{
				/*redirect('mahasiswa/riwayat');*/
				$data  = array(
				      'file_revisi' => $file_name
				);

				$this->dosen_model->revisi('pembimbing1_ta', $data, $id);


			}elseif($this->session->userdata('id') == $cek_pem2['id_dosen'])
			{
				
				/*redirect('mahasiswa/ppi');*/	
				$data  = array(
			      'file_revisi'=> $file_name
				);

				$this->dosen_model->revisi('pembimbing2_ta', $data, $id);


			}

			$succes_edit = $this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Upload File Revisi <strong>Berhasil</strong>.</div>');

			redirect('dosen/tugas_akhir', $succes_edit);
		
		}
	}

	public function revisi_ppi()
	{
		$id = array('id' => $this->input->post('id', TRUE));

		$config['file_type'] 	 =	 "pdf";
		$config['upload_path']   =   "assets/pdfjs/web/uploads/";
		$config['allowed_types'] =   "pdf"; 
		$config['max_size']      =   "10000";
       	$this->upload->initialize($config);
		$this->load->library('upload',$config);

		if(!$this->upload->do_upload()){
			echo $this->upload->display_errors();
		} else {
			$finfo=$this->upload->data();
			$file_name = $finfo['file_name'];

			$data  = array(
			      'revisi_sub'=> $file_name
			);

			$suc_upload = $this->dosen_model->revisi('document_ppi', $data, $id);
			if ($suc_upload) {
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Upload File Revisi <strong>Berhasil</strong>.</div>');
				redirect('dosen/ppi');
			}
			else{
				echo "gagal";
			}			
		}

	}

	public function upload_revisi($id)
	{
		$data = $this->dosen_model->revisi_sub($id);
		echo json_encode($data);
	}

	public function upload_revisi_ppi($id)
	{
		$data = $this->dosen_model->revisi_sub_ppi($id);
		echo json_encode($data);
	}

}
