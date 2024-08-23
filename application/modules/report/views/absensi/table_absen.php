<div class="col s12">
	<div class="card-panel">
		<div class="tableResponsive">
			<table id="data-table-absen" class="striped">
				<thead>
					<tr>
						<th width="40">No.</th>
						<?php
							if(is_access() < 3){
						?>
						<th width="100">Tanggal</th>
						<th>Nama</th>
						<?php
							} else{
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
				<tbody>
					<?php
						if(is_array($listData)): 
							foreach($listData as $data):
					?>
					<tr>
						<td><?= $number++ ;?></td>
						<td><?= date('d-m-Y', strtotime($data->tanggal));?></td>
						<?php
							if(is_access() < 3){
						?>
						<td><?= $data->fullname;?></td>
						<?php
							}
						?>
						<td>
							<?php
								if($data->masuk){
							?>
							<?= date('H:i:s', strtotime($data->masuk));?>
							<?php
								}
							?>
						</td>
						<td>
							<?php
								if($data->pulang){
							?>
							<?= date('H:i:s', strtotime($data->pulang));?>
							<?php
								}
							?>
						</td>
						<td>
							<select style="display: block; height: unset;" class="select-flag" data-id="<?= $data->id; ?>"  data-url="<?= base_url();?>report/absensi/change_flag">
						      	<option value="" disabled <?= ($data->flag == null) ? "selected" : '' ?>>Pilih Keterangan</option>
						      	<option value="hadir" <?= ($data->flag == 'hadir') ? "selected" : '' ?>>Hadir</option>
						      	<option value="sakit" <?= ($data->flag == 'sakit') ? "selected" : '' ?>>Sakit</option>
						      	<option value="izin" <?= ($data->flag == 'izin') ? "selected" : '' ?>>Izin</option>
						    </select>
						</td>
						<!-- <td>
							<?php if ($data->flag == null): ?>
								<button data-id="<?= $data->id;?>" class="btn btn-floating orange tooltipped btn-change_flag" data-tooltip="Edit"><i class="fa fa-pencil"></i></button>
							<?php endif; ?>
						</td> -->
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
<script type="text/javascript">
	$('#data-table-absen').dataTable({"lengthChange": false});
</script>
