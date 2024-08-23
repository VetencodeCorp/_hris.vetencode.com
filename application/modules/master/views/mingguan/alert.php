<div class="modal-content">
	<div id="form-alert" data-href="<?= base_url();?>mingguan" data-url="<?= base_url();?>master/mingguan/submit_alert">
		<input type="hidden" id="akses_id" value="<?= $id;?>" />
		<input type="hidden" id="method" value="<?= $method;?>" />
		<div class="row center mb-0">
			<?php
				if($method == 'Edit'){
			?>
				<div class="input-field col s12">
					<input type="text" id="input-jumlah" class="text-jumlah" value="<?= number_format($dataRow->jumlah);?>" />
					<input type="hidden" id="jumlah" value="<?= $dataRow->jumlah;?>" />
					<label for="input-jumlah" class="active">Jumlah</label>
				</div>
			<?php
				} else{
			?>
				<?php
					if($method == 'Inactive'){
				?>
				<i class="fa fa-eye-slash fa-5x"></i>
				<?php
					} elseif($method == 'Active'){
				?>
				<i class="fa fa-eye fa-5x"></i>
				<?php
					} elseif($method == 'Delete'){
				?>
				<i class="fa fa-trash fa-5x"></i>
				<?php
					}
				?>
				<h5>Apakah anda yakin ?</h5>
			<?php
				}
			?>
		</div>
		<div class="row mb-0">
			<div class="col s12">
				<button id="btn-submit-alert" class="btn btn-submit col s12">ok</button>
			</div>
		</div>
	</div>
</div>