<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mingguan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		is_permit('report-mingguan');
		if(is_access() > 1){
			is_absen();
		}
		$this->load->model('report/mmingguan', 'mingguan');
		$this->data['title'] = 'Report Insentif Mingguan';
		$this->data['selectUser'] = $this->mingguan->getSelectUser();
	}
// ===================== index ====================
	public function index(){
		$this->load->view('report/mingguan/index', $this->data);
	} 
	
	public function search_data(){
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$user_id = $this->input->post('user_id');
		
		$data['number'] = 1;
		$data['listData'] = $this->mingguan->getSearchData($from_date, $to_date, $user_id, getUser()->access_id, getUser()->id);
		echo $this->load->view('report/mingguan/table_mingguan', $data);
	}
	
	
	
	
}