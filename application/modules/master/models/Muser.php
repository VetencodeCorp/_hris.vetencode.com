<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Muser extends CI_Model{
// =================== get data ===========================
	public function getSelectAkses($access_id){
		$this->db->select('*');
		$this->db->from('access');
		$this->db->where('deleted_by', NULL);
		$this->db->where('active', 1);
		if($access_id > 1){
			$this->db->where('id >', 2);
		}
		$this->db->order_by('name', 'ASC');
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getUpdateSelectAkses($id, $access_id){
		$this->db->select('*');
		$this->db->from('access');
		$this->db->where('deleted_by', NULL);
		$this->db->where('active', 1);
		if($access_id > 1){
			$this->db->where('id >', 2);
		}
		$this->db->where_not_in('id', $id);
		$this->db->order_by('name', 'ASC');
		
		$query = $this->db->get();
		return $query->result();
	}

// check phone
	public function checkPhoneByPhone($phone, $id = NULL){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('phone', $phone);
		if($id){
			$this->db->where_not_in('id', $id);
		} 
		$query = $this->db->get();
		return $query->num_rows();
	}

// list
	public function getListUser($access_id){
		$this->db->select('user.*, access.name nama_akses');
		$this->db->from('user'); 
		$this->db->join('access', 'access.id = user.access_id', 'LEFT');
		$this->db->where('user.deleted_by', NULL);
		if($access_id > 1){
			$this->db->where_not_in('user.access_id', 1);
		}
		$this->db->order_by('user.id', 'DESC');
		
		$query = $this->db->get(); 
		return $query->result();
	}

// user by id
	public function getUserById($id){
		$this->db->select('user.*, access.name nama_akses');
		$this->db->from('user'); 
		$this->db->join('access', 'access.id = user.access_id', 'LEFT');
		$this->db->where('user.id', $id);
		
		$query = $this->db->get();
		return $query->row();
	}
	
// =========================== insert ==========================
	public function insert(){
		$data = array(
			'access_id' => $this->input->post('access_id'), 
			'phone' => $this->input->post('phone'), 
			'password' => md5($this->input->post('password')), 
			'fullname' => $this->input->post('fullname'), 
			'seoname' => getSeoName($this->input->post('fullname')), 
			'gapok' => $this->input->post('gapok'), 
			'mingguan' => $this->input->post('mingguan'), 
			'created_by' => $this->session->userdata('id')
		);
		$this->db->insert('user', $data);
		return TRUE;
	}

// =============================== update ===========================
	public function update_alert($id, $method){
		if($method == 'Inactive'){
			$data['active'] = 0; 
			$data['updated_by'] = $this->session->userdata('id');
		}
		if($method == 'Active'){
			$data['active'] = 1; 
			$data['updated_by'] = $this->session->userdata('id');
		}
		if($method == 'Delete'){
			$data['active'] = 0; 
			$data['deleted_by'] = $this->session->userdata('id');
		}
		$this->db->where('id', $id);
		$this->db->update('user', $data);
		return TRUE;
	}
	
	public function update($id){
		$data = array(
			'access_id' => $this->input->post('access_id'), 
			'phone' => $this->input->post('phone'), 
			'fullname' => $this->input->post('fullname'), 
			'seoname' => getSeoName($this->input->post('fullname')), 
			'gapok' => $this->input->post('gapok'), 
			'mingguan' => $this->input->post('mingguan'), 
			'created_by' => $this->session->userdata('id')
		);
		if($this->input->post('password')){
			$data['password'] = md5($this->input->post('password')); 
		}
		$this->db->where('id', $id);
		$this->db->update('user', $data);
		return TRUE;
	}

}