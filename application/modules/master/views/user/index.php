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
						Master Data / User 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<a href="<?= base_url();?>add-user" class="btn btn-submit right">add User</a>
				</div>
				<div class="col s12">
					<div class="card-panel">
						<div class="tableResponsive">
							<table id="data-table-simple" class="striped">
								<thead>
									<tr>
										<th width="40">No.</th>
										<th>Nama</th>
										<th width="100">No. HP</th>
										<th width="100">Akses</th>
										<?php
											if(is_access() == 1){
										?>
										<th width="120">Gaji Pokok</th>
										<?php
											}
										?>
										<th width="120">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(is_array($listUser)): 
											foreach($listUser as $data):
									?>
									<tr>
										<td><?= $number++ ;?></td>
										<td><?= $data->fullname;?></td>
										<td><?= $data->phone;?></td>
										<td><?= $data->nama_akses;?></td>
										<?php
											if(is_access() == 1){
										?>
										<td class="right-align"><?= number_format($data->gapok ?? 0);?></td>
										<?php
											}
										?>
										<td class="center">
											<?php
												if($data->active == 0){
											?>
											<button data-method="Active" data-url="<?= base_url();?>master/user/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating grey tooltipped btn-alert" data-tooltip="Actice"><i class="fa fa-eye-slash"></i></button>
											<?php
												} else{
											?>
											<button data-method="Inactive" data-url="<?= base_url();?>master/user/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating green tooltipped btn-alert" data-tooltip="Inactice"><i class="fa fa-eye"></i></button>
											<?php
												}
											?>
											<a href="<?= base_url();?>edit-user/<?= encrypt_decrypt($data->id, 'encrypt');?>" class="btn btn-floating orange tooltipped" data-tooltip="Edit"><i class="fa fa-pencil"></i></a>
											<button data-method="Delete" data-url="<?= base_url();?>master/user/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating red tooltipped btn-alert" data-tooltip="Delete"><i class="fa fa-trash"></i></button>
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
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/user.js"></script>
	</body>
</html>
