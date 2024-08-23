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
						Insentif / Mingguan / <?= $this->fungsi->tgl_indo(date('Y-m-d'));?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<a <?= enableMingguan();?> href="<?= base_url();?>add-mingguan" class="btn btn-submit right">add mingguan</a> 
					<div class="clearfix"></div>
					<div class="card-panel">
						<div class="tableResponsive">
							<table id="data-table-simple" class="striped">
								<thead>
									<tr>
										<th width="40">No.</th>
										<th>Nama</th>
										<th width="80" class="right-align">Insentif</th>
										<th width="60" class="right-align">Kehadiran</th>
										<th width="80" class="right-align">Jumlah</th>
										<th width="80">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(is_array($listInsentif)): 
											foreach($listInsentif as $data):
									?>
									<tr>
										<td><?= $number++ ;?></td>
										<td><?= $data->fullname;?></td>
										<td class="right-align"><?= number_format($data->insentif);?></td>
										<td class="right-align"><?= $data->kehadiran;?></td>
										<td class="right-align"><?= number_format($data->jumlah);?></td>
										<td class="center-align">
											<!-- <a href="<?= base_url();?>edit-insentif-mingguan/<?= encrypt_decrypt($data->id, 'encrypt');?>" class="btn btn-floating orange tooltipped" data-tooltip="Edit"><i class="fa fa-pencil"></i></a> -->
											<button class="btn btn-floating red tooltipped btn-delete" data-id="<?= $data->id;?>" data-url="<?= base_url();?>insentif/mingguan/delete" data-href="<?= base_url();?>insentif-mingguan" data-tooltip="Delete"><i class="fa fa-trash"></i></button>
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
		<div id="modal-delete" class="modal modal-small"></div>
		<?= $this->load->view('themes/script');?>
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/insentif_mingguan.js"></script>
	</body>
</html>
