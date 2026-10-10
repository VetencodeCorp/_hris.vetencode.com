<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Absensi_manual extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		is_login();
		if ((int) getUser()->access_id !== 1) {
			show_404();
		}

		$this->config->load('manual_attendance', true);
		$this->load->model('absensi_manual/mabsensi_manual', 'manualAttendance');
		$this->data['title'] = 'Administrasi Terbatas';
	}

	public function index()
	{
		if (! $this->isUnlocked()) {
			$this->data['token'] = $this->formToken();
			$this->data['lockedSeconds'] = max(0, (int) $this->session->userdata('manual_attendance_locked_until') - time());
			$this->load->view('absensi_manual/unlock', $this->data);
			return;
		}

		$user = getUser();
		$this->data['title'] = 'Absensi Manual';
		$this->data['user'] = $user;
		$this->data['token'] = $this->formToken();
		$this->data['maxDate'] = date('Y-m-d', strtotime('-1 day'));
		$this->data['employees'] = $this->manualAttendance->getEmployees();
		$this->data['recentRecords'] = $this->manualAttendance->getRecentManualRecords(10);
		$this->data['unlockedUntil'] = (int) $this->session->userdata('manual_attendance_unlocked_until');
		$this->load->view('absensi_manual/index', $this->data);
	}

	public function unlock()
	{
		if ($this->input->method() !== 'post') {
			show_404();
		}

		$this->validateToken();
		$lockedUntil = (int) $this->session->userdata('manual_attendance_locked_until');
		if ($lockedUntil > time()) {
			$this->session->set_flashdata('manual_error', 'Terlalu banyak percobaan. Coba kembali beberapa menit lagi.');
			redirect('absensi-manual');
		}

		$password = (string) $this->input->post('password', false);
		$passwordHash = (string) $this->config->item('manual_attendance_password_hash', 'manual_attendance');

		if (! password_verify($password, $passwordHash)) {
			$attempts = (int) $this->session->userdata('manual_attendance_attempts') + 1;
			$maxAttempts = (int) $this->config->item('manual_attendance_max_attempts', 'manual_attendance');

			if ($attempts >= $maxAttempts) {
				$lockSeconds = (int) $this->config->item('manual_attendance_lock_seconds', 'manual_attendance');
				$this->session->set_userdata('manual_attendance_locked_until', time() + $lockSeconds);
				$this->session->unset_userdata('manual_attendance_attempts');
				$this->session->set_flashdata('manual_error', 'Akses dikunci selama 5 menit karena terlalu banyak percobaan.');
			} else {
				$this->session->set_userdata('manual_attendance_attempts', $attempts);
				$this->session->set_flashdata('manual_error', 'Password salah. Sisa percobaan: ' . ($maxAttempts - $attempts) . '.');
			}

			redirect('absensi-manual');
		}

		$sessionSeconds = (int) $this->config->item('manual_attendance_session_seconds', 'manual_attendance');
		$this->session->set_userdata('manual_attendance_unlocked_until', time() + $sessionSeconds);
		$this->session->unset_userdata(array(
			'manual_attendance_attempts',
			'manual_attendance_locked_until',
		));
		$this->rotateToken();
		redirect('absensi-manual');
	}

	public function store()
	{
		if ($this->input->method() !== 'post' || ! $this->isUnlocked()) {
			redirect('absensi-manual');
		}

		$this->validateToken();
		$user = getUser();
		$employeeId = (int) $this->input->post('user_id');
		$employee = $this->manualAttendance->getEmployee($employeeId);
		$date = trim((string) $this->input->post('tanggal', true));
		$timeIn = $this->normalizeTime($this->input->post('masuk', true));
		$timeOut = $this->normalizeTime($this->input->post('pulang', true));
		$note = trim((string) $this->input->post('note', true));

		if (! $employee) {
			$this->fail('Karyawan wajib dipilih dan harus berstatus aktif.');
		}
		if (! $this->validPastDate($date)) {
			$this->fail('Tanggal wajib diisi dan harus sebelum hari ini.');
		}
		if ($timeIn === false || $timeOut === false) {
			$this->fail('Format jam tidak valid.');
		}
		if ($this->manualAttendance->existsForDate($employee->id, $date)) {
			$this->fail('Absensi pada tanggal tersebut sudah ada.');
		}

		$photoIn = $this->uploadPhoto('foto', 'manual-in');
		if (isset($photoIn['error'])) {
			$this->fail($photoIn['error']);
		}
		$photoOut = $this->uploadPhoto('foto_pulang', 'manual-out');
		if (isset($photoOut['error'])) {
			$this->removePhoto(isset($photoIn['path']) ? $photoIn['path'] : null);
			$this->fail($photoOut['error']);
		}

		$auditNote = 'Input manual oleh ' . $user->fullname . ' pada ' . date('d-m-Y H:i:s') . ' WIB untuk ' . $employee->fullname . '.';
		if ($note !== '') {
			$auditNote .= ' Catatan: ' . $note;
		}

		$data = array(
			'foto' => isset($photoIn['path']) ? $photoIn['path'] : null,
			'foto_pulang' => isset($photoOut['path']) ? $photoOut['path'] : null,
			'user_id' => (int) $employee->id,
			'masuk' => $timeIn ?: null,
			'pulang' => $timeOut ?: null,
			'status' => 2,
			'flag' => 'hadir',
			'note' => $auditNote,
			'tanggal' => $date . ' 00:00:00',
		);

		if (! $this->manualAttendance->insert($data)) {
			$this->removePhoto(isset($photoIn['path']) ? $photoIn['path'] : null);
			$this->removePhoto(isset($photoOut['path']) ? $photoOut['path'] : null);
			$this->fail('Absensi gagal disimpan. Silakan coba lagi.');
		}

		$this->rotateToken();
		$this->session->set_flashdata('manual_success', 'Absensi ' . $employee->fullname . ' pada ' . date('d-m-Y', strtotime($date)) . ' berhasil disimpan sebagai Hadir dan Disetujui.');
		redirect('absensi-manual');
	}

	public function delete()
	{
		if ($this->input->method() !== 'post' || ! $this->isUnlocked()) {
			redirect('absensi-manual');
		}

		$this->validateToken();
		$record = $this->manualAttendance->getManualRecord((int) $this->input->post('id'));
		if (! $record) {
			$this->fail('Absensi manual tidak ditemukan.');
		}

		if (! $this->manualAttendance->deleteManualRecord($record->id)) {
			$this->fail('Absensi manual gagal dihapus.');
		}

		$this->removePhoto($record->foto);
		$this->removePhoto($record->foto_pulang);
		$this->rotateToken();
		$this->session->set_flashdata('manual_success', 'Absensi manual ' . $record->fullname . ' pada ' . date('d-m-Y', strtotime($record->tanggal)) . ' berhasil dihapus.');
		redirect('absensi-manual');
	}

	public function lock()
	{
		if ($this->input->method() === 'post') {
			$this->validateToken();
			$this->session->unset_userdata('manual_attendance_unlocked_until');
			$this->rotateToken();
		}

		redirect('absensi-manual');
	}

	private function isUnlocked()
	{
		return (int) $this->session->userdata('manual_attendance_unlocked_until') > time();
	}

	private function validPastDate($date)
	{
		$dateObject = DateTime::createFromFormat('!Y-m-d', $date);
		$errors = DateTime::getLastErrors();
		$isValid = $dateObject
			&& ($errors === false || ($errors['warning_count'] === 0 && $errors['error_count'] === 0))
			&& $dateObject->format('Y-m-d') === $date;

		return $isValid && $date < date('Y-m-d');
	}

	private function normalizeTime($time)
	{
		$time = trim((string) $time);
		if ($time === '') {
			return null;
		}

		foreach (array('H:i:s', 'H:i') as $format) {
			$timeObject = DateTime::createFromFormat('!' . $format, $time);
			if ($timeObject && $timeObject->format($format) === $time) {
				return $timeObject->format('H:i:s');
			}
		}

		return false;
	}

	private function uploadPhoto($field, $prefix)
	{
		if (! isset($_FILES[$field]) || (int) $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
			return array('path' => null);
		}
		if ((int) $_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
			return array('error' => 'Upload foto gagal.');
		}
		if ((int) $_FILES[$field]['size'] > 5 * 1024 * 1024) {
			return array('error' => 'Ukuran foto maksimal 5 MB.');
		}

		$imageInfo = @getimagesize($_FILES[$field]['tmp_name']);
		$mimeMap = array(
			'image/jpeg' => 'jpg',
			'image/png' => 'png',
			'image/webp' => 'webp',
		);
		$mime = $imageInfo && isset($imageInfo['mime']) ? $imageInfo['mime'] : '';
		if (! isset($mimeMap[$mime])) {
			return array('error' => 'Foto harus berformat JPG, PNG, atau WEBP.');
		}

		$directory = FCPATH . 'assets/images/absen/';
		$filename = $prefix . '-' . time() . '-' . bin2hex(random_bytes(6)) . '.' . $mimeMap[$mime];
		if (! move_uploaded_file($_FILES[$field]['tmp_name'], $directory . $filename)) {
			return array('error' => 'Foto gagal disimpan.');
		}

		return array('path' => 'assets/images/absen/' . $filename);
	}

	private function removePhoto($path)
	{
		if ($path && strpos($path, 'assets/images/absen/manual-') === 0) {
			$file = FCPATH . $path;
			if (is_file($file)) {
				@unlink($file);
			}
		}
	}

	private function formToken()
	{
		$token = $this->session->userdata('manual_attendance_token');
		if (! is_string($token) || strlen($token) < 32) {
			$token = bin2hex(random_bytes(24));
			$this->session->set_userdata('manual_attendance_token', $token);
		}

		return $token;
	}

	private function validateToken()
	{
		$sessionToken = (string) $this->session->userdata('manual_attendance_token');
		$postToken = (string) $this->input->post('token', false);
		if ($sessionToken === '' || ! hash_equals($sessionToken, $postToken)) {
			show_error('Permintaan tidak valid.', 403);
		}
	}

	private function rotateToken()
	{
		$this->session->set_userdata('manual_attendance_token', bin2hex(random_bytes(24)));
	}

	private function fail($message)
	{
		$this->session->set_flashdata('manual_error', $message);
		redirect('absensi-manual');
		exit;
	}
}
