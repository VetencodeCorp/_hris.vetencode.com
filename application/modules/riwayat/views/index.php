<?php
$monthNames = array(
	1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
	'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
);
$dayNames = array(
	'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
	'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu',
);
$currentYear = (int) date('Y');
?>
<!DOCTYPE html>
<html lang="id">
	<head>
		<?= $this->load->view('themes/stylesheet'); ?>
		<title><?= html_escape($title); ?></title>
	</head>
	<body class="history-page <?= $isSuperadmin ? 'history-admin' : 'history-employee'; ?>">
		<?= $this->load->view('themes/topbar'); ?>
		<?= $this->load->view('themes/sidebar'); ?>

		<main class="content">
			<header class="history-page-header">
				<div>
					<span class="history-eyebrow">Kehadiran</span>
					<h1><?= html_escape($title); ?></h1>
					<p><?= $isSuperadmin ? 'Pilih karyawan dan periode sebelum menampilkan data.' : 'Lihat catatan masuk, pulang, status, dan foto absensi Anda.'; ?></p>
				</div>
			</header>

			<section class="history-filter-card">
				<form method="get" action="<?= base_url('riwayat-absensi'); ?>" class="history-filter-form">
					<?php if ($isSuperadmin): ?>
						<label class="history-filter-field history-filter-employee">
							<span>Karyawan</span>
							<select name="employee" class="browser-default" required>
								<option value="">Pilih karyawan</option>
								<?php foreach ($employees as $employee): ?>
									<option value="<?= (int) $employee->id; ?>" <?= (int) $selectedEmployeeId === (int) $employee->id ? 'selected' : ''; ?>>
										<?= html_escape($employee->fullname); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</label>
					<?php endif; ?>

					<label class="history-filter-field">
						<span>Bulan</span>
						<select name="month" class="browser-default" required>
							<option value="">Pilih bulan</option>
							<?php foreach ($monthNames as $monthNumber => $monthName): ?>
								<option value="<?= $monthNumber; ?>" <?= (int) $selectedMonth === (int) $monthNumber ? 'selected' : ''; ?>><?= $monthName; ?></option>
							<?php endforeach; ?>
						</select>
					</label>

					<label class="history-filter-field">
						<span>Tahun</span>
						<select name="year" class="browser-default" required>
							<option value="">Pilih tahun</option>
							<?php for ($year = $currentYear + 1; $year >= 2020; $year--): ?>
								<option value="<?= $year; ?>" <?= (int) $selectedYear === $year ? 'selected' : ''; ?>><?= $year; ?></option>
							<?php endfor; ?>
						</select>
					</label>

					<button type="submit" class="history-filter-submit">
						<i class="fa fa-search" aria-hidden="true"></i>
						Tampilkan
					</button>
				</form>
			</section>

			<?php if (! $filterApplied): ?>
				<section class="history-empty-state">
					<div class="history-empty-visual">
						<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
					</div>
					<h2>Belum ada data ditampilkan</h2>
					<p>Pilih karyawan, bulan, dan tahun untuk melihat riwayat absensi.</p>
				</section>
			<?php else: ?>
				<section class="history-table-card">
					<div class="history-table-heading">
						<div>
							<h2><?= html_escape($selectedEmployee->fullname); ?></h2>
							<p><?= $monthNames[(int) $selectedMonth]; ?> <?= (int) $selectedYear; ?> · <?= (int) $totalRows; ?> catatan</p>
						</div>
					</div>

					<?php if (empty($history)): ?>
						<div class="history-no-results">
							<i class="fa fa-inbox" aria-hidden="true"></i>
							<strong>Data tidak ditemukan</strong>
							<span>Tidak ada absensi pada periode ini.</span>
						</div>
					<?php else: ?>
						<div class="history-table-wrap">
							<table class="history-table">
								<thead>
									<tr>
										<th>Tanggal</th>
										<th>Masuk</th>
										<th>Pulang</th>
										<th>Status</th>
										<th>Keterangan</th>
										<th class="center-align">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($history as $item): ?>
										<?php
										$date = strtotime($item->tanggal);
										$statusLabel = 'Menunggu';
										$statusClass = 'is-pending';
										if ($item->flag && $item->flag !== 'hadir') {
											$statusLabel = ucfirst($item->flag);
											$statusClass = 'is-note';
										} elseif ((int) $item->status === 2) {
											$statusLabel = 'Disetujui';
											$statusClass = 'is-approved';
										} elseif ((int) $item->status === 0) {
											$statusLabel = 'Ditolak';
											$statusClass = 'is-rejected';
										}
										$description = $item->flag ? ucfirst($item->flag) : 'Hadir';
										$photoIn = $item->foto ? base_url(ltrim($item->foto, '/')) : '';
										$photoOut = $item->foto_pulang ? base_url(ltrim($item->foto_pulang, '/')) : '';
										?>
										<tr>
											<td data-label="Tanggal">
												<strong><?= date('d', $date); ?> <?= $monthNames[(int) date('n', $date)]; ?> <?= date('Y', $date); ?></strong>
												<small><?= $dayNames[date('l', $date)]; ?></small>
											</td>
											<td data-label="Masuk"><span class="history-time"><?= $item->masuk ? date('H:i:s', strtotime($item->masuk)) : '--:--:--'; ?></span></td>
											<td data-label="Pulang"><span class="history-time"><?= $item->pulang ? date('H:i:s', strtotime($item->pulang)) : '--:--:--'; ?></span></td>
											<td data-label="Status"><span class="history-status <?= $statusClass; ?>"><i class="fa fa-circle" aria-hidden="true"></i><?= $statusLabel; ?></span></td>
											<td data-label="Keterangan"><?= html_escape($description); ?></td>
											<td data-label="Aksi" class="center-align">
												<button
													type="button"
													class="history-detail-button"
													data-name="<?= html_escape($selectedEmployee->fullname); ?>"
													data-date="<?= date('d', $date); ?> <?= $monthNames[(int) date('n', $date)]; ?> <?= date('Y', $date); ?>"
													data-in-time="<?= $item->masuk ? date('H:i:s', strtotime($item->masuk)) : '--:--:--'; ?>"
													data-out-time="<?= $item->pulang ? date('H:i:s', strtotime($item->pulang)) : '--:--:--'; ?>"
													data-status="<?= html_escape($statusLabel); ?>"
													data-note="<?= html_escape($item->note ?: $description); ?>"
													data-photo-in="<?= html_escape($photoIn); ?>"
													data-photo-out="<?= html_escape($photoOut); ?>"
												>
													<i class="fa fa-eye" aria-hidden="true"></i> Detail
												</button>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<?= $pagination; ?>
					<?php endif; ?>
				</section>
			<?php endif; ?>
		</main>

		<div id="history-detail-modal" class="modal history-detail-modal" role="dialog" aria-modal="true" aria-labelledby="history-modal-title">
			<div class="modal-content">
				<div class="history-modal-head">
					<div>
						<span class="history-eyebrow">Detail absensi</span>
						<h2 id="history-modal-title">Riwayat absensi</h2>
						<p id="history-modal-date"></p>
					</div>
					<button type="button" class="modal-close history-modal-close" aria-label="Tutup"><i class="fa fa-times" aria-hidden="true"></i></button>
				</div>

				<div class="history-photo-grid">
					<div class="history-photo-panel">
						<div class="history-photo-label"><span>Foto masuk</span><strong id="history-modal-in-time">--:--:--</strong></div>
						<div class="history-photo-frame" id="history-photo-in-frame">
							<img id="history-photo-in" alt="Foto absen masuk">
							<div class="history-photo-missing"><i class="fa fa-image" aria-hidden="true"></i><span>Tidak ada foto</span></div>
						</div>
					</div>
					<div class="history-photo-panel">
						<div class="history-photo-label"><span>Foto pulang</span><strong id="history-modal-out-time">--:--:--</strong></div>
						<div class="history-photo-frame" id="history-photo-out-frame">
							<img id="history-photo-out" alt="Foto absen pulang">
							<div class="history-photo-missing"><i class="fa fa-image" aria-hidden="true"></i><span>Tidak ada foto</span></div>
						</div>
					</div>
				</div>

				<div class="history-detail-meta">
					<div><span>Status</span><strong id="history-modal-status">-</strong></div>
					<div><span>Keterangan</span><strong id="history-modal-note">-</strong></div>
				</div>
			</div>
		</div>

		<?= $this->load->view('themes/script'); ?>
		<script src="<?= base_url(); ?>assets/js/modules/riwayat.js?v=<?= filemtime(FCPATH . 'assets/js/modules/riwayat.js'); ?>"></script>
	</body>
</html>
