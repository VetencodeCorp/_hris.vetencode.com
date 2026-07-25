<!DOCTYPE html>
<html lang="id">
	<head>
		<?= $this->load->view('themes/stylesheet'); ?>
		<title><?= html_escape($title); ?></title>
	</head>

	<body class="auth-page">
		<main class="auth-shell">
			<section class="auth-brand-panel" aria-label="Identitas aplikasi">
				<div class="auth-brand-content">
					<div class="auth-logo-wrap">
						<img src="<?= base_url(); ?>assets/images/brand-logo.png" alt="Logo Vetencode HRIS">
					</div>
					<h1>Kerja terhubung.<br>Tim lebih tertata.</h1>
					<p>
						Kelola kehadiran, insentif, dan aktivitas pegawai dalam satu sistem yang ringkas dan mudah digunakan.
					</p>
					<div class="auth-node-line">Connected Workforce</div>
				</div>
			</section>

			<section class="auth-form-panel">
				<div class="auth-card">
					<div class="auth-mobile-logo">
						<img src="<?= base_url(); ?>assets/images/brand-logo.png" alt="Logo Vetencode HRIS">
					</div>

					<div class="auth-eyebrow">Vetencode HRIS</div>
					<h2>Selamat datang</h2>
					<p class="auth-subtitle">Masuk untuk melanjutkan aktivitas perusahaan.</p>

					<div id="form-login" data-url="<?= base_url(); ?>login/auth">
						<div class="auth-field">
							<label for="phone">Nomor HP</label>
							<div class="auth-input-wrap">
								<i class="fa fa-phone" aria-hidden="true"></i>
								<input
									id="phone"
									name="phone"
									type="text"
									inputmode="numeric"
									autocomplete="username"
									placeholder="Contoh: 081234567890"
									aria-label="Nomor HP"
								>
							</div>
						</div>

						<div class="auth-field">
							<label for="password">Password</label>
							<div class="auth-input-wrap">
								<i class="fa fa-lock" aria-hidden="true"></i>
								<input
									id="password"
									name="password"
									type="password"
									autocomplete="current-password"
									placeholder="Masukkan password"
									aria-label="Password"
								>
							</div>
						</div>

						<button
							type="button"
							class="auth-submit"
							data-href="<?= base_url(); ?>dashboard"
							id="btn-login"
						>
							Masuk
						</button>
					</div>

					<div class="auth-footer">
						&copy; <?= date('Y'); ?> Vetencode. Seluruh hak dilindungi.
					</div>
				</div>
			</section>
		</main>

		<?= $this->load->view('themes/script'); ?>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/modules/login.js"></script>
	</body>
</html>
