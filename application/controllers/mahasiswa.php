<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	var $header = 'mahasiswa/header';
	public function __construct()
	{
	    parent::__construct();
	   
	   $level = $this->session->userdata('level');

		if ($level === FALSE) {
			redirect('auth');
		} else if ($level === 'admin') {
			redirect('admin');
		} else if ($level === 'dosen') {
			redirect('dosen');
		}

		$this->load->library('session');
		$this->load->model('users_model');
		$this->load->model('mahasiswa_model');
		$this->load->library('form_validation');
	}


	public function index()
	{
		$id 				= $this->session->userdata('id');
		$data['user']		= $this->session->userdata('nama_mhs');
		$data['profile'] 	= $this->mahasiswa_model->get_profile_mhs($id);
		$data['title']		= 'Welcome Mahasiswa';
		$data['header'] 	= $this->header;
		$data['page']		= 'mahasiswa/index';
		$this->load->view('layout/app', $data);
	}


	public function tugas_akhir()
	{
		$id 	= $this->session->userdata('id');
		$nim 	= $this->session->userdata('nim');	
		$data['user']		= $this->session->userdata('nama_mhs');
		$data['status'] 	= $this->mahasiswa_model->status_data_ppi($nim);
		$data['profile'] 	= $this->mahasiswa_model->get_profile_mhs($id);
		$data['docs'] 		= $this->mahasiswa_model->get_doc_ta($id);
		$data['options']	= $this->mahasiswa_model->select_dosen();
		$data['dosen']	    = $this->mahasiswa_model->get_dosen_ta($nim);
		$data['title']		= 'Halaman Tugas Akhir';
		$data['header'] 	= $this->header;
		$data['page']		= 'mahasiswa/tugas_akhir';
		$this->load->view('layout/app', $data);
	}

	public function ppi()
	{
		$id = $this->session->userdata('id');
		$nim = $this->session->userdata('nim');
		$data['user']	= $this->session->userdata('nama_mhs');
		$data['profile'] 	= $this->mahasiswa_model->get_profile_mhs($id);
		$data['docs_ppi'] = $this->mahasiswa_model->get_doc_ppi($id);
		$data['options'] = $this->mahasiswa_model->select_dosen();
		$data['dosen']	    = $this->mahasiswa_model->get_dosen_ppi($nim);
		$data['title']	= 'Halaman PPI';
		$data['header'] = $this->header;
		$data['page']	= 'mahasiswa/ppi';
		$this->load->view('layout/app', $data);
	}

	public function riwayat()
	{
		$id = $this->session->userdata('id');	
		$data['user']		= $this->session->userdata('nama_mhs');
		$data['profile'] 	= $this->mahasiswa_model->get_profile_mhs($id);
		$data['riwayat']	= $this->mahasiswa_model->get_riwayat_mhs_ppi($id);
		$data['riwayat2']	= $this->mahasiswa_model->get_riwayat_mhs_ta($id);
		$data['title']		= 'Halaman Riwayat';
		$data['header'] 	= $this->header;
		$data['page']		= 'mahasiswa/riwayat';
		$this->load->view('layout/app', $data);
	}

	public function bantuan()
	{
		$data['user']	= $this->session->userdata('nama_mhs');
		$data['title']	= 'Halaman Bantuan';
		$data['header'] = $this->header;
		$data['page']	= 'mahasiswa/bantuan';
		$this->load->view('layout/app', $data);
	}

	public function chat()
	{
		$id = $this->session->userdata('id');
		$data['user']	= $this->session->userdata('nama_mhs');
		$data['chat'] 	= $this->users_model->get_user_chat();
		$data['title']	= 'Halaman Bantuan';
		$data['header'] = $this->header;
		$data['page']	= 'mahasiswa/chat';
		$this->load->view('layout/app', $data);
	}

	public function get_message_chat()
	{
		$id = $this->session->userdata('id');
		$id2 = '162';
		$data['id'] = $this->session->userdata('id');
		$data['id2'] = '162';
		$data['message'] = $this->mahasiswa_model->get_self_chat($id, $id2);
		/*$data['message2'] = $this->mahasiswa_model->get_other_chat($id, $id2);*/
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		$this->load->view('mahasiswa/chat_data', $data);
		
	}

	public function password()
	{
		$id = $this->session->userdata('id');
		$data['user_id'] = $this->session->userdata('id');
		$data['user']	 = $this->session->userdata('nama_mhs');
		$data['profile'] 	= $this->mahasiswa_model->get_profile_mhs($id);
		$data['title']	 = 'Halaman Password';
		$data['header']  = $this->header;
		$data['page']	 = 'mahasiswa/password';
		$this->load->view('layout/app', $data);
	}

	public function send_chat()
	{
		$id = $this->session->userdata('id');
		$konten	= $this->input->post('pesan');
		$send_to = '162';

		$send = $this->mahasiswa_model->chat_user($id, $konten, $send_to);

		
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

				// alert message
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-danger">
          		Password Lama <strong>Salah</strong>.</div>');

          		redirect('mahasiswa/password');

          	}elseif ($this->input->post('confirmpass') != $this->input->post('newpass')) {

          		// alert message
          		$this->session->set_flashdata('message', '<br><br><div class="alert alert-danger">
          		Password Baru atau Konfirmasi Password <strong>Salah</strong>.</div>');

          		redirect('mahasiswa/password');
          	
			}elseif ($this->input->post('confirmpass') == $this->input->post('newpass')) {

				$this->users_model->update_password('users', $new_pass, $user_id);
			
				// success message
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
	          	Update Password <strong>Berhasil</strong>.</div>');

				redirect('mahasiswa/password');
			}
			
		}


	}

	public function profile()
	{
		$id = $this->session->userdata('id');
		$user = $this->users_model->get_user($id);
		if ($user == TRUE) {
			$data = array(
				"profile"	=> $this->mahasiswa_model->get_profile_mhs($id),
				"user_id"	=> $user["user_id"],
				"nama_mhs" 	=> $user["nama_mhs"],
				"nim"		=> $user["nim"],
				"kelas"		=> $user["kelas"],
				"title"		=> 'Halaman Profile',
				"header"	=> $this->header,
				"page"		=> 'mahasiswa/profile'
			);
			$this->load->view('layout/app', $data);
		}
	}

	public function profile_update()
	{
		$config_rules = array(
			array(
				'field' => 'nama_mhs',
				'label' => 'Nama_mhs',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => 'Masukan nama lengkap dengan benar.',
                ),
			),
			array(
				'field' => 'nim',
				'label' => 'NIM',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => 'Masukan %s dengan benar.',
                ),
			),

			array(
				'field' => 'kelas',
				'label' => 'Kelas',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => 'Masukan nama %s dengan benar. Contoh D3TI3-A',
                ),
			),
		);
		
		$user_id = array('user_id' => $this->input->post('user_id', TRUE));

		$data = array(
			'nama_mhs'		=> $this->input->post('nama_mhs', TRUE),
			'nim'		    => $this->input->post('nim', TRUE),
			'kelas'			=> $this->input->post('kelas', TRUE),
			'jurusan'		=> 'Teknik Informatika'
			
		);

		$this->form_validation->set_rules($config_rules);
		if ($this->form_validation->run() == FALSE) {
			$this->profile();
		} else {
			// insert into mhs_profiles
			$this->users_model->update_user('mhs_profile', $data, $user_id);
			
			// success message
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          	Update profile <strong>Berhasil</strong>.</div>');

			redirect('mahasiswa/profile');			
		}
	}


	public function do_post_doc()
	{
		$user_id = $this->session->userdata('id');

		$config['file_type'] 	 =	 "pdf";
		$config['upload_path']   =   "assets/pdfjs/web/uploads/";
		$config['allowed_types'] =   "pdf"; 
		$config['max_size']      =   "10000";
		$config['max_width']     =   "3000";
		$config['max_height']    =   "3000";
       	$this->upload->initialize($config);
		$this->load->library('upload',$config);

		if(!$this->upload->do_upload()){
			echo $this->upload->display_errors();
		} else {
			$finfo=$this->upload->data();
			$file_name = $finfo['file_name'];

			$data_doc_ta = array(
				'doc_type'		=> $this->input->post('doc_type'),
				'nama_doc' 		=> $this->input->post('nama'),
				'poster' 		=> $user_id,
				'submission' 	=> $file_name,
				'pembimbing1' 	=> $this->input->post('pembimbing1'),
				'pembimbing2' 	=> $this->input->post('pembimbing2'),
				'create_at' 	=> date('Y-m-d H:i:s')
			);

			$doc_id = $this->mahasiswa_model->add_doc_ta('document_ta', $data_doc_ta);

			$data_pem1 = array(
				'doc_id' 		=> $doc_id,
				'id_dosen' 		=> $this->input->post('pembimbing1'),
				'status1' 		=> 'draft',
				'file_revisi' 	=> ''
			);

			$this->mahasiswa_model->add_pembimbing('pembimbing1_ta', $data_pem1);

			$data_pem2 = array(
				'doc_id' 		=> $doc_id,
				'id_dosen' 		=> $this->input->post('pembimbing2'),
				'status2' 		=> 'draft',
				'file_revisi' 	=> ''
			);

			$this->mahasiswa_model->add_pembimbing('pembimbing2_ta', $data_pem2);

			if ($doc_id) {
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Upload '.$data_doc_ta['nama_doc'].' <strong>Berhasil</strong>.</div>');
				redirect('mahasiswa/tugas_akhir');
			}
			else{
				echo "gagal";
			}			
		}

	}

	public function do_post_doc_ppi()
	{
		$user_id = $this->session->userdata('id');

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
			$type = $this->input->post('doc_type');
			$nama = $this->input->post('nama');
			$file_name = $finfo['file_name'];
			$pembimbing = $this->input->post('pembimbing');
			$status = 'draft';
			$suc_upload = $this->mahasiswa_model->add_doc_ppi($type, $nama, $user_id, $file_name, $pembimbing, $status);
			if ($suc_upload) {
				$this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Upload '.$nama.' <strong>Berhasil</strong>.</div>');
				redirect('mahasiswa/ppi');
			}
			else{
				echo "gagal";
			}			
		}

	}

	public function edit_submission()
	{
		$id = $this->input->post('id');

		$config['file_type'] 	 =	 "pdf";
		$config['upload_path']   =   "assets/pdfjs/web/uploads/";
		$config['allowed_types'] =   "pdf"; 
		$config['max_size']      =   "10000";
       	$this->upload->initialize($config);
		$this->load->library('upload',$config);
		$this->upload->overwrite = true;

		if(!$this->upload->do_upload()){
			echo $this->upload->display_errors();
		} else {
			$finfo = $this->upload->data();
			$file_name = $finfo['file_name'];

			$data  = array(
			      'submission'=> $file_name,
			      'update_at' => date('Y-m-d H:i:s')
			);

			$this->mahasiswa_model->edit_sub($id, $data);
			$succes_edit = $this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Edit Submission <strong>Berhasil</strong>.</div>');

			redirect('mahasiswa/tugas_akhir', $succes_edit);
				
		}
	}

	public function edit_submission_ppi()
	{
		$id = $this->input->post('id');

		$config['file_type'] 	 =	 "pdf";
		$config['upload_path']   =   "assets/pdfjs/web/uploads/";
		$config['allowed_types'] =   "pdf"; 
		$config['max_size']      =   "10000";
       	$this->upload->initialize($config);
		$this->load->library('upload',$config);
		$this->upload->overwrite = true;

		if(!$this->upload->do_upload()){
			echo $this->upload->display_errors();
		} else {
			$finfo = $this->upload->data();
			$file_name = $finfo['file_name'];

			$data  = array(
			      'submission'=> $file_name,
			      'update_at' => date('Y-m-d H:i:s')
			);

			$this->mahasiswa_model->edit_ppi_sub($id, $data);
			$succes_edit = $this->session->set_flashdata('message', '<br><br><div class="alert alert-success">
          			Edit Submission '.$nama.' <strong>Berhasil</strong>.</div>');

			redirect('mahasiswa/ppi', $succes_edit);
					
		}
	}	

	public function update_submission($id)
	{
		$data = $this->mahasiswa_model->update_sub($id);
		echo json_encode($data);
	}

	public function update_sub_ppi($id)
	{
		$data = $this->mahasiswa_model->edit_sub_ppi($id);
		echo json_encode($data);
	}

	public function get_doc_bab_1()
	{
		$data = $this->mahasiswa_model->get_bab1();

		print_r($data);	
	}

	


}
