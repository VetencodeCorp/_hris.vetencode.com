<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Mabsensi_manual extends CI_Model
{
	public function getEmployees()
	{
		return $this->db
			->select('id, fullname')
			->from('user')
			->where('access_id >', 1)
			->where('active', 1)
			->where('deleted_by', null)
			->order_by('fullname', 'ASC')
			->get()
			->result();
	}

	public function getEmployee($id)
	{
		return $this->db
			->select('id, fullname')
			->from('user')
			->where('id', (int) $id)
			->where('access_id >', 1)
			->where('active', 1)
			->where('deleted_by', null)
			->get()
			->row();
	}

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

	public function getRecentManualRecords($limit)
	{
		return $this->db
			->select('absen.id, absen.masuk, absen.pulang, absen.tanggal, user.fullname')
			->from('absen_harian absen')
			->join('user', 'user.id = absen.user_id', 'LEFT')
			->like('absen.note', 'Input manual oleh', 'after')
			->order_by('absen.id', 'DESC')
			->limit((int) $limit)
			->get()
			->result();
	}

	public function getManualRecord($id)
	{
		return $this->db
			->select('absen.id, absen.foto, absen.foto_pulang, absen.tanggal, user.fullname')
			->from('absen_harian absen')
			->join('user', 'user.id = absen.user_id', 'LEFT')
			->where('absen.id', (int) $id)
			->like('absen.note', 'Input manual oleh', 'after')
			->get()
			->row();
	}

	public function deleteManualRecord($id)
	{
		return $this->db
			->where('id', (int) $id)
			->like('note', 'Input manual oleh', 'after')
			->delete('absen_harian');
	}
}
