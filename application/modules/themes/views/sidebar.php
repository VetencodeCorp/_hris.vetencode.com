<?php
$sidebarUser = getUser();
$sidebarAccess = (int) $sidebarUser->access_id;
$sidebarUri = trim($this->uri->uri_string(), '/');

$sidebarActive = static function (array $matches) use ($sidebarUri) {
	foreach ($matches as $match) {
		if ($sidebarUri === $match || strpos($sidebarUri, $match . '/') === 0) {
			return true;
		}
	}

	return false;
};

$sidebarSections = array();

if ($sidebarAccess === 1) {
	$sidebarSections = array(
		array(
			'label' => null,
			'items' => array(
				array('label' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'fa-th-large', 'match' => array('dashboard')),
			),
		),
		array(
			'label' => 'Master Data',
			'items' => array(
				array('label' => 'Akses', 'url' => 'akses', 'icon' => 'fa-shield', 'match' => array('akses', 'add-akses', 'edit-akses')),
				array('label' => 'User', 'url' => 'user', 'icon' => 'fa-users', 'match' => array('user', 'add-user', 'edit-user')),
			),
		),
		array(
			'label' => 'Kehadiran',
			'items' => array(
				array('label' => 'Monitoring Absen', 'url' => 'kehadiran', 'icon' => 'fa-check-square-o', 'match' => array('kehadiran')),
			),
		),
		array(
			'label' => 'Insentif',
			'items' => array(
				array('label' => 'Insentif Mingguan', 'url' => 'insentif-mingguan', 'icon' => 'fa-calendar-check-o', 'match' => array('insentif-mingguan', 'add-mingguan', 'edit-insentif-mingguan')),
				array('label' => 'Gaji Pokok', 'url' => 'insentif-gapok', 'icon' => 'fa-money', 'match' => array('insentif-gapok', 'add-gapok', 'edit-gapok')),
			),
		),
		array(
			'label' => 'Laporan',
			'items' => array(
				array('label' => 'Absensi', 'url' => 'report-absen', 'icon' => 'fa-file-text-o', 'match' => array('report-absen')),
				array('label' => 'Insentif Mingguan', 'url' => 'report-mingguan', 'icon' => 'fa-line-chart', 'match' => array('report-mingguan')),
				array('label' => 'Gaji Pokok', 'url' => 'report-gapok', 'icon' => 'fa-bar-chart', 'match' => array('report-gapok')),
			),
		),
	);
} elseif ($sidebarAccess === 2) {
	$sidebarSections = array(
		array(
			'label' => null,
			'items' => array(
				array('label' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'fa-th-large', 'match' => array('dashboard')),
			),
		),
		array(
			'label' => 'Kepegawaian',
			'items' => array(
				array('label' => 'User', 'url' => 'user', 'icon' => 'fa-users', 'match' => array('user', 'add-user', 'edit-user')),
			),
		),
		array(
			'label' => 'Kehadiran',
			'items' => array(
				array('label' => 'Monitoring Absen', 'url' => 'kehadiran', 'icon' => 'fa-check-square-o', 'match' => array('kehadiran')),
			),
		),
		array(
			'label' => 'Insentif',
			'items' => array(
				array('label' => 'Insentif Mingguan', 'url' => 'insentif-mingguan', 'icon' => 'fa-calendar-check-o', 'match' => array('insentif-mingguan', 'add-mingguan', 'edit-insentif-mingguan')),
			),
		),
		array(
			'label' => 'Laporan',
			'items' => array(
				array('label' => 'Absensi', 'url' => 'report-absen', 'icon' => 'fa-file-text-o', 'match' => array('report-absen')),
			),
		),
	);
} else {
	$sidebarSections = array(
		array(
			'label' => null,
			'items' => array(
				array('label' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'fa-th-large', 'match' => array('dashboard')),
			),
		),
	);
}
?>

<aside class="app-sidebar hide-on-med-and-down">
	<a href="<?= base_url(); ?>dashboard" class="app-brand">
		<span class="app-brand-logo">
			<img src="<?= base_url(); ?>assets/images/brand-logo.png" alt="Vetencode HRIS">
		</span>
		<span>
			<span class="brand-name">Vetencode HRIS</span>
			<span class="brand-caption"><?= $sidebarAccess > 2 ? 'Portal Karyawan' : 'Panel Admin'; ?></span>
		</span>
	</a>

	<div class="app-sidebar-menu">
		<?php foreach ($sidebarSections as $section): ?>
			<div class="app-nav-section">
				<?php if ($section['label']): ?>
					<div class="app-nav-label"><?= html_escape($section['label']); ?></div>
				<?php endif; ?>

				<?php foreach ($section['items'] as $item): ?>
					<a href="<?= base_url($item['url']); ?>" class="app-nav-item <?= $sidebarActive($item['match']) ? 'active' : ''; ?>">
						<i class="fa <?= html_escape($item['icon']); ?>" aria-hidden="true"></i>
						<span><?= html_escape($item['label']); ?></span>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="app-sidebar-footer">
		<a href="<?= base_url(); ?>profile" class="app-nav-item <?= $sidebarActive(array('profile')) ? 'active' : ''; ?>">
			<i class="fa fa-user-circle-o" aria-hidden="true"></i>
			<span>Profile</span>
		</a>
		<a href="#form-logout" class="app-nav-item danger modal-trigger">
			<i class="fa fa-sign-out" aria-hidden="true"></i>
			<span>Keluar</span>
		</a>
	</div>
</aside>
