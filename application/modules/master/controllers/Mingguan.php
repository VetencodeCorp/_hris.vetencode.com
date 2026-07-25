<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mingguan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login(); 
		is_permit('mingguan');
		if(is_access() > 1){
			is_absen();
		}
		$this->load->model('master/mmingguan', 'mingguan');
		$this->data['title'] = 'Data Mingguan';
		$this->data['number'] = 1;
		$this->data['listData'] = $this->mingguan->getListData();
	}
// ===================== index ====================
	public function index(){
		$this->load->view('master/mingguan/index', $this->data);
	} 

// ===================== insert ====================
	public function add(){
		echo $this->mingguan->insert();
	}
	
// ===================== update =====================
	public function alert_action(){
		$data = array(
			'id' => $this->input->post('id'),
			'method' => $this->input->post('method'), 
			'dataRow' => $this->mingguan->getDataRowById($this->input->post('id'))
		);
		echo $this->load->view('master/mingguan/alert', $data);
	}
	
	public function submit_alert(){
		$id = $this->input->post('id');
		$method = $this->input->post('method');
		echo $this->mingguan->update_alert($id, $method);
	}


}