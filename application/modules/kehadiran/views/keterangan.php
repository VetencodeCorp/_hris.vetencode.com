<div class="modal-content">
	<div id="form-alert" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/submit_keterangan">
		<input type="hidden" id="id" value="<?= $id;?>" />
		<input type="hidden" id="method" value="<?= $method;?>" />
		<div class="row center mb-0">
			<h5>KETERANGAN : <?= strtoupper($method);?></h5>
			<i class="fa fa-info-circle fa-5x" ></i>
			
			<h5>Apakah anda yakin ?</h5>
		</div>
		<div class="row mb-0">
			<div class="input-field col s12">
				<button id="btn-submit-keterangan" class="btn btn-submit col s12">ok</button>
			</div>
		</div>
	</div>	
</div>