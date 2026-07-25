<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kehadiran extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		is_permit('kehadiran');
		if(is_access() > 1){
			is_absen();
		}
		$this->load->model('kehadiran/mkehadiran', 'hadir');
		$this->data['title'] = 'Absensi';
		$this->data['number'] = 1;
		
		$this->data['daftarAbsen'] = $this->hadir->getDaftarHadir();
		$this->data['listAbsen'] = $this->hadir->getListAbsen();
		$this->data['absen'] = $this->hadir->getAbsenByUserId(getUser()->id);
	}
// ===================== index ====================
	public function index(){
		$this->load->view('kehadiran/index', $this->data);
	}
	
	public function alert_action(){
		$data = array(
			'id' => $this->input->post('id'), 
			'method' => $this->input->post('method'), 
		);
		$this->load->view('kehadiran/alert', $data);
	}
	
	public function alert_keterangan($id){
		$data = array(
			'id' => $id, 
			'method' => $this->input->post('method'), 
		);
		$this->load->view('kehadiran/keterangan', $data);
	}
		
	public function submit_alert(){
		$id = $this->input->post('id'); 
		$method = $this->input->post('method'); 
		$note = $this->input->post('note');
		echo $this->hadir->alert_action($id, $method, $note);
	}
	
	public function alert_flag($user_id){
		$flag = $this->input->post('flag');
		echo $this->hadir->insert_keterangan($user_id, $flag);
	}
	
	public function update_flag($id, $user_id, $flag){
		$data = array(
			'id' => $id,
			'flag' => $flag, 
			'user' => $this->hadir->getUserById($user_id)
		);
		$this->load->view('kehadiran/absen', $data);
	}
	
	public function submit_edit_flag(){
		$id = $this->input->post('id'); 
		$flag = $this->input->post('flag');
		echo $this->hadir->update_flag($id, $flag);
	}
	
}









