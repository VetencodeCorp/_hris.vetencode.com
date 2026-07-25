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
						Absen / <?= $this->fungsi->tgl_indo(date('Y-m-d'));?>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col s12">
					<h5>MASUK</h5>
				</div>
				<?php
					if(is_array($daftarAbsen)): 
						foreach($daftarAbsen as $data):
				?>
				
				<div class="col s12 m6 l3">
					<div class="card-panel">
						<?= strtoupper($data->fullname);?>
						<?php
							if($data->check_absen > 0){
						?>
						<?php
							foreach($data->absen as $absen):
						?>
						<img class="materialboxed responsive-img" width="100%" src="<?php if($absen->foto == NULL){?> <?= base_url();?>assets/images/no-foto.jpg <?php } else{?><?= base_url();?><?= $absen->foto;?><?php }?>">
						<br>
						<span><?= $absen->masuk;?></span>
						<?php
							if(is_access() == 2){
						?>
							<?php
								if($data->access_id == 2){
							?>
							<div class="right">
								<?php
									if($absen->flag !== NULL){
								?>
								<a href="#!" data-url="<?= base_url();?>kehadiran/update_flag/<?= $absen->id;?>/<?= $absen->user_id;?>/<?= $absen->flag;?>" class="btn-edit-flag"><span class="white-text orange pad5 right tooltipped" data-tooltip="Edit"><?= strtoupper($absen->flag);?></span> </a>
								<?php
									} else{
								?>
								<?php
									if($absen->status == 0){
								?>
								<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Rejected" class="btn btn-floating tooltipped red btn-alert" data-tooltip="Rejected"><i class="fa fa-times"></i></button>
								<button class="btn btn-floating grey"><i class="fa fa-thumbs-up"></i></button>
								<?php
									} elseif($absen->status == 1){
								?>
								<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Rejected" class="btn btn-floating tooltipped red btn-alert" data-tooltip="Rejected"><i class="fa fa-times"></i></button>
								<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Approved" class="btn btn-floating tooltipped green btn-alert" data-tooltip="Approved"><i class="fa fa-thumbs-up"></i></button>
								<?php
									} elseif($absen->status == 2){
								?>
								<button class="btn btn-floating grey"><i class="fa fa-times"></i></button>
								<button class="btn btn-floating grey"><i class="fa fa-thumbs-up"></i></button>
								<?php
									}
								?>
								<?php
									}
								?>
							</div> 
							<?php
								} else{
							?>
							&nbsp;
							<div class="right">
								<?php
									if($absen->flag !== NULL){
								?>
								<a href="#!" data-url="<?= base_url();?>kehadiran/update_flag/<?= $absen->id;?>/<?= $absen->user_id;?>/<?= $absen->flag;?>" class="btn-edit-flag"><span class="white-text orange pad5 right tooltipped" data-tooltip="Edit"><?= strtoupper($absen->flag);?></span> </a>
								<?php
									} else{
								?>
								<?php
									if($absen->status == 0){
								?>
								<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Rejected" class="btn btn-floating tooltipped red btn-alert" data-tooltip="Rejected"><i class="fa fa-times"></i></button>
								<button class="btn btn-floating grey"><i class="fa fa-thumbs-up"></i></button>
								<?php
									} elseif($absen->status == 1){
								?>
								<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Rejected" class="btn btn-floating tooltipped red btn-alert" data-tooltip="Rejected"><i class="fa fa-times"></i></button>
								<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Approved" class="btn btn-floating tooltipped green btn-alert" data-tooltip="Approved"><i class="fa fa-thumbs-up"></i></button>
								<?php
									} elseif($absen->status == 2){
								?>
								<button class="btn btn-floating grey"><i class="fa fa-times"></i></button>
								<button class="btn btn-floating grey"><i class="fa fa-thumbs-up"></i></button>
								<?php
									}
								?>
								<?php
									}
								?>
							</div>
							<?php
								}
							?>
						<?php
							} else{
						?>
						&nbsp;
						<div class="right">
							<?php
								if($absen->flag !== NULL){
							?>
							<a href="#!" data-url="<?= base_url();?>kehadiran/update_flag/<?= $absen->id;?>/<?= $absen->user_id;?>/<?= $absen->flag;?>" class="btn-edit-flag"><span class="white-text orange pad5 right tooltipped" data-tooltip="Edit"><?= strtoupper($absen->flag);?></span> </a>
							<?php
								} else{
							?>
							<?php
								if($absen->status == 0){
							?>
							<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Rejected" class="btn btn-floating tooltipped red btn-alert" data-tooltip="Rejected"><i class="fa fa-times"></i></button>
							<button class="btn btn-floating grey"><i class="fa fa-thumbs-up"></i></button>
							<?php
								} elseif($absen->status == 1){
							?>
							<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Rejected" class="btn btn-floating tooltipped red btn-alert" data-tooltip="Rejected"><i class="fa fa-times"></i></button>
							<button data-id="<?= $absen->id;?>" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_action" data-method="Approved" class="btn btn-floating tooltipped green btn-alert" data-tooltip="Approved"><i class="fa fa-thumbs-up"></i></button>
							<?php
								} elseif($absen->status == 2){
							?>
							<button class="btn btn-floating grey"><i class="fa fa-times"></i></button>
							<button class="btn btn-floating grey"><i class="fa fa-thumbs-up"></i></button>
							<?php
								}
							?>
							<?php
								}
							?>
						</div>
						<?php
							}
						?>
						<?php
							endforeach;
						?>
						
						<?php
							} else{
						?>
						<img style="margin-bottom: -53px;" class="materialboxed responsive-img" width="100%" src="<?= base_url();?>assets/images/no-foto.jpg">
						<br>
						<div class="row center mb-0">
							<div class="input-field col s12">
								<select id="flag" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/alert_flag/<?= $data->id;?>" class="browser-default btn-flag">
									<option value="" selected="selected" disabled="disabled">KETERANGAN</option>
									<option value="sakit">SAKIT</option>
									<option value="izin">IZIN</option>
									<option value="alpha">ALPHA</option>
								</select>
							</div>
						</div>
						<?php
							if($data->check_absen > 0){
						?>
						<?php
							if($absen->flag !== NULL){
						?>
						<span class="white-text orange pad5 right"><?= strtoupper($absen->flag);?></span> 
						<?php
							}
						?>
						<?php
							}
						?>
						<?php
							}
						?>
					</div>
				</div>
				<?php
						endforeach; 
					endif;
				?>
				<div class="col s12">
					<h5>PULANG</h5>
				</div>
				<?php
					if(is_array($daftarAbsen)): 
						foreach($daftarAbsen as $dataPulang):
				?>
				<?php
					foreach($dataPulang->absen_pulang as $absenPulang):
				?>
				<div class="col s12 m6 l3">
					<div class="card-panel">
						<?= strtoupper($dataPulang->fullname);?>
						<img class="materialboxed responsive-img" width="100%" src="<?php if($absenPulang->foto_pulang == NULL){?> <?= base_url();?>assets/images/no-foto.jpg <?php } else{?><?= base_url();?><?= $absenPulang->foto_pulang;?><?php }?>">
						<br>
						PUKUL : <span><?= $absenPulang->pulang;?></span>
					</div>
				</div>
				<?php
					endforeach;
				?>
				<?php
						endforeach; 
					endif;
				?>
			</div>
		</div>
		<div id="modal-alert" class="modal modal-small"></div>
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/kehadiran.js"></script>
	</body>
</html>
