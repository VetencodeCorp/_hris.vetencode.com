<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mmingguan extends CI_Model{
// =================== get data ===========================
// list
	public function getListData(){
		$this->db->select('*');
		$this->db->from('insentif_mingguan'); 
		$this->db->where('deleted_by', NULL);
		$this->db->order_by('id', 'DESC');
		
		$query = $this->db->get();
		return $query->result();
	}

// data by id
	public function getDataRowById($id){
		$this->db->select('*');
		$this->db->from('insentif_mingguan'); 
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		return $query->row();
	}

// =================== insert =============================
	public function insert(){
		$data = array(
			'jumlah' => $this->input->post('jumlah'), 
			'created_by' => $this->session->userdata('id')
		);
		$this->db->insert('insentif_mingguan', $data);
		return TRUE;
	}
	
	public function update_alert($id, $method){
		if($method == 'Inactive'){
			$data['is_active'] = 0; 
			$data['updated_by'] = $this->session->userdata('id');
		}
		if($method == 'Active'){
			$data['is_active'] = 1; 
			$data['updated_by'] = $this->session->userdata('id');
		}
		if($method == 'Delete'){
			$data['is_active'] = 0; 
			$data['deleted_by'] = $this->session->userdata('id');
		}
		if($method == 'Edit'){
			$data['jumlah'] = $this->input->post('jumlah'); 
			$data['updated_by'] = $this->session->userdata('id');
		}
		
		$this->db->where('id', $id);
		$this->db->update('insentif_mingguan', $data);
		return TRUE;
	}


}