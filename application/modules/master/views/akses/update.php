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
				<div class="col s12 ">
					<div class="left">
						Master Data / <a href="<?= base_url();?>akses"> Akses</a> / Edit
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6 l4">
					<div class="card-panel">
						<div id="form-update" data-url="<?= base_url();?>master/akses/submit_update/<?= $akses->id;?>" data-href="<?= base_url();?>akses">
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="name" value="<?= $akses->name;?>" />
									<label for="name">Akses</label>
								</div>
							</div>
							<div class="row mb-0 right">
								<div class="input-field col s12">
									<a href="<?= base_url();?>akses" class="btn btn-cancel">cancel</a>
									<button id="btn-update" class="btn btn-submit">submit</button>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/akses.js"></script>
	</body>
</html>
