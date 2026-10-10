<?php
$monthNames = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
?>
<!DOCTYPE html>
<html lang="id">
	<head>
		<?= $this->load->view('themes/stylesheet'); ?>
		<title><?= html_escape($title); ?></title>
	</head>
	<body class="manual-attendance-page">
		<?= $this->load->view('themes/topbar'); ?>
		<?= $this->load->view('themes/sidebar'); ?>

		<main class="content">
			<header class="manual-page-header">
				<div>
					<span class="manual-eyebrow">Area terbatas</span>
					<h1>Absensi Manual</h1>
					<p>Pilih karyawan tujuan. Absensi langsung berstatus <strong>Hadir dan Disetujui</strong>.</p>
				</div>
				<form method="post" action="<?= base_url('absensi-manual/lock'); ?>">
					<input type="hidden" name="token" value="<?= html_escape($token); ?>">
					<button type="submit" class="manual-lock-button"><i class="fa fa-lock" aria-hidden="true"></i>Kunci akses</button>
				</form>
			</header>

			<?php if ($this->session->flashdata('manual_error')): ?>
				<div class="manual-alert is-error"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><?= html_escape($this->session->flashdata('manual_error')); ?></div>
			<?php endif; ?>
			<?php if ($this->session->flashdata('manual_success')): ?>
				<div class="manual-alert is-success"><i class="fa fa-check-circle" aria-hidden="true"></i><?= html_escape($this->session->flashdata('manual_success')); ?></div>
			<?php endif; ?>

			<div class="manual-layout">
				<section class="manual-form-card">
					<div class="manual-card-heading">
						<div class="manual-card-icon"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></div>
						<div><h2>Tambah absensi lampau</h2><p>Hanya tanggal yang wajib diisi.</p></div>
					</div>

					<form method="post" action="<?= base_url('absensi-manual/store'); ?>" enctype="multipart/form-data" class="manual-attendance-form">
						<input type="hidden" name="token" value="<?= html_escape($token); ?>">
						<label class="manual-field manual-field-wide">
							<span>Karyawan <b>*</b></span>
							<select name="user_id" class="browser-default" required>
								<option value="" selected disabled>Pilih karyawan</option>
								<?php foreach ($employees as $employee): ?>
									<option value="<?= (int) $employee->id; ?>"><?= html_escape($employee->fullname); ?></option>
								<?php endforeach; ?>
							</select>
						</label>
						<label class="manual-field manual-field-wide">
							<span>Tanggal <b>*</b></span>
							<input type="date" name="tanggal" max="<?= html_escape($maxDate); ?>" required>
						</label>
						<label class="manual-field">
							<span>Jam masuk <small>Opsional</small></span>
							<input type="time" name="masuk" step="1">
						</label>
						<label class="manual-field">
							<span>Jam pulang <small>Opsional</small></span>
							<input type="time" name="pulang" step="1">
						</label>
						<label class="manual-field">
							<span>Foto masuk <small>Opsional</small></span>
							<input type="file" name="foto" accept="image/jpeg,image/png,image/webp">
						</label>
						<label class="manual-field">
							<span>Foto pulang <small>Opsional</small></span>
							<input type="file" name="foto_pulang" accept="image/jpeg,image/png,image/webp">
						</label>
						<label class="manual-field manual-field-wide">
							<span>Catatan <small>Opsional</small></span>
							<textarea name="note" rows="3" maxlength="500" placeholder="Contoh: lupa melakukan absensi"></textarea>
						</label>
						<div class="manual-form-note manual-field-wide"><i class="fa fa-info-circle" aria-hidden="true"></i>Tanggal yang sudah memiliki absensi tidak dapat ditambahkan lagi.</div>
						<button type="submit" class="manual-submit manual-field-wide"><i class="fa fa-check" aria-hidden="true"></i>Simpan sebagai Hadir</button>
					</form>
				</section>

				<aside class="manual-recent-card">
					<div class="manual-card-heading compact">
						<div><h2>Input manual terbaru</h2><p>Sepuluh catatan terbaru semua karyawan.</p></div>
					</div>
					<?php if (empty($recentRecords)): ?>
						<div class="manual-recent-empty"><i class="fa fa-inbox" aria-hidden="true"></i><span>Belum ada input manual.</span></div>
					<?php else: ?>
						<div class="manual-recent-list">
							<?php foreach ($recentRecords as $record): ?>
								<?php $recordDate = strtotime($record->tanggal); ?>
								<div class="manual-recent-item">
									<div><strong><?= html_escape($record->fullname); ?></strong><span>Hadir · Disetujui</span></div>
									<div class="manual-recent-date"><?= date('d', $recordDate); ?> <?= $monthNames[(int) date('n', $recordDate)]; ?> <?= date('Y', $recordDate); ?></div>
									<div class="manual-recent-times"><span>Masuk <b><?= $record->masuk ?: '--:--:--'; ?></b></span><span>Pulang <b><?= $record->pulang ?: '--:--:--'; ?></b></span></div>
									<form method="post" action="<?= base_url('absensi-manual/delete'); ?>" onsubmit="return confirm('Hapus absensi manual ini? Tindakan ini tidak dapat dibatalkan.');">
										<input type="hidden" name="token" value="<?= html_escape($token); ?>">
										<input type="hidden" name="id" value="<?= (int) $record->id; ?>">
										<button type="submit" class="manual-delete-button"><i class="fa fa-trash" aria-hidden="true"></i>Hapus</button>
									</form>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</aside>
			</div>
		</main>

		<?= $this->load->view('themes/script'); ?>
	</body>
</html>
