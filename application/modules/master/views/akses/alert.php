<div class="modal-content">
	<div id="form-alert" data-href="<?= base_url();?>akses" data-url="<?= base_url();?>master/akses/submit_alert">
		<input type="hidden" id="akses_id" value="<?= $id;?>" />
		<input type="hidden" id="method" value="<?= $method;?>" />
		<div class="row center">
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
		</div>
		<div class="row">
			<div class="col s12">
				<button id="btn-submit-alert" class="btn btn-submit col s12">ok</button>
			</div>
		</div>
	</div>
</div>