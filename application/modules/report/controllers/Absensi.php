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
	}
	// ===================== index ====================
	public function index()
	{
		$this->data['selectUser'] = $this->absen->getSelectUser();
		$this->data['accesses'] = $this->absen->getSelectAccesses();
		// var_dump($this->data['accesses']);
		// die;

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

	public function datatable()
	{
		$from_date = $this->input->post('from_date');
		$to_date = $this->input->post('to_date');
		$conditions = [
			'absen.user_id' => $this->input->post('user_id'),
			'user.access_id' => $this->input->post('access_id'),
		];
		$start = $this->input->post('start');
		$length = $this->input->post('length');

		// Call the model method with necessary parameters
		$listData = $this->absen->getFilteredData($from_date, $to_date, $conditions, getUser(), $length, $start);

		// Prepare the data for DataTables
		$data = [];
		$number = $start + 1;
		foreach ($listData as $item) {
			$row = [];
			$row[] = $number++;
			$row[] = date('d-m-Y', strtotime($item->tanggal));
			if (is_access() < 3) {
				$row[] = $item->fullname;
			}
			$row[] = $item->masuk ? date('H:i:s', strtotime($item->masuk)) : '';
			$row[] = $item->pulang ? date('H:i:s', strtotime($item->pulang)) : '';
			$row[] = '<select style="display: block; height: unset;" class="select-flag" data-id="' . $item->id . '" data-url="' . base_url() . 'report/absensi/change_flag">
                    <option value="" disabled ' . ($item->flag == null ? "selected" : '') . '>Pilih Keterangan</option>
                    <option value="hadir" ' . ($item->flag == 'hadir' ? "selected" : '') . '>Hadir</option>
                    <option value="sakit" ' . ($item->flag == 'sakit' ? "selected" : '') . '>Sakit</option>
                    <option value="izin" ' . ($item->flag == 'izin' ? "selected" : '') . '>Izin</option>
                  </select>';
			$data[] = $row;
		}

		// Output the data in JSON format
		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->absen->count_all(), // Total records count without filtering
			"recordsFiltered" => $this->absen->count_filtered($from_date, $to_date, $conditions, getUser()), // Total records count with filtering
			"data" => $data,
		];
		echo json_encode($output);
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
		$user = ($user_id) ? $this->absen->getUserById($user_id) : null;

		$filename = 'Report Absensi';
		if ($user) {
			$filename .= " {$user->fullname}";
		}
		$dateRange = formatDateRange($from_date, $to_date);
		$filename .= " tanggal $dateRange";
		$data['title'] = $filename;

		$data['listData'] = $this->absen->getFilteredData($from_date, $to_date, $user_id, getUser()->access_id, getUser()->id, 100);
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
