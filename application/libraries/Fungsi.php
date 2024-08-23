<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Fungsi {
	private $CI;

   	function __construct() {
       $this->ci =& get_instance();
       $this->ci->load->database(); 
   	}

// tgl indonesia
	function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
	
// bulan indonesia
	function bulan_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

// get bulan ke
	function bulan_ke(){
		$bulan = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
		return $bulan;
	}

// get current bulan
	function getBulan(){
		$month = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		return $month[date('n')];
	}

// get list bulan
	function getListBulan(){
		$month = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		return $month;
	}

// get update bulan
	function getUpdateBulan($currMonth){
		if($currMonth == 'Januari'){
			$month = array('Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		}
		if($currMonth == 'Februari'){
			$month = array('Januari', 'Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		}
		if($currMonth == 'Maret'){
			$month = array('Januari', 'Februari','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		}
		if($currMonth == 'April'){
			$month = array('Januari', 'Februari','Maret','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		}
		if($currMonth == 'Mei'){
			$month = array('Januari', 'Februari','Maret','April','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		}
		if($currMonth == 'Juni'){
			$month = array('Januari', 'Februari','Maret','April','Mei','Juli','Agustus','September','Oktober','Nopember','Desember');
		}
		if($currMonth == 'Juli'){
			$month = array('Januari', 'Februari','Maret','April','Mei','Juni','Agustus','September','Oktober','Nopember','Desember');
		}
		if($currMonth == 'Agustus'){
			$month = array('Januari', 'Februari','Maret','April','Mei','Juni','Juli','September','Oktober','Nopember','Desember');
		}
		if($currMonth == 'September'){
			$month = array('Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','Oktober','Nopember','Desember');
		}
		if($currMonth == 'Oktober'){
			$month = array('Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Nopember','Desember');
		}
		if($currMonth == 'Nopember'){
			$month = array('Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Desember');
		}
		if($currMonth == 'Desember'){
			$month = array('Januari', 'Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember');
		}
		
		return $month;
	}

// check data this month
	public function checkDataThisMonth($id){
		$month = date('Y-m');
		$this->ci->db->select('*');
		$this->ci->db->from('setoran'); 
		$this->ci->db->where('id', $id);
		$this->ci->db->where('approved_by !=', NULL);
		$this->ci->db->like('created_date', $month);
		
		$query = $this->ci->db->get();
		return $query->num_rows();
	}

}