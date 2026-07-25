<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Profile extends RestController {
	public $user_id;

	function __construct()
    {
        parent::__construct();

        protectByKey('4p1keyF0rHR1S');

	    $this->load->library('jwtauth');
	    $this->jwtauth->validate_token();

	    // User id didapat dari hasil validasi token
		$this->user_id = $this->session->userdata('user_id');

        $this->load->model('dashboard/mdashboard','dash');

    }

	public function index_post()
	{
		$uid = $this->user_id;
		$fullname = getRequest('fullname');
		$phone = getRequest('phone');
		$password = getRequest('password');

		// Phone Validation
		$phoneExist = $this->db->where('phone', $phone)
		    ->where('active', 1)
		    ->where('id !=', $uid)
		    ->get('user')
		    ->num_rows() > 0;		

		if ($phoneExist) {
			responseJSON([
				'success' => false,
				'message' => 'Nomor ponsel telah digunakan',
			], 400);
		}

		$data = [
			'fullname' => $fullname, 
			'seoname' => getSeoName($fullname), 
			'phone' => $phone, 
		];
		if ($password) {
			$data['password'] = md5($password);
		}
		$this->db->where('id', $uid);
		$this->db->update('user', $data);
		$affectedRow = $this->db->affected_rows();

		if ($affectedRow) {
			responseJSON([
				'success' => true,
				'message' => 'Profile berhasil diubah',
			]);
		} else {
			responseJSON([
				'success' => false,
				'message' => 'Terjadi kesalahan',
			], 500);
		}
	}

	public function insentive_get()
	{
		$uid = $this->user_id;
		$weeklyInsentive = $this->dash->getInsentifMingguanByUserId($uid);
		$monthlyInsentive = $this->dash->getInsentifBulananByUserId($uid);

		responseJSON([
			'success' => true,
			'data' => [
				'weekly' => intval($weeklyInsentive),
				'monthly' => intval($monthlyInsentive),
			],
		]);
	}

}