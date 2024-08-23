<div class="modal-content">
	<h5 class="center"><?= strtoupper($user->fullname);?></h5>
	<hr>
	<div id="form-edit-flag" data-href="<?= base_url();?>kehadiran" data-url="<?= base_url();?>kehadiran/submit_edit_flag">
		<input type="hidden" id="id" value="<?= $id;?>" />
		<div class="row center mb-0">
			<div class="input-field col s12">
				<select id="edit-flag" class="browser-default">
					<?php
						if($flag == 'sakit'){
					?>
					<option value="sakit">SAKIT</option>
					<option value="izin">IZIN</option>
					<option value="alpha">ALPHA</option> 
					<option value="hadir">HADIR</option>
					<?php
						} elseif($flag == 'izin'){
					?>
					<option value="izin">IZIN</option>
					<option value="sakit">SAKIT</option>
					<option value="alpha">ALPHA</option>
					<option value="hadir">HADIR</option>
					<?php
						} elseif($flag == 'alpha'){
					?>
					<option value="alpha">ALPHA</option>
					<option value="sakit">SAKIT</option>
					<option value="izin">IZIN</option>
					<option value="hadir">HADIR</option>
					<?php
						} elseif($flag == 'hadir'){
					?>
					<option value="hadir">HADIR</option>
					<option value="sakit">SAKIT</option>
					<option value="izin">IZIN</option>
					<option value="alpha">ALPHA</option>
					<?php
						}
					?>
				</select>
				<label for="edit-flag" class="active">Keterangan Absen</label>
			</div>
		</div>
		<div class="row mb-0">
			<div class="input-field col s12">
				<button id="btn-edit-flag" class="btn btn-submit col s12">ok</button>
			</div>
		</div>
	</div>	
</div>