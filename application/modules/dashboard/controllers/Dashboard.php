<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		if(is_access() > 1){
			is_absen();
		}
		$this->load->model('dashboard/mdashboard', 'dashboard');
		$this->data['title'] = 'Dashboard';
		$this->data['profile'] = $this->dashboard->getProfile(); 
		$this->data['absen'] = $this->dashboard->getAbsenByUserId(getUser()->id);
		$this->data['insentifMingguan'] = $this->dashboard->getInsentifMingguanByUserId(getUser()->id);
		$this->data['insentifBulanan'] = $this->dashboard->getInsentifBulananByUserId(getUser()->id); 
		$this->data['keterangan'] = $this->dashboard->getKeteranganByUserId(getUser()->id);
	}
// ===================== index ====================
	public function index(){
		$this->load->view('dashboard/index', $this->data);
	} 
	
// profile
	public function profile(){
		$this->load->view('dashboard/profile', $this->data);
	}
	
// ========================= update ========================
// profile
	public function update_profile(){
		$data = array(
			'fullname' => $this->input->post('fullname'), 
			'seoname' => getSeoName($this->input->post('fullname')), 
			'phone' => $this->input->post('phone'), 
		);
		if($this->input->post('password')){
			$data['password'] = md5($this->input->post('password'));
		}
		echo $this->dashboard->update_profile($data, $this->session->userdata('id'));
	}
	
	
	
}