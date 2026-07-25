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
						Master Data / Akses 
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<a href="<?= base_url();?>add-akses" class="btn btn-submit right">add Akses</a>
				</div>
				<div class="col s12">
					<div class="card-panel">
						<div class="tableResponsive">
							<table id="data-table-simple" class="striped">
								<thead>
									<tr>
										<th width="40">No.</th>
										<th>Nama</th>
										<th width="120">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(is_array($listAkses)): 
											foreach($listAkses as $data):
									?>
									<tr>
										<td><?= $number++ ;?></td>
										<td><?= $data->name;?></td>
										<td class="center">
											<?php
												if($data->active == 0){
											?>
											<button data-method="Active" data-url="<?= base_url();?>master/akses/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating grey tooltipped btn-alert" data-tooltip="Actice"><i class="fa fa-eye-slash"></i></button>
											<?php
												} else{
											?>
											<button data-method="Inactive" data-url="<?= base_url();?>master/akses/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating green tooltipped btn-alert" data-tooltip="Inactice"><i class="fa fa-eye"></i></button>
											<?php
												}
											?>
											<a href="<?= base_url();?>edit-akses/<?= encrypt_decrypt($data->id, 'encrypt');?>" class="btn btn-floating orange tooltipped" data-tooltip="Edit"><i class="fa fa-pencil"></i></a>
											<button data-method="Delete" data-url="<?= base_url();?>master/akses/alert_action" data-id="<?= $data->id;?>" class="btn btn-floating red tooltipped btn-alert" data-tooltip="Delete"><i class="fa fa-trash"></i></button>
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
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/akses.js"></script>
	</body>
</html>
