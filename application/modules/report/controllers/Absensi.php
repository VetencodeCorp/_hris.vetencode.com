<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Absensi extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		is_permit('report-absen');
		if(is_access() > 1){
			is_absen();
		}
		$this->load->model('report/mabsensi', 'absen');
		$this->data['title'] = 'Report Absensi';
		$this->data['selectUser'] = $this->absen->getSelectUser();
	}
// ===================== index ====================
	public function index(){
		$this->load->view('report/absensi/index', $this->data);
	} 
	
	public function search_data(){
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$user_id = $this->input->post('user_id');
		
		$data['number'] = 1;
		$data['listData'] = $this->absen->getSearchData($from_date, $to_date, $user_id, getUser()->access_id, getUser()->id);
		echo $this->load->view('report/absensi/table_absen', $data);
	}
	
	public function change_flag()
	{
		$flag = $this->input->post('flag');
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->update('absen_harian', ['flag' => $flag]);

		echo json_encode([
			'success' => true, 'message' => 'Data absen berhasil diubah',
		]);
	}
	
	
}