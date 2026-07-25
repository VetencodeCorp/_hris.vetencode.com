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
						Master Data / <a href="<?= base_url();?>user"> User</a> / Edit
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6 l4">
					<div class="card-panel">
						<div id="form-update" data-href="<?= base_url();?>user" data-url="<?= base_url();?>master/user/submit_update/<?= $user->id;?>">
							<div class="row mb-0">
								<div class="input-field col s12">
									<select id="akses_id">
										<option value="<?= $user->access_id;?>"><?= $user->nama_akses;?></option>
										<?php
											foreach($updateSelectAkses as $akses):
										?>
										<option value="<?= $akses->id;?>"><?= $akses->name;?></option>
										<?php
											endforeach;
										?>
									</select>
									<label for="akses_id" class="active">Akses</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="fullname" value="<?= $user->fullname;?>" />
									<label for="fullname">Nama Lengkap</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="phone" value="<?= $user->phone;?>" data-url="<?= base_url();?>master/user/check_phone/<?= $user->id;?>" />
									<label for="phone">No. HP</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="password" id="password" />
									<label for="password">Password</label>
								</div>
							</div>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="password" id="passconf" />
									<label for="passconf">Ulangi Password</label>
								</div>
							</div>
							<?php
								if(is_access() == 1){
							?>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="input-gapok" value="<?= number_format($user->gapok);?>" class="text-jumlah" />
									<input type="hidden" id="gapok" value="<?= $user->gapok;?>" />
									<label for="input-gapok">Gaji Pokok</label>
								</div>
							</div>
							<?php
								}
							?>
							<div class="row mb-0">
								<div class="input-field col s12">
									<input type="text" id="input-mingguan" value="<?= number_format($user->mingguan);?>" class="text-jumlah" />
									<input type="hidden" id="mingguan" value="<?= $user->mingguan;?>" />
									<label for="input-mingguan">Insentif Mingguan</label>
								</div>
							</div>
							
							<div class="row mb-0 right">
								<div class="input-field col s12">
									<a href="<?= base_url();?>user" class="btn btn-cancel">cancel</a>
									<button class="btn btn-submit" id="btn-update">submit</button>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/user.js"></script>
	</body>
</html>
