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
						Insentif / <a href="<?= base_url();?>insentif-mingguan"> Mingguan</a> / Edit 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m12 l4">
					<div class="card-panel">
						<div id="form-add" data-href="<?= base_url();?>insentif-mingguan" data-url="<?= base_url();?>insentif/mingguan/submit_update/">
							<div class="row mb-0">
								<div class="input-field col s12">
									<select id="user_id" data-url="<?= base_url();?>insentif/mingguan/get_data_user">
										<option value="<?= $dataRow->user_id;?>"><?= $dataRow->fullname;?></option>
										<?php
											if(is_array($updateSelectPegawai)): 
												foreach($updateSelectPegawai as $user):
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
								<div class="input-field col s12 m7">
									<input type="text" id="input-insentif" value="<?= number_format(insentif_mingguan());?>" class="text-jumlah" readonly="true" />
									<input type="hidden" id="insentif" value="<?= insentif_mingguan();?>" />
									<label for="input-insentif">Insentif</label>
								</div>
								<div class="input-field col s12 m5">
									<input type="text" id="hadir" class="text-jumlah" readonly="true" />
									<label for="hadir" id="label-hadir">Kehadiran</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="input-jumlah" class="text-jumlah" readonly="true" />
									<input type="hidden" id="jumlah" />
									<label for="input-jumlah" id="label-jumlah">Jumlah</label>
								</div>
							</div>
							<div class="row mb-0 right">
								<div class="input-field col s12">
									<a href="<?= base_url();?>insentif-mingguan" class="btn btn-cancel">cancel</a>
									<button id="btn-add" class="btn btn-submit">submit</button>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/insentif_mingguan.js"></script>
	</body>
</html>
