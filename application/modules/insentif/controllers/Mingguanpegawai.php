<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mingguanpegawai extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		is_permit('mingguanpegawai');
		if(is_access() > 1){
			is_absen();
		}
		
		$this->load->model('insentif/mmingguanpegawai', 'mingguan');
		$this->data['title'] = 'Insentif Mingguan'; 
		$this->data['number'] = 1; 
		
		$this->data['kelender'] = $this->mingguan->getKalenderMingguan();		
	}
// ===================== index ====================
	public function index(){
		$this->load->view('insentif/mingguan_pegawai/index', $this->data);
	} 
	
	
	
	
	
}