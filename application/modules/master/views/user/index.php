<?php
$visibleUsers = is_array($listUser) ? $listUser : array();
$totalUsers = count($visibleUsers);
$activeUsers = 0;
$inactiveUsers = 0;

foreach ($visibleUsers as $visibleUser) {
	if ((int) $visibleUser->active === 1) {
		$activeUsers++;
	} else {
		$inactiveUsers++;
	}
}
?>
<!DOCTYPE html>
<html lang="id">
	<head>
		<?= $this->load->view('themes/stylesheet'); ?>
		<title><?= html_escape($title); ?></title>
	</head>
	<body>
		<?= $this->load->view('themes/topbar'); ?>
		<?= $this->load->view('themes/sidebar'); ?>

		<main class="content">
			<section class="page-intro">
				<div>
					<div class="page-eyebrow">Master Data</div>
					<h1>Data User</h1>
					<p>Kelola akun, akses, status, dan data penggajian pengguna.</p>
				</div>
				<a href="<?= base_url(); ?>add-user" class="btn-submit page-primary-action">
					<i class="fa fa-plus" aria-hidden="true"></i>
					<span>Tambah User</span>
				</a>
			</section>

			<section class="table-stats" aria-label="Ringkasan user">
				<div class="table-stat-card">
					<span class="table-stat-label">Total User</span>
					<strong><?= number_format($totalUsers); ?></strong>
				</div>
				<div class="table-stat-card success">
					<span class="table-stat-label">User Aktif</span>
					<strong><?= number_format($activeUsers); ?></strong>
				</div>
				<div class="table-stat-card muted">
					<span class="table-stat-label">User Nonaktif</span>
					<strong><?= number_format($inactiveUsers); ?></strong>
				</div>
			</section>

			<section class="presenz-table-card">
				<div class="presenz-table-heading">
					<div>
						<h2>Daftar User</h2>
						<p>Gunakan pencarian untuk menemukan user berdasarkan nama, nomor HP, atau akses.</p>
					</div>
					<span class="table-count"><?= number_format($totalUsers); ?> data</span>
				</div>

				<div class="tableResponsive presenz-table-scroll">
					<table id="data-table-simple" class="presenz-table">
						<thead>
							<tr>
								<th class="table-number">No.</th>
								<th>User</th>
								<th>Nomor HP</th>
								<th>Akses</th>
								<?php if (is_access() == 1): ?>
									<th class="right-align">Gaji Pokok</th>
								<?php endif; ?>
								<th>Status</th>
								<th class="right-align table-actions-column">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($visibleUsers as $data): ?>
								<?php
								$userInitial = strtoupper(substr(trim($data->fullname), 0, 1));
								$isActive = (int) $data->active === 1;
								?>
								<tr>
									<td class="table-number" data-label="No."><?= $number++; ?></td>
									<td data-label="User">
										<div class="table-user">
											<span class="table-avatar"><?= html_escape($userInitial); ?></span>
											<div class="table-user-copy">
												<strong><?= html_escape($data->fullname); ?></strong>
												<span>ID User #<?= (int) $data->id; ?></span>
											</div>
										</div>
									</td>
									<td data-label="Nomor HP">
										<span class="table-phone"><?= html_escape($data->phone); ?></span>
									</td>
									<td data-label="Akses">
										<span class="table-role-badge">
											<i class="fa fa-shield" aria-hidden="true"></i>
											<?= html_escape($data->nama_akses); ?>
										</span>
									</td>
									<?php if (is_access() == 1): ?>
										<td class="right-align table-currency" data-label="Gaji Pokok">
											Rp <?= number_format($data->gapok ?? 0, 0, ',', '.'); ?>
										</td>
									<?php endif; ?>
									<td data-label="Status">
										<span class="table-status <?= $isActive ? 'active' : 'inactive'; ?>">
											<span class="table-status-dot"></span>
											<?= $isActive ? 'Aktif' : 'Nonaktif'; ?>
										</span>
									</td>
									<td class="right-align table-actions" data-label="Aksi">
										<?php if ($isActive): ?>
											<button
												type="button"
												data-method="Inactive"
												data-url="<?= base_url(); ?>master/user/alert_action"
												data-id="<?= (int) $data->id; ?>"
												class="table-action warning tooltipped btn-alert"
												data-tooltip="Nonaktifkan"
												aria-label="Nonaktifkan <?= html_escape($data->fullname); ?>"
											>
												<i class="fa fa-eye-slash" aria-hidden="true"></i>
											</button>
										<?php else: ?>
											<button
												type="button"
												data-method="Active"
												data-url="<?= base_url(); ?>master/user/alert_action"
												data-id="<?= (int) $data->id; ?>"
												class="table-action success tooltipped btn-alert"
												data-tooltip="Aktifkan"
												aria-label="Aktifkan <?= html_escape($data->fullname); ?>"
											>
												<i class="fa fa-eye" aria-hidden="true"></i>
											</button>
										<?php endif; ?>

										<a
											href="<?= base_url(); ?>edit-user/<?= encrypt_decrypt($data->id, 'encrypt'); ?>"
											class="table-action primary tooltipped"
											data-tooltip="Edit"
											aria-label="Edit <?= html_escape($data->fullname); ?>"
										>
											<i class="fa fa-pencil" aria-hidden="true"></i>
										</a>

										<button
											type="button"
											data-method="Delete"
											data-url="<?= base_url(); ?>master/user/alert_action"
											data-id="<?= (int) $data->id; ?>"
											class="table-action danger tooltipped btn-alert"
											data-tooltip="Hapus"
											aria-label="Hapus <?= html_escape($data->fullname); ?>"
										>
											<i class="fa fa-trash" aria-hidden="true"></i>
										</button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</section>
		</main>

		<div id="modal-alert" class="modal modal-small"></div>
		<?= $this->load->view('themes/script'); ?>
		<script type="text/javascript" src="<?= base_url(); ?>assets/js/modules/user.js?v=<?= filemtime(FCPATH . 'assets/js/modules/user.js'); ?>"></script>
	</body>
</html>
