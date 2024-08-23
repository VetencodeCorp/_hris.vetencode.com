<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mingguan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		is_permit('insentif_mingguan');
		if(is_access() > 1){
			is_absen();
		}
		
		$this->load->model('insentif/mmingguan', 'mingguan');
		$this->data['title'] = 'Insentif Mingguan'; 
		$this->data['number'] = 1; 
		$this->data['selectUser'] = $this->mingguan->getSelectUser(); 
		$this->data['listInsentif'] = $this->mingguan->getListInsentif();
	}
// ===================== index ====================
	public function index(){
		$this->load->view('insentif/mingguan/index', $this->data);
	} 
	
	public function add(){
		//if(enableMingguan() == 'disabled'){
			//redirect('insentif-mingguan');
		//} else{
			//$this->load->view('insentif/mingguan/add', $this->data);
		//}
		$this->load->view('insentif/mingguan/add', $this->data);
	}
	
	public function update($idnya){
		$id = encrypt_decrypt($idnya, 'decrypt');
		$this->data['dataRow'] = $this->mingguan->getDataRowById($id);
		$this->data['updateSelectPegawai'] = $this->mingguan->getUpdateSelectPegawai($this->data['dataRow']->user_id);
		
		if(enableMingguan() == 'disabled'){
			redirect('insentif-mingguan');
		} else{
			$this->load->view('insentif/mingguan/update', $this->data);
		}
	}
	
	public function delete(){
		$data['id'] = $this->input->post('id');
		$this->load->view('insentif/mingguan/delete', $data);
	}
	
	public function get_data_user(){
		$user_id = $this->input->post('user_id');
		$user = $this->mingguan->getUserById($user_id); 
		$kehadiran = $this->mingguan->getKehadiranByUserId($user_id);
		$dataArray = array(
			'access_id' => $user->access_id,
			'hadir' => $kehadiran, 
			'input_mingguan' => number_format($user->mingguan),
			'mingguan' => $user->mingguan
		);
		echo json_encode($dataArray);
	}

// ======================== insert =========================
	public function insert(){
		echo $this->mingguan->insert();
	}

// ======================== delete =========================
	public function submit_delete($id){
		echo $this->mingguan->delete($id);
	}
	
}