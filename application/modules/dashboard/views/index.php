<!DOCTYPE html>
<html lang="en">
	<head>
		<?= $this->load->view('themes/stylesheet');?>
		<title><?= $title;?></title>
	</head>
	<body>
		<?= $this->load->view('themes/topbar');?>
		<?= $this->load->view('themes/sidebar');?>
		<div class="content">
			<div class="row underline">
				<div class="col s12 mb5">
					<div class="left">
						Dashboard
					</div>
				</div>
			</div>
			
			<?php
				if(is_access() > 1){
					$isFlagged = in_array($absen->flag, array('sakit', 'izin', 'alpha'), true);
					$statusLabel = 'PENDING';
					$statusClass = 'is-pending';

					if($isFlagged){
						$statusLabel = strtoupper($absen->flag);
						$statusClass = 'is-flagged';
					} elseif((int) $absen->status === 2){
						$statusLabel = 'APPROVED';
						$statusClass = 'is-approved';
					} elseif((int) $absen->status === 0){
						$statusLabel = 'REJECTED';
						$statusClass = 'is-rejected';
					}
			?>
			<section class="employee-attendance-section">
				<div class="employee-attendance-heading">
					<div>
						<span class="employee-attendance-eyebrow">Kehadiran hari ini</span>
						<h2><?= $this->fungsi->tgl_indo(date('Y-m-d'));?></h2>
					</div>
					<span class="employee-attendance-status <?= $statusClass;?>">
						<i class="fa fa-circle" aria-hidden="true"></i>
						<?= $statusLabel;?>
					</span>
				</div>

				<div class="employee-attendance-grid">
					<article class="employee-attendance-card">
						<div class="employee-attendance-card-head">
							<div class="employee-attendance-icon is-in"><i class="fa fa-sign-in" aria-hidden="true"></i></div>
							<div>
								<span>Absen masuk</span>
								<small>Foto kedatangan</small>
							</div>
						</div>

						<img
							class="materialboxed responsive-img dashboard-attendance-photo"
							src="<?= ($absen->foto == NULL || $isFlagged) ? base_url().'assets/images/no-foto.jpg' : base_url().$absen->foto;?>"
							alt="Foto absen masuk"
						>

						<div class="employee-attendance-meta">
							<span><i class="fa fa-clock-o" aria-hidden="true"></i> Jam masuk</span>
							<strong><?= $absen->masuk ? $absen->masuk : '--:--:--';?></strong>
						</div>
					</article>

					<article class="employee-attendance-card">
						<div class="employee-attendance-card-head">
							<div class="employee-attendance-icon is-out"><i class="fa fa-sign-out" aria-hidden="true"></i></div>
							<div>
								<span>Absen pulang</span>
								<small>Foto kepulangan</small>
							</div>
						</div>

						<?php if($absen->pulang){ ?>
							<img class="materialboxed responsive-img dashboard-attendance-photo" src="<?= base_url();?><?= $absen->foto_pulang;?>" alt="Foto absen pulang">
							<div class="employee-attendance-meta">
								<span><i class="fa fa-clock-o" aria-hidden="true"></i> Jam pulang</span>
								<strong><?= $absen->pulang;?></strong>
							</div>
						<?php } else{ ?>
							<div class="employee-attendance-empty">
								<i class="fa fa-camera" aria-hidden="true"></i>
								<strong>Belum absen pulang</strong>
								<span>Ambil foto saat jam kerja selesai.</span>
							</div>
							<?php if(!$isFlagged && (int) $absen->status === 2){ ?>
								<a href="<?= base_url();?>absensi" class="employee-attendance-action">
									<i class="fa fa-camera" aria-hidden="true"></i> Absen pulang
								</a>
							<?php } else{ ?>
								<button type="button" class="employee-attendance-action" disabled>Menunggu persetujuan</button>
							<?php } ?>
						<?php } ?>
					</article>
				</div>
			</section>
			
			<div class="row">
				<div class="col s12 m4 summary">
					<div class="content-box">
						<div class="card-content content-box-icon cyan white-text">
							<i class="fa fa-money"></i>
						</div>
						<div class="content-box-number"><?= number_format($insentifMingguan);?></div>
						<span><?= $this->fungsi->tgl_indo(date('Y-m-d'));?></span>
					</div>
					<a href="#!">
						<div class="content-box-action cyan darken-2 center">
							 <span>INSENTIF MINGGUAN</span>
						</div>
					</a>
				</div>
				<div class="col s12 m4 summary">
					<div class="content-box">
						<div class="card-content content-box-icon green white-text">
							<i class="fa fa-money"></i>
						</div>
						<div class="content-box-number"><?= number_format($insentifBulanan);?></div>
						<span><?= $this->fungsi->tgl_indo(date('Y-m-d'));?></span>
					</div>
					<a href="#!">
						<div class="content-box-action green darken-2 center">
							 <span>INSENTIF BULANAN</span>
						</div>
					</a>
				</div>
			</div>

			<?php
				}
			?>

		</div>
		
		<?= $this->load->view('themes/script');?>
	</body>
</html>
