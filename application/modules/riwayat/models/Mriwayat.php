<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Mriwayat extends CI_Model
{
	public function getEmployees()
	{
		return $this->db
			->select('id, fullname, access_id')
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
			->select('id, fullname, access_id')
			->from('user')
			->where('id', (int) $id)
			->where('access_id >', 1)
			->where('active', 1)
			->where('deleted_by', null)
			->get()
			->row();
	}

	public function countHistory($employeeId, $year, $month)
	{
		$this->historyQuery($employeeId, $year, $month);
		return $this->db->count_all_results();
	}

	public function getHistory($employeeId, $year, $month, $limit, $offset)
	{
		$this->db->select('absen.id, absen.foto, absen.foto_pulang, absen.masuk, absen.pulang, absen.status, absen.flag, absen.note, absen.tanggal, user.fullname');
		$this->historyQuery($employeeId, $year, $month);
		$this->db->order_by('absen.tanggal', 'DESC');
		$this->db->limit((int) $limit, (int) $offset);

		return $this->db->get()->result();
	}

	private function historyQuery($employeeId, $year, $month)
	{
		$startDate = sprintf('%04d-%02d-01 00:00:00', $year, $month);
		$endDate = date('Y-m-d H:i:s', strtotime($startDate . ' +1 month'));

		$this->db->from('absen_harian absen');
		$this->db->join('user', 'user.id = absen.user_id', 'LEFT');
		$this->db->where('absen.user_id', (int) $employeeId);
		$this->db->where('absen.tanggal >=', $startDate);
		$this->db->where('absen.tanggal <', $endDate);
	}
}
