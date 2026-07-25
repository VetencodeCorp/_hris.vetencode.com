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
						Insentif / <a href="<?= base_url();?>insentif-gapok"> Gaji Pokok</a> / Edit
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m12 l4">
					<div class="card-panel">
						<div id="form-add" data-href="<?= base_url();?>insentif-gapok" data-url="<?= base_url();?>insentif/gapok/submit_update/<?= $gapok->id;?>">
							<div class="row mb-0">
								<div class="input-field col s12">
									<select id="user_id" data-url="<?= base_url();?>insentif/gapok/get_data_user">
										<option value="<?= $gapok->user_id;?>"><?= $gapok->fullname;?></option>
										<?php
											if(is_array($selectUser)): 
												foreach($selectUser as $user):
										?>
										<option value="<?= $user->id;?>"><?= $user->fullname;?></option>
										<?php
												endforeach; 
											endif;
										?>
									</select>
									<label for="user_id" class="active">Pegawai</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="input-gapok" class="text-jumlah" readonly="true" />
									<input type="hidden" id="gapok" />
									<label for="input-gapok" id="label-gapok">Gaji Pokok</label>
								</div>
							</div>
							<div class="row mb-0 right">
								<div class="input-field col s12">
									<a href="<?= base_url();?>insentif-gapok" class="btn btn-cancel">cancel</a>
									<button id="btn-add" class="btn btn-submit">submit</button>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal-delete" class="modal modal-small"></div>
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/insentif_gapok.js"></script>
	</body>
</html>
