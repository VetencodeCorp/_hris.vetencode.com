<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mcron extends CI_Model
{
    public function get_attendances_at(string $targetDate): array
    {
        $this->db->select('foto, foto_pulang, tanggal');
        $this->db->from('absen_harian');
        $this->db->where('DATE(tanggal)', $targetDate);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_attendances_with_user($date)
    {
        $this->db->select('absen.foto, absen.foto_pulang, absen.tanggal, user.fullname');
        $this->db->from('absen_harian absen');
        $this->db->join('user', 'absen.user_id = user.id');
        $this->db->where('DATE(absen.tanggal)', $date);
        return $this->db->get()->result();
    }
}
