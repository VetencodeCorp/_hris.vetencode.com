<?php
$topbarUser = getUser();
$topbarAccess = (int) $topbarUser->access_id;
$topbarUri = trim($this->uri->uri_string(), '/');
$topbarTitle = isset($title) && $title ? $title : 'Dashboard';
$topbarInitial = strtoupper(substr(trim($topbarUser->fullname), 0, 1));
$topbarRole = getAccess();

$topbarActive = static function (array $matches) use ($topbarUri) {
	foreach ($matches as $match) {
		if ($topbarUri === $match || strpos($topbarUri, $match . '/') === 0) {
			return true;
		}
	}

	return false;
};

$mobileSections = array();

if ($topbarAccess === 1) {
	$mobileSections = array(
		array('label' => null, 'items' => array(
			array('label' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'fa-th-large', 'match' => array('dashboard')),
		)),
		array('label' => 'Master Data', 'items' => array(
			array('label' => 'Akses', 'url' => 'akses', 'icon' => 'fa-shield', 'match' => array('akses', 'add-akses', 'edit-akses')),
			array('label' => 'User', 'url' => 'user', 'icon' => 'fa-users', 'match' => array('user', 'add-user', 'edit-user')),
		)),
		array('label' => 'Kehadiran', 'items' => array(
			array('label' => 'Monitoring Absen', 'url' => 'kehadiran', 'icon' => 'fa-check-square-o', 'match' => array('kehadiran')),
		)),
		array('label' => 'Insentif', 'items' => array(
			array('label' => 'Insentif Mingguan', 'url' => 'insentif-mingguan', 'icon' => 'fa-calendar-check-o', 'match' => array('insentif-mingguan', 'add-mingguan', 'edit-insentif-mingguan')),
			array('label' => 'Gaji Pokok', 'url' => 'insentif-gapok', 'icon' => 'fa-money', 'match' => array('insentif-gapok', 'add-gapok', 'edit-gapok')),
		)),
		array('label' => 'Laporan', 'items' => array(
			array('label' => 'Absensi', 'url' => 'report-absen', 'icon' => 'fa-file-text-o', 'match' => array('report-absen')),
			array('label' => 'Insentif Mingguan', 'url' => 'report-mingguan', 'icon' => 'fa-line-chart', 'match' => array('report-mingguan')),
			array('label' => 'Gaji Pokok', 'url' => 'report-gapok', 'icon' => 'fa-bar-chart', 'match' => array('report-gapok')),
		)),
	);
} elseif ($topbarAccess === 2) {
	$mobileSections = array(
		array('label' => null, 'items' => array(
			array('label' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'fa-th-large', 'match' => array('dashboard')),
		)),
		array('label' => 'Kepegawaian', 'items' => array(
			array('label' => 'User', 'url' => 'user', 'icon' => 'fa-users', 'match' => array('user', 'add-user', 'edit-user')),
		)),
		array('label' => 'Kehadiran', 'items' => array(
			array('label' => 'Monitoring Absen', 'url' => 'kehadiran', 'icon' => 'fa-check-square-o', 'match' => array('kehadiran')),
		)),
		array('label' => 'Insentif', 'items' => array(
			array('label' => 'Insentif Mingguan', 'url' => 'insentif-mingguan', 'icon' => 'fa-calendar-check-o', 'match' => array('insentif-mingguan', 'add-mingguan', 'edit-insentif-mingguan')),
		)),
		array('label' => 'Laporan', 'items' => array(
			array('label' => 'Absensi', 'url' => 'report-absen', 'icon' => 'fa-file-text-o', 'match' => array('report-absen')),
		)),
	);
} else {
	$mobileSections = array(
		array('label' => null, 'items' => array(
			array('label' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'fa-th-large', 'match' => array('dashboard')),
		)),
	);
}
?>

<header class="app-topbar">
	<div class="app-topbar-inner">
		<div class="app-topbar-left">
			<button type="button" id="sidebar-toggle" class="app-sidebar-toggle" aria-label="Sembunyikan sidebar" aria-expanded="true">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</button>
			<a href="#!" data-target="nav-mobile" class="app-mobile-trigger sidenav-trigger" aria-label="Buka navigasi">
				<i class="fa fa-bars" aria-hidden="true"></i>
			</a>
			<div class="app-topbar-title">
				<strong><?= html_escape($topbarTitle); ?></strong>
				<span class="app-topbar-date"><?= $this->fungsi->tgl_indo(date('Y-m-d')); ?></span>
			</div>
		</div>

		<a href="<?= base_url(); ?>profile" class="app-user-menu">
			<span class="app-user-avatar"><?= html_escape($topbarInitial); ?></span>
			<span class="app-user-copy">
				<span class="app-user-name"><?= html_escape($topbarUser->fullname); ?></span>
				<span class="app-user-role"><?= html_escape($topbarRole); ?></span>
			</span>
		</a>
	</div>
</header>

<ul id="nav-mobile" class="sidenav app-mobile-nav">
	<li>
		<a href="<?= base_url(); ?>dashboard" class="app-brand">
			<span class="app-brand-logo">
				<img src="<?= base_url(); ?>assets/images/brand-logo.png" alt="Vetencode HRIS">
			</span>
			<span>
				<span class="brand-name">Vetencode HRIS</span>
				<span class="brand-caption"><?= $topbarAccess > 2 ? 'Portal Karyawan' : 'Panel Admin'; ?></span>
			</span>
		</a>
	</li>

	<?php foreach ($mobileSections as $section): ?>
		<?php if ($section['label']): ?>
			<li><div class="app-nav-label"><?= html_escape($section['label']); ?></div></li>
		<?php endif; ?>

		<?php foreach ($section['items'] as $item): ?>
			<li>
				<a href="<?= base_url($item['url']); ?>" class="app-nav-item <?= $topbarActive($item['match']) ? 'active' : ''; ?>">
					<i class="fa <?= html_escape($item['icon']); ?>" aria-hidden="true"></i>
					<span><?= html_escape($item['label']); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	<?php endforeach; ?>

	<li><div class="app-nav-label">Akun</div></li>
	<li>
		<a href="<?= base_url(); ?>profile" class="app-nav-item <?= $topbarActive(array('profile')) ? 'active' : ''; ?>">
			<i class="fa fa-user-circle-o" aria-hidden="true"></i>
			<span>Profile</span>
		</a>
	</li>
	<li>
		<a href="#form-logout" class="app-nav-item danger modal-trigger">
			<i class="fa fa-sign-out" aria-hidden="true"></i>
			<span>Keluar</span>
		</a>
	</li>
</ul>

<div id="form-logout" class="modal modal-small">
	<div class="modal-content center">
		<div class="app-user-avatar" style="margin: 0 auto 14px;">
			<i class="fa fa-sign-out" aria-hidden="true"></i>
		</div>
		<h5>Keluar dari aplikasi?</h5>
		<p style="color: var(--ink-soft);">Sesi Anda akan diakhiri.</p>
		<div class="row" style="margin: 24px 0 0;">
			<div class="col s6">
				<button type="button" class="btn-cancel modal-close" style="width: 100%;">Batal</button>
			</div>
			<div class="col s6">
				<a href="<?= base_url(); ?>login/logout" class="btn-submit" style="display: block; width: 100%;">Keluar</a>
			</div>
		</div>
	</div>
</div>
