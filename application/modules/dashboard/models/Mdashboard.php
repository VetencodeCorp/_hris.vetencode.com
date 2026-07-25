<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdashboard extends CI_Model{
// =================== get data ===========================
// keterangan
	public function getKeteranganByUserId($user_id){
		$toDay = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('absen_harian'); 
		$this->db->where('user_id', $user_id);
		$this->db->or_where('flag', 'sakit');
		$this->db->or_where('flag', 'izin');
		$this->db->or_where('flag', 'alpha');
		$this->db->like('tanggal', $toDay);
				
		$query = $this->db->get();
		return $query->num_rows();
	}

// profile
	public function getProfile(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id', $this->session->userdata('id'));
		
		$query = $this->db->get();
		return $query->row();
	}

// absen by user id
	public function getAbsenByUserId($user_id){
		$toDay = date('Y-m-d');
		$this->db->select('absen.*, user.fullname');
		$this->db->from('absen_harian absen'); 
		$this->db->join('user', 'user.id = absen.user_id', 'LEFT'); 
		$this->db->where('absen.user_id', $user_id);
		$this->db->like('absen.tanggal', $toDay);
				
		$query = $this->db->get();
		return $query->row();
	}

// insentif mingguan by user id
	public function getInsentifMingguanByUserId($user_id){
		$toDay = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('uang_mingguan');
		$this->db->where('user_id', $user_id); 
		$this->db->where('deleted_by', NUll);
		$this->db->like('created_date', $toDay);
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$sql = $query->row();
			return $sql->jumlah;
		} else{
			return 0;
		}
	}

// insentif bulanan by user id
	public function getInsentifBulananByUserId($user_id){
		$toDay = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('gapok');
		$this->db->where('user_id', $user_id);
		$this->db->like('created_date', $toDay);
		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			$sql = $query->row();
			return $sql->jumlah;
		} else{
			return 0;
		}
	}

// ====================== update =========================
// profile
	public function update_profile($data, $id){
		$this->db->where('id', $id);
		$this->db->update('user', $data);
		return TRUE;
	}


}