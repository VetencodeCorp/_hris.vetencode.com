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
			<section class="manual-unlock-shell">
				<div class="manual-unlock-icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
				<span class="manual-eyebrow">Area terbatas</span>
				<h1>Konfirmasi akses</h1>
				<p>Masukkan password tambahan untuk membuka administrasi khusus.</p>

				<?php if ($this->session->flashdata('manual_error')): ?>
					<div class="manual-alert is-error"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><?= html_escape($this->session->flashdata('manual_error')); ?></div>
				<?php endif; ?>

				<form method="post" action="<?= base_url('absensi-manual/unlock'); ?>" class="manual-unlock-form">
					<input type="hidden" name="token" value="<?= html_escape($token); ?>">
					<label for="manual-password">Password tambahan</label>
					<div class="manual-password-wrap">
						<i class="fa fa-key" aria-hidden="true"></i>
						<input id="manual-password" type="password" name="password" inputmode="numeric" autocomplete="off" required <?= $lockedSeconds > 0 ? 'disabled' : ''; ?>>
					</div>
					<button type="submit" <?= $lockedSeconds > 0 ? 'disabled' : ''; ?>>Buka akses</button>
				</form>
			</section>
		</main>

		<?= $this->load->view('themes/script'); ?>
	</body>
</html>
