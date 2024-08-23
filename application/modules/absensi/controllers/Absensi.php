<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Absensi extends CI_Controller {
	public function __construct() {
		parent::__construct();
		
		is_login();
		is_permit('absen');
		check_absen();
		
		$this->load->model('absensi/mabsensi', 'absen');
		$this->data['title'] = 'Absensi'; 
		$this->data['checkNote'] = $this->absen->getCheckNote(getUser()->id);
	}
// ===================== index ====================
	public function index(){
		$this->load->view('absensi/index', $this->data);
	} 
	
	public function insert(){
		$filename = randomStr(). '-' . time().'.jpg';
		$filepath = FCPATH.'assets/images/absen/'.$filename;
    	$result = move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath); 
		
		$checkAbsen = $this->absen->checkAbsen(getUser()->id);
		if($checkAbsen == 0){
			$this->absen->insert($filename, getUser()->id);
		} elseif($checkAbsen > 0){
			$this->absen->update($filename, getUser()->id);
		}
		
	}
	
	
	
}