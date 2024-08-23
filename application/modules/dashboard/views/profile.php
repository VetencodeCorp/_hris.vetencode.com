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
			<div class="row">
				<div class="col s12">
					<div class="title">
						Profile 
					</div>
					<hr>
				</div>
			</div>
			
			<div class="row">
				<div class="col s12 m12 l4">
					<div class="card-panel">
						<form id="form-edit" data-href="<?= base_url();?>dashboard" data-url="<?= base_url();?>dashboard/update_profile">
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="fullname" value="<?= $profile->fullname;?>" />
									<label for="fullname">Nama</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="phone" value="<?= $profile->phone;?>" />
									<label for="phone">No. HP</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="password" id="password" />
									<label for="password">Password Baru</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="password" id="passconf" />
									<label for="passconf">Ulangi Password</label>
								</div>
							</div>
							<div class="row right">
								<div class="input-field col s12">
									<a href="<?= base_url();?>dashboard" class="btn btn-cancel">cancel</a>
									<a href="#!" id="btn-update" class="btn btn-submit">submit</a>
								</div>
							</div>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			</div>
			
		</div>
		
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/profile.js"></script>
	</body>
</html>
