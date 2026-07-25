<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mlogin extends CI_Model {
	function __construct() {
		
	}

// ======================================== get data ==============================
// user
	public function getUser($data) {
		$query = $this->db->get_where('user', $data);
		return $query;
	}
	
	
	
}