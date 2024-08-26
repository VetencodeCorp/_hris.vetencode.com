<!DOCTYPE html>
<html lang="en">

<head>
	<?= $this->load->view('themes/stylesheet'); ?>
	<title><?= $title; ?></title>
	<style>
		.reset-button {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			height: 100%;
			padding: 8px 12px;
			margin-right: 10px;
			background-color: #f5f5f5;
			border: 1px solid #b71c1c;
			border-radius: 4px;
			cursor: pointer;
			transition: background-color 0.3s ease, border-color 0.3s ease;
		}

		.reset-button i {
			font-size: 16px;
			color: #b71c1c;
		}

		.reset-button:hover {
			background-color: #f8d7da;
			border-color: #b71c1c;
		}

		.reset-button:active {
			background-color: #f5c6cb;
			border-color: #b71c1c;
		}

		.tableResponsive .dataTables_length select {
			display: block;
		}
	</style>
</head>

<body>
	<?= $this->load->view('themes/topbar'); ?>
	<?= $this->load->view('themes/sidebar'); ?>
	<div class="content">
		<div class="row underline">
			<div class="col s12 ">
				<div class="left">
					Report / Absensi
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<form id="wrap-search" data-url="<?= base_url(); ?>report/absensi/search_data" class="row">
						<div class="input-field col s6 m6 l2">
							<input type="text" id="from_date" name="from_date" />
							<label for="start_date">Dari</label>
						</div>
						<div class="input-field col s6 m6 l2">
							<input type="text" id="to_date" name="to_date" />
							<label for="end_date">Sampai</label>
						</div>
						<?php if (is_access() < 3) : ?>
							<div class="input-field col s12 m12 l3 pad5">
								<select id="user_id" name="user_id">
									<option value="" selected="selected">Semua Pegawai</option>
									<?php
									if (is_array($selectUser)):
										foreach ($selectUser as $user):
									?>
											<option value="<?= $user->id; ?>"><?= $user->fullname; ?></option>
									<?php
										endforeach;
									endif;
									?>
								</select>
								<label for="user_id" class="active">Nama</label>
							</div>
							<div class="input-field col s12 m12 l2 pad5">
								<select id="access_id" name="access_id">
									<option value="" selected="selected">Semua Jabatan</option>
									<?php foreach ($accesses as $access): ?>
										<option value="<?= $access->id; ?>"><?= $access->name; ?></option>
									<?php endforeach; ?>
								</select>
								<label for="access_id" class="active">Jabatan</label>
							</div>
						<?php endif; ?>
						<div class="input-field col s12 m12 l3 pad5" style="display: flex">
							<span class="reset-button tooltipped" data-position="bottom" data-tooltip="Reset">
								<i class="fa fa-rotate-right"></i>
							</span>

							<!-- <a href="#!" class="btn btn-cancel" style="margin-right: 1rem;" onClick="window.location.reload();">reset</a> -->
							<button type="button" name="download-pdf" data-url="<?= base_url('report/absensi/download_pdf'); ?>" class="btn btn-submit">Download PDF</button>
						</div>
					</form>
				</div>
			</div>
			<div id="showTable">
				<div class="col s12">
					<div class="card-panel">
						<div class="tableResponsive">
							<table id="data-table-absen" class="striped" data-url="<?= base_url(); ?>report/absensi/datatable">
								<thead>
									<tr>
										<th width="40">No.</th>
										<?php
										if (is_access() < 3) {
										?>
											<th width="100">Tanggal</th>
											<th>Nama</th>
										<?php
										} else {
										?>
											<th>Tanggal</th>
										<?php
										}
										?>
										<th width="100">Masuk</th>
										<th width="100">Pulang</th>
										<th width="120">Keterangan</th>
										<!-- <th width="50">Aksi</th> -->
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<?= $this->load->view('themes/script'); ?>
	<script type="text/javascript" src="<?= base_url(); ?>assets/js/modules/report_absensi.js"></script>
</body>

</html>