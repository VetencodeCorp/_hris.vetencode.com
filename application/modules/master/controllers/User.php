<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login(); 
		is_permit('user');
		if(is_access() > 1){
			is_absen();
		}
		$this->load->model('master/muser', 'user');
		$this->data['title'] = 'Data User';
		$this->data['number'] = 1;
		
		$this->data['selectAkses'] = $this->user->getSelectAkses(is_access());
		$this->data['listUser'] = $this->user->getListUser(is_access());
	}
// ===================== index ====================
	public function index(){
		$this->load->view('master/user/index', $this->data);
	} 
	
	public function add(){
		$this->load->view('master/user/add', $this->data);
	}
	
	public function check_phone($id = NULL){
		$phone = $this->input->post('phone');
		echo $this->user->checkPhoneByPhone($phone, $id);
	}
	
	public function alert_action(){
		$data = array(
			'id' => $this->input->post('id'),
			'method' => $this->input->post('method')
		);
		echo $this->load->view('master/user/alert', $data);
	}
	
	public function update($idnya){
		$id = encrypt_decrypt($idnya, 'decrypt');
		$this->data['user'] = $this->user->getUserById($id);  
		$this->data['updateSelectAkses'] = $this->user->getUpdateSelectAkses($this->data['user']->access_id, is_access());
		$this->load->view('master/user/update', $this->data);
	}

// ========================== insert ==============================
	public function insert(){
		echo $this->user->insert();
	}
	
// ========================== update ==============================
	public function submit_alert(){
		$id = $this->input->post('id');
		$method = $this->input->post('method');
		echo $this->user->update_alert($id, $method);
	}
	
	public function submit_update($id){
		echo $this->user->update($id);
	}
	
	
}