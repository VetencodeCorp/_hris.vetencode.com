<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gapok extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		is_permit('gapok');
		if(is_access() > 1){
			is_absen();
		}
		
		$this->load->model('insentif/mgapok', 'gapok');
		$this->data['title'] = 'Insentif Gaji Pokok'; 
		$this->data['number'] = 1; 
		$this->data['selectUser'] = $this->gapok->getSelectUser(); 
		$this->data['listGapok'] = $this->gapok->getListGapok();
	}
// ===================== index ====================
	public function index(){
		$this->load->view('insentif/gapok/index', $this->data);
	} 
	
	public function add(){
		if(enableGapok() == 'disabled'){
			redirect('insentif-gapok');
		} else{
			$this->load->view('insentif/gapok/add', $this->data);
		}
	}
	
	public function get_data_user(){
		$user_id = $this->input->post('user_id');
		$user = $this->gapok->getUserById($user_id); 
		$dataArray = array(
			'gapok' => $user->gapok
		);
		echo json_encode($dataArray);
	}
	
	public function update($idnya){
		$id = encrypt_decrypt($idnya, 'decrypt'); 
		$this->data['gapok'] = $this->gapok->getGapokById($id);
		
		if(enableGapok() == 'disabled'){
			redirect('insentif-gapok');
		} else{
			$this->load->view('insentif/gapok/update', $this->data);
		}
	}
	
	public function insert(){
		echo $this->gapok->insert();
	}
	
	public function alert_delete(){
		$data['id'] = $this->input->post('id');
		$this->load->view('insentif/gapok/delete', $data);
	}
	
	public function submit_delete($id){
		echo $this->gapok->delete($id);
	}
	
}