<div class="container-fluid">
	<div class="jumbotron">

		<p style="text-align: center;">Riwayat Bimbingan Dosen</p>
		<br>
		<ul class="nav nav-tabs">
			    <li class="active"><a href="#get-riwayat-ppi" data-toggle="pill">PPI</a></li>
			    <li><a href="#get-riwayat-ta" data-toggle="pill">Tugas Akhir</a></li>
		</ul>
		<br>
		<div class="tab-content">
				<div class="tab-pane active" id="get-riwayat-ppi">
				<?php if (empty($riwayat_ppi)): ?>
			      <h4 style="text-align: center;">Tidak ada Riwayat Bimbingan PPI</h4>
			    <?php elseif (!empty($riwayat_ppi)):  ?>
					<div class="table-responsive">
						<table class="table" id="data-search">
						<thead>
							<tr>
								<th>Tipe Sub</th>
								<th>Nama Sub</th>
								<th>Nama Mahasiswa</th>
								<th>NIM</th>
								<th>Kelas</th>
								<th>Status Sub</th>
								<th>Keterangan</th>
								<th>Tanggal Revisi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($riwayat_ppi as $riw1) { ?>
								<tr>
										<td><?php echo $riw1['doc_type'] ?></td>
										<td><?php echo $riw1['nama_doc'] ?></td>
										<td><?php echo $riw1['nama_mhs'] ?></td>
										<td><?php echo $riw1['nim'] ?></td>
										<td><?php echo $riw1['kelas'] ?></td>

										<?php if ($riw1['status_sub'] == 'revisi'): ?>
									 		<td><span class="label label-warning">Revisi <span class="glyphicon glyphicon-remove"></span></span></td>
									 	<?php elseif($riw1['status_sub'] == 'selesai' ): ?>
									 		<td><span class="label label-success">Selesai <span class="glyphicon glyphicon-ok"></span></span></td>
									 	<?php endif; ?>

										<td><?php echo $riw1['keterangan'] ?></td>
										<td><?php echo $riw1['tanggal'] ?></td>	
								</tr>		
							<?php } ?>
						</tbody>
					</table>
					</div>
					<?php endif ?>
				</div>
				<div class="tab-pane" id="get-riwayat-ta">
				<?php if (empty($riwayat_ta)): ?>
			      <h4 style="text-align: center;">Tidak ada Riwayat bimbingan Tugas Akhir</h4>
			    <?php elseif (!empty($riwayat_ta)):  ?>
					<div class="table-responsive">
						<table class="table" id="data-search2">
						<thead>
							<tr>
								<th>Tipe Sub</th>
								<th>Nama Sub</th>
								<th>Nama Mahasiswa</th>
								<th>NIM</th>
								<th>Kelas</th>
								<th>Status Sub</th>
								<th>Keterangan</th>
								<th>Tanggal Revisi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($riwayat_ta as $riw2) { ?>
								<tr>
										<td><?php echo $riw2['doc_type'] ?></td>
										<td><?php echo $riw2['nama_doc'] ?></td>
										<td><?php echo $riw2['nama_mhs'] ?></td>
										<td><?php echo $riw2['nim'] ?></td>
										<td><?php echo $riw2['kelas'] ?></td>
										
										<?php if ($riw2['status_sub'] == 'revisi'): ?>
									 		<td><span class="label label-warning">Revisi <span class="glyphicon glyphicon-remove"></span></span></td>
									 	<?php elseif($riw2['status_sub'] == 'selesai' ): ?>
									 		<td><span class="label label-success">Selesai <span class="glyphicon glyphicon-ok"></span></span></td>
									 	<?php endif; ?>

										<td><?php echo $riw2['keterangan'] ?></td>
										<td><?php echo $riw2['tanggal'] ?></td>	
								</tr>		
							<?php } ?>
						</tbody>
					</table>
					</div>
					<?php endif ?>
				</div>
		</div>
		

	</div>
</div>
<script>
	$(document).ready(function() {
    	$('#data-search').DataTable();
    	$('#data-search2').DataTable();
	});
</script>