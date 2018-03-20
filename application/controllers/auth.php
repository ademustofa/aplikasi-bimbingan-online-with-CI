<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {

	var $header = 'header';

	public function __construct(){
	    parent::__construct();

	    $this->load->helper('url');
	    $this->load->library('session');
	    $this->load->model('users_model','',TRUE);
	  }


	public function index()
	{
		$level = $this->session->userdata('level');

		if ($level === 'admin') {
			redirect('admin');
		} else if ($level === 'dosen') {
			redirect('dosen');
		} else if ($level === 'mahasiswa') {
			redirect('mahasiswa');
		}
		$data['title'] = 'Halaman Login';
		$data['header'] = 'header';	
		$data['page'] = 'form_login';
		$this->load->view('layout/app', $data);
	}

	public function cek_login()
	{

	$config_rules = array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => '%s tidak boleh kosong',
                ),
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|trim',
				'errors' => array(
                        'required' => '%s tidak boleh kosong',
                ),
			),
		);

		$this->form_validation->set_rules($config_rules);

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {

			$data = array('u.username' => $this->input->post('username'),
					  'u.password' => md5($this->input->post('password'))
			);

		$hasil = $this->users_model->cek_user($data);
		if ($hasil->num_rows() == 1) {
			$cek = $hasil->result_array();
			if ($cek[0]['level'] == 'Mahasiswa') {
				$data_profile = $this->users_model->profile_mhs($cek[0]['id']);
			}
			elseif($cek[0]['level'] == 'Dosen'){
				$data_profile = $this->users_model->profile_dsn($cek[0]['id']);
			}
			else{
				$data_profile = $cek;
			}
			foreach ($data_profile as $sess) {
				$sess_data['logged_in'] = 'Sudah Login';
				$sess_data['id'] 		= $sess['id'];
				$sess_data['username']  = $sess['username'];
				$sess_data['nik']  		= $sess['nik'];
				$sess_data['nim']  		= $sess['nim'];
				$sess_data['nama_mhs'] 	= $sess['nama_mhs'];
				$sess_data['nama_dsn'] 	= $sess['nama_dsn'];
				

				$sess_data['level'] = $sess['level'];
				$this->session->set_userdata($sess_data);
			}

			$level = $this->session->userdata('level');
			if ($level == 'admin') {
				redirect('admin');
			}
			elseif($level == 'Mahasiswa'){
				redirect('mahasiswa');
			}
			elseif($level == 'Dosen'){
				redirect('dosen');
			}else{
				print_r($data_profile);
			}
			
		}
		else {
			$this->session->set_flashdata('message', '<br><br><div class="alert alert-danger">
          			Username atau Password Salah, <strong>Coba lagi</strong>.</div>');
			redirect('auth');
		}
		}

		
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('auth');
	}
}
