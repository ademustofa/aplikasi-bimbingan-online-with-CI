<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	var $header = 'header';
	public function __construct()
	{
	    parent::__construct();

		$this->load->model('admin_model');

	}

	public function index()
	{
		$data['post']   = $this->admin_model->get_pemberitahuan();
		$data['title']  = 'Welcome';
		$data['header'] = 'header';
		$data['page']	= 'welcome_message';
		$this->load->view('layout/app', $data);
	}

	
}
