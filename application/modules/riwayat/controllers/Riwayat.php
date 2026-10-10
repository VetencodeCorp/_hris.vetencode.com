<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
	private $perPage = 10;

	public function __construct()
	{
		parent::__construct();

		is_login();
		$this->load->model('riwayat/mriwayat', 'riwayat');
	}

	public function index()
	{
		$user = getUser();
		$accessId = (int) $user->access_id;

		// This page is intentionally limited to superadmin and employees.
		if ($accessId === 2) {
			redirect('dashboard');
		}

		$isSuperadmin = $accessId === 1;
		$month = (int) $this->input->get('month', true);
		$year = (int) $this->input->get('year', true);
		$employeeId = $isSuperadmin
			? (int) $this->input->get('employee', true)
			: (int) $user->id;

		if (! $isSuperadmin) {
			$month = $month >= 1 && $month <= 12 ? $month : (int) date('n');
			$year = $this->validYear($year) ? $year : (int) date('Y');
		}

		$filterApplied = $employeeId > 0
			&& $month >= 1 && $month <= 12
			&& $this->validYear($year);

		$selectedEmployee = null;
		if ($filterApplied) {
			$selectedEmployee = $this->riwayat->getEmployee($employeeId);
			if (! $selectedEmployee || (! $isSuperadmin && (int) $selectedEmployee->id !== (int) $user->id)) {
				$filterApplied = false;
			}
		}

		$this->data['title'] = $isSuperadmin ? 'Riwayat Absensi' : 'Riwayat Saya';
		$this->data['isSuperadmin'] = $isSuperadmin;
		$this->data['employees'] = $isSuperadmin ? $this->riwayat->getEmployees() : array();
		$this->data['selectedEmployee'] = $selectedEmployee;
		$this->data['selectedEmployeeId'] = $employeeId;
		$this->data['selectedMonth'] = $month;
		$this->data['selectedYear'] = $year;
		$this->data['filterApplied'] = $filterApplied;
		$this->data['history'] = array();
		$this->data['pagination'] = '';
		$this->data['totalRows'] = 0;

		if ($filterApplied) {
			$offset = max(0, (int) $this->input->get('page', true));
			$totalRows = $this->riwayat->countHistory($employeeId, $year, $month);

			$this->data['history'] = $this->riwayat->getHistory(
				$employeeId,
				$year,
				$month,
				$this->perPage,
				$offset
			);
			$this->data['totalRows'] = $totalRows;
			$this->data['pagination'] = $this->pagination($totalRows);
		}

		$this->load->view('riwayat/index', $this->data);
	}

	private function validYear($year)
	{
		return $year >= 2000 && $year <= ((int) date('Y') + 1);
	}

	private function pagination($totalRows)
	{
		$this->load->library('pagination');
		// CI 3.1.9 passes null to ctype_digit() on PHP 8.1+ when page is absent.
		if ($this->input->get('page') === null) {
			$_GET['page'] = '0';
		}

		$config = array(
			'base_url' => base_url('riwayat-absensi'),
			'total_rows' => $totalRows,
			'per_page' => $this->perPage,
			'page_query_string' => true,
			'query_string_segment' => 'page',
			'reuse_query_string' => true,
			'num_links' => 2,
			'full_tag_open' => '<nav class="history-pagination" aria-label="Navigasi halaman"><ul>',
			'full_tag_close' => '</ul></nav>',
			'first_link' => false,
			'last_link' => false,
			'prev_link' => '<i class="fa fa-chevron-left" aria-hidden="true"></i><span class="sr-only">Sebelumnya</span>',
			'next_link' => '<i class="fa fa-chevron-right" aria-hidden="true"></i><span class="sr-only">Berikutnya</span>',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
			'cur_tag_open' => '<li class="active"><span>',
			'cur_tag_close' => '</span></li>',
		);

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
}
