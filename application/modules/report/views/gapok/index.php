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
						Report / Gaji Pokok 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<div class="card-panel">
						<form id="wrap-search" data-url="<?= base_url();?>report/gapok/search_data" class="row">
							<div class="input-field col s6 m6 l2">
								<input type="text" id="from_date" name="from_date" />
								<label for="start_date">Dari</label>
							</div>
							<div class="input-field col s6 m6 l2">
								<input type="text" id="to_date" name="to_date" />
								<label for="end_date">Sampai</label>
							</div>
							<?php
								if(is_access() < 3){
							?>
							<div class="input-field col s12 m12 l3 pad5">
								<select id="user_id" name="jenis_infak_id">
									<option value="" selected="selected">Semua Pegawai</option>
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
								<label for="user_id" class="active">Nama</label>
							</div>
							<?php
								}
							?>
							<div class="input-field col s12 m12 l3 pad5">
								<a href="#!" class="btn btn-cancel" onClick="window.location.reload();">reset</a>
							</div>
						</form>
					</div>
				</div>
				<div id="showTable"></div>
			</div>
		</div>
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/report_gapok.js"></script>
	</body>
</html>
