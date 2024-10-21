<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		protectByKey('CR0n_Pr0t3ct10n');

		$this->load->model('cron/mcron', 'cron');
	}

	public function clear_attendance_photos()
	{
		$this->output->set_content_type('application/json');

		$passDay = $this->input->get('passDay') ?? 7;
		$targetDate = date('Y-m-d', strtotime("-{$passDay} days"));

		$attendances = $this->cron->get_attendances_at($targetDate);

		// Loop through each attendance record and remove the photos
		$total_photos = count($attendances);
		if ($total_photos) {
			foreach ($attendances as $attendance) {
				$fotoPath = FCPATH . $attendance->foto;
				$fotoPulangPath = FCPATH . $attendance->foto_pulang;

				if (file_exists($fotoPath)) {
					unlink($fotoPath);
				}

				if (file_exists($fotoPulangPath)) {
					unlink($fotoPulangPath);
				}
			}
		}

		responseJSON([
			'success' => true,
			'message' => "$total_photos Attendance photos at {$passDay} days ago have been cleared.",
		]);
	}

	public function download_images($date)
	{
		if (!DateTime::createFromFormat('Y-m-d', $date)) {
			responseJSON([
				'success' => false,
				'message' => 'Invalid date format. Use Y-m-d.',
			], 400);
		}

		$attendances = $this->cron->get_attendances_with_user($date);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode($attendances));
	}

	public function delete_images($date)
	{
		if (!DateTime::createFromFormat('Y-m-d', $date)) {
			responseJSON([
				'success' => false,
				'message' => 'Invalid date format. Use Y-m-d.',
			], 400);
		}

		$attendances = $this->cron->get_attendances_with_user($date);

		$total_photos = count($attendances);
		if ($total_photos) {
			foreach ($attendances as $attendance) {
				$fotoPath = FCPATH . $attendance->foto;
				$fotoPulangPath = FCPATH . $attendance->foto_pulang;

				if (file_exists($fotoPath)) {
					unlink($fotoPath);
				}

				if (file_exists($fotoPulangPath)) {
					unlink($fotoPulangPath);
				}
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(
				[
					'success' => true,
					'message' => "$total_photos images deleted for the date: $date",
				]
			));
	}
}
