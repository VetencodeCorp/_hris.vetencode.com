<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mgapok extends CI_Model{
	function __construct() {
        parent::__construct(); 
		
		date_default_timezone_set('Asia/Jakarta');
    }
// =================== get data ===========================
// select user
	public function getSelectUser(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('deleted_by', NULL);
		$this->db->where('active', 1);
		$this->db->where('access_id >', 1);
		$this->db->order_by('fullname', 'ASC');
		
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

// list
	public function getListGapok(){
		$toDay = date('Y-m-d');
		$this->db->select('gapok.*, user.fullname');
		$this->db->from('gapok'); 
		$this->db->join('user', 'user.id = gapok.user_id', 'LEFT');
		$this->db->where('gapok.deleted_by', NULL);
		$this->db->like('gapok.created_date', $toDay);
		$this->db->order_by('gapok.id', 'DESC');
		
		$query = $this->db->get();
		return $query->result();
	}
	
// gapok by id
	public function getGapokById($id){
		$this->db->select('gapok.*, user.fullname');
		$this->db->from('gapok'); 
		$this->db->join('user', 'user.id = gapok.user_id', 'LEFT');
		$this->db->where('gapok.id', $id);
		
		$query = $this->db->get();
		return $query->row();
	}


// ========================== insert ==========================
	public function insert(){
		$data = array(
			'user_id' => $this->input->post('user_id'), 
			'jumlah' => $this->input->post('gapok'), 
			'created_by' => $this->session->userdata('id')
		);
		$this->db->insert('gapok', $data);
		return TRUE;
	}

// ============================ delete ============================
	public function delete($id){
		$data['deleted_by'] = $this->session->userdata('id');
		$this->db->where('id', $id);
		$this->db->update('gapok', $data);
		return TRUE;
	}


}