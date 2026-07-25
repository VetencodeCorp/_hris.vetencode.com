<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mkehadiran extends CI_Model{
// =================== get data ===========================
// user by id
	public function getUserById($id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		return $query->row();
	}

// daftar absen
	public function getDaftarHadir(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('deleted_by', NULL);
		$this->db->where('active', 1);
		$this->db->where('access_id >', 1); 
		$this->db->order_by('id', 'ASC'); 
		
		$query = $this->db->get();
		$return = array();
		foreach($query->result() as $data){
			$return[$data->id] = $data; 
			$return[$data->id]->check_absen = $this->_get_check_absen($data->id);
			$return[$data->id]->absen = $this->_get_absen($data->id);
			$return[$data->id]->absen_pulang = $this->_get_absen_pulang($data->id);
		}
		return $return;
	}
	
	private function _get_check_absen($user_id){
		$toDay = date('Y-m-d'); 
		$this->db->select('*');
		$this->db->from('absen_harian');
		$this->db->where('user_id', $user_id);
		$this->db->like('tanggal', $toDay);
		
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	private function _get_absen($user_id){
		$toDay = date('Y-m-d'); 
		$this->db->select('*');
		$this->db->from('absen_harian');
		$this->db->where('user_id', $user_id);
		$this->db->like('tanggal', $toDay);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	private function _get_absen_pulang($user_id){
		$toDay = date('Y-m-d'); 
		$this->db->select('*');
		$this->db->from('absen_harian');
		$this->db->where('user_id', $user_id);
		$this->db->where('masuk !=', NULL);
		$this->db->like('tanggal', $toDay);
		
		$query = $this->db->get();
		return $query->result();
	}

// list 
	public function getListAbsen(){
		$toDay = date('Y-m-d');
		$this->db->select('absen.*, user.fullname, user.access_id');
		$this->db->from('absen_harian absen'); 
		$this->db->join('user', 'user.id = absen.user_id', 'LEFT');
		$this->db->like('absen.tanggal', $toDay);
		$this->db->order_by('absen.id', 'ASC');
		
		$query = $this->db->get();
		return $query->result();
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

// ======================= insert =======================
	public function insert_keterangan($user_id, $flag){
		$data = array(
			'user_id' => $user_id, 
			'status' => 1, 
			'flag' => $flag
		);
		$this->db->insert('absen_harian', $data);
		return TRUE;
	}
	
// ======================= update ========================
	public function alert_action($id, $method, $note){
		if($method == 'Rejected'){
			$data['status'] = 0; 
			$data['note'] = $note;
		}
		if($method == 'Approved'){
			$data['status'] = 2; 
			$data['note'] = NULL;
		}
		
		$this->db->where('id', $id);
		$this->db->update('absen_harian', $data);
		return TRUE;
	}
	
	public function update_flag($id, $flag){
		if($flag == 'hadir'){
			$this->db->where('id', $id);
			$this->db->delete('absen_harian');
		} else{
			if($flag == ''){
				$data['flag'] = NULL;
			} else{
				$data['flag'] = $flag;
			}
			$this->db->where('id', $id);
			
			$this->db->update('absen_harian', $data);
		}
		return TRUE;
	}

	


}