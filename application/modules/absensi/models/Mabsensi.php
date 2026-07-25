<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mabsensi extends CI_Model{
	function __construct() {
        parent::__construct(); 
		
		date_default_timezone_set('Asia/Jakarta');
    }
// =================== get data ===========================
// check note
	public function getCheckNote($user_id){
		$toDay = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('absen_harian');
		$this->db->where('user_id', $user_id);
		$this->db->like('tanggal', $toDay);
		
		$query = $this->db->get();
		return $query->row();
	}

// chek absen
	public function checkAbsen($user_id){
		$toDay = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('absen_harian');
		$this->db->where('user_id', $user_id);
		$this->db->like('tanggal', $toDay);
		
		$query = $this->db->get();
		return $query->num_rows();
	}

// ==================== insert ============================
	public function insert($filename, $user_id){
		$user = $this->db->get_where('user', [
			'id' => $user_id,
		])->row();
		if (!$user) return false;

// 		$status = 1;
// 		if ($user->access_id == 5) {
// 			$status = 2;
// 		}

		$data = array(
			'foto' => 'assets/images/absen/'.$filename, 
			'user_id' => $user_id, 
			'masuk' => date('H:i:s'),
			'status' => 2,
		);
		$this->db->insert('absen_harian', $data);
		return TRUE;
	}

// =================== update ===============================
	public function update($filename, $user_id){
		$toDay = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('absen_harian');
		$this->db->where('user_id', $user_id);
		$this->db->like('tanggal', $toDay);
		
		$query = $this->db->get()->row();
		$status = $query->status;
		$id = $query->id;
		
		if($status == 0){
			$data = array(
				'foto' => 'assets/images/absen/'.$filename, 
				'masuk' => date('H:i:s'),
				'status' => 1, 
				'note' => NULL
			);
		}
		if($status == 2){
			$data = array(
				'foto_pulang' => 'assets/images/absen/'.$filename, 
				'pulang' => date('H:i:s'), 
				'flag' => 'hadir', 
				'note' => NULL
			);
		}
		$this->db->where('id', $id);
		$this->db->update('absen_harian', $data);
	}

}