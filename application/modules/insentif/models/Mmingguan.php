<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mmingguan extends CI_Model{
	function __construct() {
        parent::__construct(); 
		
		date_default_timezone_set('Asia/Jakarta');
    }
// =================== get data ===========================
// list
	public function getListInsentif(){
		$toDay = date('Y-m-d'); 
		$this->db->select('uang.*, user.fullname'); 
		$this->db->from('uang_mingguan uang'); 
		$this->db->join('user', 'user.id = uang.user_id', 'LEFT');
		$this->db->where('uang.deleted_by', NULL);
		$this->db->like('uang.created_date', $toDay);
		$this->db->order_by('uang.id', 'DESC');
		
		$query = $this->db->get();
		return $query->result();
	}

// user by id
	public function getUserById($id){
		$this->db->select('*'); 
		$this->db->from('user'); 
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		return $query->row();
	}
	
// select user
	public function getSelectUser(){
		$toDay = date('l', strtotime(date('Y-m-d')));
		 
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('deleted_by', NULL); 
		//$this->db->where('flag !=', NULL);
		$this->db->where('active', 1);
		$this->db->where('access_id >', 1);
		if($toDay == 'Friday'){
			$this->db->where('flag =', 'Friday');
		}
		if($toDay == 'Sunday'){
			$this->db->where('flag =', 'Sunday');
		}
		$this->db->order_by('fullname', 'ASC');
		
		$query = $this->db->get();
		return $query->result();
	}

// update select user
	public function getUpdateSelectPegawai($id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('deleted_by', NULL);
		$this->db->where('active', 1);
		$this->db->where('access_id >', 1);
		$this->db->where_not_in('id', $id);
		$this->db->order_by('fullname', 'ASC');
		
		$query = $this->db->get();
		return $query->result();
	}

// kehadiran by user id
	public function getKehadiranByUserId($user_id){
		$dateStart = date('Y-m-d', strtotime('-7 days'));
		$toDay = date('Y-m-d');
		
		$this->db->select('*'); 
		$this->db->from('absen_harian'); 
		$this->db->where('user_id', $user_id);
		$this->db->where('flag', 'hadir');
		$this->db->where('DATE(tanggal) BETWEEN "'.$dateStart.'" AND "'.$toDay.'"', '',false);
		
		$query = $this->db->get();
		return $query->num_rows();
	}

// data row by id
	public function getDataRowById($id){
		$this->db->select('uang.*, user.fullname'); 
		$this->db->from('uang_mingguan uang'); 
		$this->db->join('user', 'user.id = uang.user_id', 'LEFT');
		$this->db->where('uang.id', $id);
		
		$query = $this->db->get();
		return $query->row();
	}

// ============================ insert =========================
	public function insert(){
		$data = array(
			'user_id' => $this->input->post('user_id'), 
			'insentif' => $this->input->post('insentif'), 
			'kehadiran' => $this->input->post('hadir'), 
			'jumlah' => $this->input->post('jumlah'), 
			'created_by' => $this->session->userdata('id')
		);
		$this->db->insert('uang_mingguan', $data);
		return TRUE;
	}

// =============================== delete ==========================
	public function delete($id){
		$data['deleted_by'] = $this->session->userdata('id');
		$this->db->where('id', $id);
		$this->db->update('uang_mingguan', $data);
		return TRUE;
	}

}