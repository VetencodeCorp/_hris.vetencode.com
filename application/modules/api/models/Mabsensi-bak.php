<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Mabsensi extends CI_Model {
	public function todayFrom($user_id)
	{
		$today = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('absen_harian');
		$this->db->where('user_id', $user_id);
		$this->db->like('tanggal', $today);
		$absensi = $this->db->get();

		return $absensi->row();
	}

	// Sudah absen ? true : false
	public function hasAbsen($user_id){
		$todayAbsen = $this->todayFrom($user_id);
		return $todayAbsen != null;
	}

	public function insert($filename, $user_id){
		$data = array(
			'foto' => 'assets/images/absen/'.$filename, 
			'user_id' => $user_id, 
			'masuk' => date('H:i:s')
		);
		$this->db->insert('absen_harian', $data);
		return $this->db->affected_rows() > 0;
	}

	public function update($filename, $user_id){
		$today = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('absen_harian');
		$this->db->where('user_id', $user_id);
		$this->db->like('tanggal', $today);
		
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
		return $this->db->affected_rows() > 0;
	}

}