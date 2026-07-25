<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mgapok extends CI_Model{
// =================== get data ===========================
// select user
	public function getSelectUser(){
		$this->db->select('*');
		$this->db->from('user'); 
		$this->db->where('access_id >', 1);
		$this->db->where('deleted_by', NULL);
		$this->db->order_by('fullname', 'ASC');
		
		$query = $this->db->get();
		return $query->result();
	}

// search data
	public function getSearchData($start_date, $end_date, $user_id, $access_id, $userAkses){
		$toDay = date('Y-m-d');
		$min_date = '0000-00-00';
		
		$this->db->select('gapok.*, user.fullname');
		$this->db->from('gapok'); 
		$this->db->join('user', 'user.id = gapok.user_id', 'LEFT');
		$this->db->where('gapok.deleted_by', NULL);
		if($access_id > 2){
			$this->db->where('gapok.user_id', $userAkses);
		}

		if($start_date && $end_date == NULL){
			$this->db->where('DATE(gapok.created_date) BETWEEN "'.$min_date.'" AND "'.$toDay.'"', '',false);
		}
		if($start_date != NULL && $end_date == NULL){
			$this->db->where('DATE(gapok.created_date) BETWEEN "'.$start_date.'" AND "'.$toDay.'"', '',false);
		}
		if($start_date == NULL && $end_date != NULL){
			$this->db->where('DATE(gapok.created_date) BETWEEN "'.$min_date.'" AND "'.$end_date.'"', '',false);
		}
		if($start_date && $end_date != NULL){
			$this->db->where('DATE(gapok.created_date) BETWEEN "'.$start_date.'" AND "'.$end_date.'"', '',false);
		}		
		if($user_id){
			$this->db->where('gapok.user_id', $user_id);
		}
		$this->db->order_by('gapok.id', 'DESC');
		
		$query = $this->db->get();
		return $query->result();
	}

}