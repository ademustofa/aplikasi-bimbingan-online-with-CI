<div class="container-fluid">
	<div class="jumbotron">
	<p>Riwayat Bimbingan Laporan Mahasiswa</p>
	<br>
		<ul class="nav nav-tabs">
			    <li class="active"><a href="#get-mhs-ppi" data-toggle="pill">PPI</a></li>
			    <li><a href="#get-mhs-ta" data-toggle="pill">Tugas Akhir</a></li>
		</ul>
		<br>
		<div class="tab-content">
			<div class="tab-pane active" id="get-mhs-ppi">
				<?php if (empty($riwayat)): ?>
				<h4 style="text-align: center;"> Tidak ada Riwayat PPI yang masuk</h4>
				<?php elseif (!empty($riwayat)): ?>	
					<div class="table-responsive">
					<table class="table" id="data-search">
					<thead>
						<tr>
							<th>Tipe Doc</th>
							<th>Nama Sub</th>
							<th>Nama Dosen</th>
							<th>NIK</th>
							<th>Status Doc</th>
							<th>Keterangan</th>
							<th>Tanggal Revisi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($riwayat as $riw) { ?>
							<tr>
									<td><?php echo $riw['doc_type'] ?></td>
									<td><?php echo $riw['nama_doc'] ?></td>
									<td><?php echo $riw['nama_dsn'] ?></td>
									<td><?php echo $riw['nik'] ?></td>

									<?php if ($riw['status_sub'] == 'revisi'): ?>
									<td><span class="label label-warning">Revisi <span class="glyphicon glyphicon-remove"></span></span></td>
									<?php elseif($riw['status_sub'] == 'selesai' ): ?>
									<td><span class="label label-success">Selesai <span class="glyphicon glyphicon-ok"></span></span></td>
									<?php endif; ?>

									<td><?php echo $riw['keterangan'] ?></td>
									<td><?php echo $riw['tanggal'] ?></td>	
							</tr>		
						<?php } ?>
					</tbody>
				</table>
			</div>
				<?php endif ?>
			</div>

			<div class="tab-pane" id="get-mhs-ta">
			<?php if (empty($riwayat2)): ?>
				<h4 style="text-align: center;"> Tidak ada Riwayat Tugas Akhir yang masuk</h4>
				<?php elseif (!empty($riwayat2)): ?>	
				<div class="table-responsive">
					<table class="table" id="data-search2">
					<thead>
						<tr>
							<th>Tipe Doc</th>
							<th>Nama Sub</th>
							<th>Nama Dosen</th>
							<th>NIK</th>
							<th>Status Doc</th>
							<th>Keterangan</th>
							<th>Tanggal Revisi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($riwayat2 as $riw2) { ?>
							<tr>
									<td><?php echo $riw2['doc_type'] ?></td>
									<td><?php echo $riw2['nama_doc'] ?></td>
									<td><?php echo $riw2['nama_dsn'] ?></td>
									<td><?php echo $riw2['nik'] ?></td>

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

<script type="text/javascript">
	$(document).ready(function() {
    	$('#data-search').DataTable();
    	$('#data-search2').DataTable();
	});
</script>