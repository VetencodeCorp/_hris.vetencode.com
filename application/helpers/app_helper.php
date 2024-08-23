<?php defined('BASEPATH') or exit('No direct script access allowed.');

// is login
function is_login()
{
	$ci = &get_instance();
	$ci->load->database();

	$is_login = $ci->session->userdata('is_login');
	$user_id = $ci->session->userdata('id');

	if ($is_login !== TRUE) {
		redirect(base_url());
	}
}

// is absen
function is_absen()
{
	$ci = &get_instance();
	$ci->load->database();

	$ci = &get_instance();
	$ci->load->database();

	$user_id = $ci->session->userdata('id');
	$toDay = date('Y-m-d');
	$ci->db->select('*');
	$ci->db->from('absen_harian');
	$ci->db->where('user_id', $user_id);
	$ci->db->where('status >', 0);
	$ci->db->like('tanggal', $toDay);

	$query = $ci->db->get();
	if ($query->num_rows() == 0) {
		redirect('absensi');
	}
}

// get user
function getUser()
{
	$ci = &get_instance();
	$ci->load->database();

	$id = $ci->session->userdata('id');

	$ci->db->select('*');
	$ci->db->from('user');
	$ci->db->where('id', $id);

	$query = $ci->db->get()->row();
	return $query;
}

// access
function is_access()
{
	$ci = &get_instance();
	$ci->load->database();

	$id = $ci->session->userdata('id');

	$ci->db->select('*');
	$ci->db->from('user');
	$ci->db->where('id', $id);

	$query = $ci->db->get()->row();
	return $query->access_id;
}

// get access
function getAccess()
{
	$ci = &get_instance();
	$ci->load->database();

	$id = $ci->session->userdata('id');

	$ci->db->select('*');
	$ci->db->from('user');
	$ci->db->where('id', $id);

	$query = $ci->db->get()->row();
	$access_id = $query->access_id;

	$ci->db->select('*');
	$ci->db->from('access');
	$ci->db->where('id', $access_id);

	$queryAccess = $ci->db->get()->row();
	return $queryAccess->name;
}

// get seoname
function getSeoName($name)
{
	$seoname =  strtolower(preg_replace('/-+/', '-', preg_replace('/[^\wáéíóú]/', '-', $name)));
	return $seoname;
}

// encrypt and decrypt
function encrypt_decrypt($string, $action)
{
	$encrypt_method = "AES-256-CBC";
	$secret_key = 'AA74CDCC2BBRT935136HH7B63C27'; // user define private key
	$secret_iv = '5fgf5HJ5g27'; // user define secret key
	$key = hash('sha256', $secret_key);
	$iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
	if ($action == 'encrypt') {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if ($action == 'decrypt') {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}
	return $output;
}

// pern=mission
function is_permit($params)
{
	$ci = &get_instance();
	$ci->load->database();

	$id = $ci->session->userdata('id');

	$ci->db->select('*');
	$ci->db->from('user');
	$ci->db->where('id', $id);

	$query = $ci->db->get()->row();
	$access_id =  $query->access_id;

	// superadmin
	if ($params == 'akses') {
		if ($access_id > 1) {
			redirect('dashboard');
		}
	}

	// admin
	if ($params == 'akses' || $params == 'mingguan' || $params == 'user' || $params == 'insentif_mingguan' || $params == 'gapok' || $params == 'kehadiran') {
		if ($access_id > 2) {
			redirect('dashboard');
		}
	}
	// pegawai
	if ($params == 'absen' || $params == 'mingguanpegawai') {
		if ($access_id  < 2) {
			redirect('dashboard');
		}
	}
}

// check absen
function checkAbsen()
{
	$ci = &get_instance();
	$ci->load->database();

	$user_id = $ci->session->userdata('id');
	$toDay = date('Y-m-d');
	$ci->db->select('*');
	$ci->db->from('absen_harian');
	$ci->db->where('user_id', $user_id);
	$ci->db->where('status', 1);
	$ci->db->like('tanggal', $toDay);

	$query = $ci->db->get();
	return $query->num_rows();
}

// check absen reject
function checkAbsenReject()
{
	$ci = &get_instance();
	$ci->load->database();

	$user_id = $ci->session->userdata('id');
	$toDay = date('Y-m-d');
	$ci->db->select('*');
	$ci->db->from('absen_harian');
	$ci->db->where('user_id', $user_id);
	$ci->db->where('status', 0);
	$ci->db->like('tanggal', $toDay);

	$query = $ci->db->get();
	return $query->num_rows();
}

function check_absen()
{
	$ci = &get_instance();
	$ci->load->database();

	$user_id = $ci->session->userdata('id');
	$toDay = date('Y-m-d');
	$ci->db->select('*');
	$ci->db->from('absen_harian');
	$ci->db->where('user_id', $user_id);
	$ci->db->where('status', 1);
	$ci->db->like('tanggal', $toDay);

	$query = $ci->db->get();
	if ($query->num_rows() > 0) {
		redirect('dashboard');
	}
}

function check_flag()
{
	$ci = &get_instance();
	$ci->load->database();

	$user_id = $ci->session->userdata('id');
	$toDay = date('Y-m-d');
	$ci->db->select('*');
	$ci->db->from('absen_harian');
	$ci->db->where('user_id', $user_id);
	$ci->db->or_where('flag', 'sakit');
	$ci->db->or_where('flag', 'izin');
	$ci->db->or_where('flag', 'alpha');
	$ci->db->like('tanggal', $toDay);

	$query = $ci->db->get();
	return $query->num_rows();
}

// insentif mingguan
function insentif_mingguan()
{
	$ci = &get_instance();
	$ci->load->database();

	$ci->db->select('*');
	$ci->db->from('insentif_mingguan');
	$ci->db->where('is_active', 1);

	$query = $ci->db->get()->row();
	return $query->jumlah;
}

// enable mingguan
function enableMingguan()
{
	/*
		if(date('D') == 'Mon' && date('D') == 'Tue' && date('D') !== 'Wed' && date('D') !== 'Thu' && date('D') !== 'Sat'){
			return 'disabled';
		}
		 */


	$toDay = date('l', strtotime(date('Y-m-d')));
	if ($toDay !== 'Friday' && $toDay !== 'Sunday') {
		return 'disabled';
	}
}

// enable gapok
function enableGapok()
{
	$date = new DateTime('now');
	$date->modify('last day of this month');
	$lastDay =  $date->format('Y-m-d');

	if (date('Y-m-d') !== $lastDay) {
		return 'disabled';
	}
}

// Random String
function randomStr($length = 10)
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';

	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}

	return $randomString;
}

function formatDateRange($startDate, $endDate)
{
	$months = [
		1 => 'Jan',
		'Feb',
		'Mar',
		'Apr',
		'Mei',
		'Jun',
		'Jul',
		'Agu',
		'Sep',
		'Okt',
		'Nov',
		'Des'
	];

	$start = new DateTime($startDate);
	$end = new DateTime($endDate);

	if ($end < $start) {
		return 'Invalid date range';
	}

	$startDay = $start->format('j');
	$startMonth = $months[$start->format('n')];
	$startYear = $start->format('Y');

	$endDay = $end->format('j');
	$endMonth = $months[$end->format('n')];
	$endYear = $end->format('Y');

	// Case: Same month and year
	if ($startMonth === $endMonth && $startYear === $endYear) {
		if ($startDay === $endDay) {
			return "{$startDay} {$startMonth} {$startYear}";
		} else {
			return "{$startDay} - {$endDay} {$startMonth} {$startYear}";
		}
	}

	// Case: Same year, different months
	if ($startYear === $endYear) {
		return ($startDay === $endDay)
			? "{$startDay} {$startMonth} - {$endDay} {$endMonth} {$endYear}"
			: "{$startDay} {$startMonth} - {$endDay} {$endMonth} {$endYear}";
	}

	// Case: Different years
	return ($startDay === $endDay)
		? "{$startDay} {$startMonth} {$startYear} - {$endDay} {$endMonth} {$endYear}"
		: "{$startDay} {$startMonth} {$startYear} - {$endDay} {$endMonth} {$endYear}";
}
