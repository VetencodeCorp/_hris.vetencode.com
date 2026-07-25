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
						Insentif / Gaji Pokok / <?= $this->fungsi->bulan_indo(date('Y-m-d'));?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12">
					<a <?= enableGapok();?> href="<?= base_url();?>add-gapok" class="btn btn-submit right">add gaji pokok</a>
					<div class="clearfix"></div>
					<div class="tableResponsive">
						<div class="card-panel">
							<table id="data-table-simple" class="striped">
								<thead>
									<tr>
										<th width="40">No.</th>
										<th>Nama</th>
										<th width="100">Gaji Pokok</th>
										<th width="60">Hapus</th>
									</tr>
								</thead>
								<tbody>
									<?php
										if(is_array($listGapok)): 
											foreach($listGapok as $data):
									?>
									<tr>
										<td><?= $number++ ;?></td>
										<td><?= $data->fullname;?></td>
										<td class="right-align"><?= number_format($data->jumlah);?></td>
										<td>
											<!-- <a href="<?= base_url();?>edit-gapok/<?= encrypt_decrypt($data->id, 'encrypt');?>" class="btn btn-floating orange tooltipped" data-tooltip="Edit"><i class="fa fa-pencil"></i></a> -->
											<button data-id="<?= $data->id;?>" data-url="<?= base_url();?>insentif/gapok/alert_delete" class="btn btn-delete btn-floating red tooltipped" data-tooltip="Delete"><i class="fa fa-trash"></i></button>
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
		<script type="text/javascript" src="<?= base_url();?>assets/js/modules/insentif_gapok.js"></script>
	</body>
</html>
