<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Akses extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		is_permit('akses');
		if(is_access() > 1){
			is_absen();
		}
		$this->load->model('master/makses', 'akses');
		$this->data['title'] = 'Data Akses';
		$this->data['number'] = 1;
		$this->data['listAkses'] = $this->akses->getListAkses(is_access());
	}
// ===================== index ====================
	public function index(){
		$this->load->view('master/akses/index', $this->data);
	} 
	
	public function add(){
		$this->load->view('master/akses/add', $this->data);
	}
	
	public function update($idnya){
		$id = encrypt_decrypt($idnya, 'decrypt');
		$this->data['akses'] = $this->akses->getAksesById($id); 
		$this->load->view('master/akses/update', $this->data);
	}
	
	public function alert_action(){
		$data = array(
			'id' => $this->input->post('id'),
			'method' => $this->input->post('method')
		);
		echo $this->load->view('master/akses/alert', $data);
	}
	
// ======================== insert ==========================
	public function insert(){
		echo $this->akses->insert();
	}
	
// ======================== update ===========================
	public function submit_update($id){
		echo $this->akses->update($id);
	}
	
	public function submit_alert(){
		$id = $this->input->post('id');
		$method = $this->input->post('method');
		echo $this->akses->update_alert($id, $method);
	}
	
}