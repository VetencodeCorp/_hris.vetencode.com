<!DOCTYPE html>
<html lang="en">
	<head>
		<?= $this->load->view('themes/stylesheet');?>
		<title><?= $title;?></title>
		<script type="text/javascript" src="<?= base_url();?>assets/vendor/webcamjs/webcam.min.js"></script> 
	</head>
	<body>
		<?= $this->load->view('themes/topbar');?>
		<?= $this->load->view('themes/sidebar');?>
		<div class="content">
			<div class="row">
				<div class="col s12">
					<div class="title">
						Absen
					</div>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6 l3">
					<div id="my_camera"></div>
					<br>
					<div id="pre_take_buttons">
						<button class="btn btn-cancel" id="btn-foto">foto</button>
					</div>
					<div id="post_take_buttons" style="display:none">
						<button class="btn btn-cancel" id="btn-refoto">ulangi</button>
						<button data-href="<?= base_url();?>dashboard" data-url="<?= base_url();?>absensi/insert" class="btn btn-submit" id="btn-absen">absen</button>
					</div>
				</div>
			</div>
			
			<div id="wrap-note">
			<?php
				if(checkAbsenReject() > 0){
			?>
				<?php
					if($checkNote->note !== NULL){
				?>
				<div class="row">
					<div class="col s12 m6 l3">
						<h5>Silakan Foto Kembali</h5>
						<div class="card-panel orange white-text">
							<?= $checkNote->note;?>
						</div>
					</div>
				</div>
			<?php
				}
			?>
			<?php
				}
			?>
			</div>
		</div>
		
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/absen.js?v=<?= filemtime(FCPATH.'assets/js/modules/absen.js');?>"></script>
	</body>
</html>
