<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Absensi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		is_login();
		is_permit('report-absen');
		if (is_access() > 1) {
			is_absen();
		}
		$this->load->model('report/mabsensi', 'absen');
		$this->data['title'] = 'Report Absensi';
		$this->data['selectUser'] = $this->absen->getSelectUser();
	}
	// ===================== index ====================
	public function index()
	{
		$this->load->view('report/absensi/index', $this->data);
	}

	public function search_data()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$user_id = $this->input->post('user_id');

		$data['number'] = 1;
		$data['listData'] = $this->absen->getSearchData($from_date, $to_date, $user_id, getUser()->access_id, getUser()->id);
		echo $this->load->view('report/absensi/table_absen', $data);
	}

	public function change_flag()
	{
		$flag = $this->input->post('flag');
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->update('absen_harian', ['flag' => $flag]);

		echo json_encode([
			'success' => true,
			'message' => 'Data absen berhasil diubah',
		]);
	}

	public function download_pdf()
	{
		$from_date = $this->input->get('from_date');
		$to_date = $this->input->get('to_date');
		$user_id = $this->input->get('user_id');

		if (!$from_date) {
			$from_date = date('Y-m-1');
		}
		if (!$to_date) {
			$to_date = date('Y-m-d');
		}
		if ($user_id) {
			$user = $this->absen->getUserById($user_id);
		}

		$filename = 'Report Absensi';
		if ($user) {
			$filename .= " {$user->fullname}";
		}
		$dateRange = formatDateRange($from_date, $to_date);
		$filename .= " tanggal $dateRange";
		$data['title'] = $filename;

		$data['listData'] = $this->absen->getSearchData($from_date, $to_date, $user_id, getUser()->access_id, getUser()->id);
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => 'A4',
			'orientation' => 'P',
			'margin_left' => 10,
			'margin_right' => 10,
			'margin_top' => 10,
			'margin_bottom' => 10,
			'margin_header' => 5,
			'margin_footer' => 5,
		]);

		// Your HTML content
		$html = $this->load->view('report/absensi/pdf', $data, true);

		// Write HTML content to the PDF
		$mpdf->WriteHTML($html);

		// Output the PDF to the browser (no physical file created on the server)
		$mpdf->Output("$filename.pdf", 'I');
	}
}
