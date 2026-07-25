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
			<div class="row underline">
				<div class="col s12 mb5">
					<div class="left">
						Insentif / Gaji Pokok
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m12 l4">
					<div class="card-panel">
						
					</div>
				</div>
			</div>
		</div>
		<div id="modal-delete" class="modal modal-small"></div>
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/insentif_gapok.js"></script>
	</body>
</html>
