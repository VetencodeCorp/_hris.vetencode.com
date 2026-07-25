<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load-> model('login/mlogin', 'login');

		$this->data['title'] = 'Login';
	}

// ========================= index ===========================
	public function index(){
		$this->load->view('login/index', $this->data);
	}

// auth
	public function auth(){
		$data = array(
			'phone' => $this->input->post('phone', TRUE),
			'password' => md5($this->input->post('password', TRUE)),
			'active' => 1
		);

		$getUser = $this->login->getUser($data);
		if ($getUser->num_rows() == 1) {
			foreach ($getUser->result() as $sess) {
				$sess_data['id'] = $sess->id;
				$sess_data['is_login'] = TRUE;
				$this->session->set_userdata($sess_data);
			}
			$id = $this->session->userdata('id');
			echo 'logged';
		} else { 
           	echo 'failed';
		}
	}
	
	// logout
	public function logout(){
		$this->session->unset_userdata('id');
		$this->session->unset_userdata('is_login');
		$this->session->sess_destroy();
		redirect(base_url());
	}
	
}
