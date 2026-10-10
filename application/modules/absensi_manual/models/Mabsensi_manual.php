<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Mabsensi_manual extends CI_Model
{
	public function existsForDate($userId, $date)
	{
		return $this->db
			->from('absen_harian')
			->where('user_id', (int) $userId)
			->where('tanggal >=', $date . ' 00:00:00')
			->where('tanggal <', date('Y-m-d H:i:s', strtotime($date . ' +1 day')))
			->count_all_results() > 0;
	}

	public function insert($data)
	{
		return $this->db->insert('absen_harian', $data);
	}

	public function getRecentManualRecords($userId, $limit)
	{
		return $this->db
			->select('id, masuk, pulang, tanggal, note')
			->from('absen_harian')
			->where('user_id', (int) $userId)
			->like('note', 'Input manual oleh', 'after')
			->order_by('tanggal', 'DESC')
			->limit((int) $limit)
			->get()
			->result();
	}
}
