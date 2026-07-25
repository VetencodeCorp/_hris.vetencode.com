<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mapi extends CI_Model {
	public function isValid($data_auth){
		$vu = $this->db->get_where('api_credentials', $data_auth);
		return $vu->num_rows() > 0;
	}

	public function get_user($data_user) {
		$this->db->select('user.id, user.fullname, user.phone, user.access_id, access.name as position');
		$this->db->from('user');
		$this->db->join('access', 'user.access_id = access.id');
		foreach ($data_user as $key => $value) {
			$this->db->where("user.$key", $value);
		}
		// $query = $this->db->get_where('user', $data_user);
		$query = $this->db->get();
		return $query;
	}
}