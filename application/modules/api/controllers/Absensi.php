<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Absensi extends RestController {
	public $user_id;

	function __construct()
    {
        parent::__construct();

        protectByKey('4p1keyF0rHR1S');

	    $this->load->library('jwtauth');
	    $this->jwtauth->validate_token();

	    // User id didapat dari hasil validasi token
		$this->user_id = $this->session->userdata('user_id');

        $this->load->model('mabsensi','absensi');
    }

	public function index_get()
	{
		$uid = $this->user_id;

		$absensi = $this->absensi->todayFrom($uid);

		$data = null;
		if ($absensi) {
			$status = ['rejected', 'pending', 'approved'];

			$data = (object)[
				'masuk' => $absensi->masuk,
				'foto_masuk' => $absensi->foto ? base_url().$absensi->foto : null,
				'pulang' => $absensi->pulang,
				'foto_pulang' => $absensi->foto_pulang ? base_url().$absensi->foto_pulang : null,
				'status' => $status[intval($absensi->status)],
				'note' => $absensi->note,
				'flag' => $absensi->flag,
			];
		}
		responseJSON([
	    	'success' => true,
	        'message' => 'Data absen didapatkan',
	        'data' => $data,
	    ]);
	}

	public function index_post()
	{
		$uid = $this->user_id;
		$filename = randomStr(). '-' . time().'.jpg';
		$filepath = FCPATH.'assets/images/absen/'.$filename;
    	$result = move_uploaded_file($_FILES['photo']['tmp_name'], $filepath);
		
		$hasAbsen = $this->absensi->hasAbsen($uid);
		if (!$hasAbsen) {
		    $success = $this->absensi->insert($filename, $uid);
		} else {
		    $success = $this->absensi->update($filename, $uid);
		}

		$response = [
        	'success' => $success,
        	'message' => $success ? 'Absen Berhasil' : 'Terjadi kesalahan',
    	];
    	$statusCode = $success ? 200 : 500;

    	responseJSON($response, $statusCode);
	}

}