<div class="col s12">
	<div class="card-panel">
		<div class="tableResponsive">
			<table id="data-table-mingguan" class="striped">
				<thead>
					<tr>
						<th width="40">No.</th>
						<?php
							if(is_access() < 3){
						?>
						<th width="200">Tanggal</th>
						<th>Nama</th>
						<?php
							} else{
						?>
						<th>Tanggal</th>
						<?php
							}
						?>
						<th width="100" class="right-align">Kehadiran</th>
						<th width="100" class="right-align">Jumlah</th> 
					</tr>
				</thead>
				<tbody>
					<?php
						if(is_array($listData)): 
							foreach($listData as $data):
					?>
					<tr>
						<td><?= $number++ ;?></td>
						<td>
							<?= date('d-m-Y', strtotime($data->created_date .'-7 day'));?>
							s/d
							<?= date('d-m-Y', strtotime($data->created_date .'-1 day'));?>
						</td>
						<?php
							if(is_access() < 3){
						?>
						<td><?= $data->fullname;?></td>
						<?php
							}
						?>
						<td class="right-align"><?= number_format($data->kehadiran);?></td>
						<td class="right-align"><?= number_format($data->jumlah);?></td>
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
	$('#data-table-mingguan').dataTable({"lengthChange": false});
</script>
