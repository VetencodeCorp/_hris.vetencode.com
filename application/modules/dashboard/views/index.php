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
						Dahsboard 
					</div>
				</div>
			</div>
			
			<?php
				if(is_access() > 1){
			?>
			<div class="row">
				<div class="col s12">ABSEN <?= $this->fungsi->tgl_indo(date('Y-m-d'));?></div>
				<?php
					if($absen->foto == NULL || $absen->flag == 'sakit' || $absen->flag == 'izin' || $absen->flag == 'alpha'){
				?>
				<div class="col s12 m6 l3">
					<div class="card-panel">
						<img class="materialboxed responsive-img" width="100%" src="<?= base_url();?>assets/images/no-foto.jpg"> &nbsp;
						<span class="white-text orange pad5 right"><?= strtoupper($absen->flag);?></span>
					</div>
				</div>
				<?php
					} else{
				?>
				<div class="col s12 m6 l3">
					<div class="card-panel">
						<img class="materialboxed responsive-img" width="100%" src="<?= base_url();?><?= $absen->foto;?>">
						<br>
						MASUK : <span><?= $absen->masuk;?></span>
						<?php
							if($absen->status == 1){
						?>
						<span class="white-text orange pad5 right">PENDING</span>
						<?php
							} elseif($absen->status == 2){
						?>
						<span class="white-text green pad5 right">APPROVED</span>
						<?php
							}
						?>
					</div>
				</div>
				<div class="col s12 m6 l3">
					<div class="card-panel">
						<?php
							if($absen->pulang){
						?>
						<img class="materialboxed responsive-img" width="100%" src="<?= base_url();?><?= $absen->foto_pulang;?>">
						<br>
						PULANG : <span><?= $absen->pulang;?></span>
						<?php
							} else{
						?>
						<a href="<?= base_url();?>absensi" class="btn red col s12">absen</a>
						<br> <br>
						PULANG :
						<?php
							}
						?>
					</div>
				</div>
				<?php
					}
				?>
			</div>
			
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
