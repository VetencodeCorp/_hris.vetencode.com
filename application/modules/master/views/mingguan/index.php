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
						Master Data / Insentif Mingguan 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6">
					<a href="#modal-form" class="btn modal-trigger btn-submit right">add Mingguan</a>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6">
					<div class="card-panel">
						<div class="tableResponsive">
							<table id="data-table-simple" class="striped">
								<thead>
									<tr>
										<th width="40">No.</th>
										<th>Jumlah</th>
										<th width="120">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(is_array($listData)): 
											foreach($listData as $data):
									?>
									<tr>
										<td><?= $number++ ;?></td>
										<td class="right-align"><?= number_format($data->jumlah);?></td>
										<td class="center">
											<?php
												if($data->is_active == 0){
											?>
											<button data-method="Active" data-url="<?= base_url();?>master/mingguan/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating grey tooltipped btn-alert" data-tooltip="Actice"><i class="fa fa-eye-slash"></i></button>
											<?php
												} else{
											?>
											<button data-method="Inactive" data-url="<?= base_url();?>master/mingguan/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating green tooltipped btn-alert" data-tooltip="Inactice"><i class="fa fa-eye"></i></button>
											<?php
												}
											?>
											<button data-method="Edit" data-url="<?= base_url();?>master/mingguan/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating orange tooltipped btn-alert" data-tooltip="Edit"><i class="fa fa-pencil"></i></button>
											<button data-method="Delete" data-url="<?= base_url();?>master/mingguan/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating red tooltipped btn-alert" data-tooltip="Delete"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
									<?php
											endforeach; 
										endif;
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="modal-alert" class="modal modal-small"></div>
		<div id="modal-form" class="modal modal-small">
			<div class="modal-content">
				<div id="form-add" data-href="<?= base_url();?>mingguan" data-url="<?= base_url();?>master/mingguan/add">
					<div class="row mb-0">
						<div class="input-field col s12">
							<input type="text" id="input-jumlah" class="text-jumlah" autofocus="true" />
							<input type="hidden" id="jumlah" />
							<label for="input-jumlah">Jumlah</label>
						</div>
					</div>
					<div class="row mb-0">
						<div class="input-field col s12">
							<button class="btn btn-submit col s12" id="btn-add">submit</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/master_mingguan.js"></script>
	</body>
</html>
