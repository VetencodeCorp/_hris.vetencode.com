<div class="modal-content">
	<div id="form-alert" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/submit_alert">
		<input type="hidden" id="id" value="<?= $id;?>" />
		<input type="hidden" id="method" value="<?= $method;?>" />
		<div class="row center mb-0">
			<?php
				if($method == 'Rejected'){
			?>
			<div class="input-field">
				<input type="text" id="note" />
				<label for="note">Keterangan</label>
			</div>
			<i class="fa fa-times-circle-o fa-5x" ></i>
			<?php
				}
			?>
			<?php
				if($method == 'Approved'){
			?>
			<i class="fa fa-thumbs-o-up fa-5x" ></i>
			<?php
				}
			?>
			<h5>Apakah anda yakin ?</h5>
		</div>
		<div class="row mb-0">
			<div class="input-field col s12">
				<button id="btn-submit-alert" class="btn btn-submit col s12">ok</button>
			</div>
		</div>
	</div>	
</div>