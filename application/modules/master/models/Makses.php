<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Makses extends CI_Model{
// =================== get data ===========================
// list
	public function getListAkses($access){
		$this->db->select('*');
		$this->db->from('access');
		$this->db->where('deleted_by', NULL);
		if($access > 1){
			$this->db->where_not_in('id', 1);
		} 
		$this->db->order_by('id', 'DESC');
		
		$query = $this->db->get();
		return $query->result();
	}

// data by id
	public function getAksesById($id){
		$this->db->select('*');
		$this->db->from('access');
		$this->db->where('id', $id); 
		
		$query = $this->db->get();
		return $query->row();
	}


// =========================== insert =======================
	public function insert(){
		$data = array(
			'name' => $this->input->post('name'), 
			'created_by' => $this->session->userdata('id')
		);
		$this->db->insert('access', $data);
		return TRUE;
	}

// ========================== update =============================
	public function update($id){
		$data = array(
			'name' => $this->input->post('name'), 
			'updated_by' => $this->session->userdata('id')
		);
		$this->db->where('id', $id);
		$this->db->update('access', $data);
		return TRUE;
	}
	
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
		$this->db->update('access', $data);
		return TRUE;
	}

}