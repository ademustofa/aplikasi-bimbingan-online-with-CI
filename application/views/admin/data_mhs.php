<div class="container">
	<div class="jumbotron">
		<p>Data Laporan Mahasiswa</p>
		<ul class="nav nav-tabs">
		    <li class="active"><a href="#get-table-ppi" data-toggle="pill" class="ppi">PPI</a></li>
		    <li><a href="#get-table-ta" data-toggle="pill" class="ta">Tugas Akhir</a></li>
		</ul>
		<br>
		<div class="tab-content">
			<div class="tab-pane active" id="get-table-ppi">
			<div class="table-responsive">
			<table class="table" id="data-search">
			<thead>
				<tr>
					<th>Nama Mahasiswa</th>
					<th>NIM</th>
					<th>Kelas</th>
					<th>Jurusan</th>
					<th>Lihat Laporan PPI</th>
					
				</tr>
			</thead>
			<tbody>
				<?php foreach ($mahasiswa as $mhs) { 
						
						?>
					
						<tr>
							<td><?php echo $mhs['nama_mhs']; ?></td>
							<td><?php echo $mhs['nim']; ?></td>
							<td><?php echo $mhs['kelas']; ?></td>
							<td><?php echo $mhs['jurusan']; ?></td>
							<td><button class="btn btn-info get-ppi" data-id="<?php echo $mhs['id'] ?>">View</button></td>
							<!-- <td><button class="btn btn-info get-ta" data-id="<?php echo $mhs['id'] ?>">View</button></td> -->
						</tr>
					<?php } ?>
			</tbody>
		</table>
		</div>
			</div>
			<div class="tab-pane" id="get-table-ta">
				<div class="table-responsive">
			<table class="table" id="data-search2">
			<thead>
				<tr>
					<th>Nama Mahasiswa</th>
					<th>NIM</th>
					<th>Kelas</th>
					<th>Jurusan</th>
					<th>Lihat Laporan TA</th>
					
				</tr>
			</thead>
			<tbody>
				<?php foreach ($mahasiswa as $mhs) { 
						
						?>
					
						<tr>
							<td><?php echo $mhs['nama_mhs']; ?></td>
							<td><?php echo $mhs['nim']; ?></td>
							<td><?php echo $mhs['kelas']; ?></td>
							<td><?php echo $mhs['jurusan']; ?></td>
							<!-- <td><button class="btn btn-info get-ppi" data-id="<?php echo $mhs['id'] ?>">View</button></td> -->
							<td><button class="btn btn-info get-ta" data-id="<?php echo $mhs['id'] ?>">View</button></td>
						</tr>
					<?php } ?>
			</tbody>
		</table>
		</div>
			</div>
		</div>	
		
	</div>
</div>

<!-- Modal -->
		<div id="modal-ppi" class="modal fade" role="dialog">
			<div class="modal-dialog" style="width: 800px; margin: auto;">

			    <!-- Modal content-->
			    <div class="modal-content">
				    <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title" style="text-align: center;">Laporan PPI yang telah diupoad</h4>
				    </div>
			      	<div class="modal-body">
			            <div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Nama Laporan</th>
										<th>Submission</th>
										<th>Pembimbing</th>
										<th>Status Laporan</th>
										
									</tr>
								</thead>
								<tbody id="ppi">
											
								</tbody>
							</table>   
			      		</div>
			    	</div>
				</div>
			</div>
		</div>
            <!-- end modal -->

<!-- Modal -->			
            		<div id="modal-ta" class="modal fade" role="dialog">
            			<div class="modal-dialog" style="width: 800px; margin: auto;">
            		
            			    Modal content
            			    <div class="modal-content">
            				    <div class="modal-header">
            				        <button type="button" class="close" data-dismiss="modal">&times;</button>
            				        <h4 class="modal-title" style="text-align: center;">Laporan TA yang telah diupoad</h4>
            			      	</div>
            			      	<div class="modal-body">
            			            <div class="table-responsive">
            							<table class="table">
            								<thead>
            									<tr>
            										<th>Nama Laporan</th>
            										<th>Submission</th>
            										<th>Pembimbing 1</th>
            										<th>Pembimbing 2</th>
            										<th>Status1</th>
            										<th>Status2</th>
            									
            									</tr>
            								</thead>
            								<tbody id="ta">
            									
            		
         
            								</tbody>
            							</table>   
            			      		</div>
            			    	</div>
            				</div>
            				<!-- end Modal content -->	
            			</div>
            		</div>
           <!-- end modal -->            
<script type="text/javascript">
$(document).ready(function() {

    	$('#data-search').DataTable();
    	$('#data-search2').DataTable();

		$(document).on('click', '.get-ppi', function(){ 
			$('#ppi').html('');  
			var id = $(this).attr('data-id');
            // Ajax ngeGET data berdasarkan id nya
            $.ajax({
                url : "<?php echo base_url('admin/get_doc_mhs_ppi/') ?>" + id,
                type : "GET",
                /*dataType:"json",*/
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                  	console.log(res);
                    $.each(res, function(key, value) {

					        $('#ppi').append('<tr>'+
			                    					'<td>'+value.nama_doc+'</td>'+
			                    					'<td>'+value.submission+'</td>'+
			                    					'<td>'+value.nama_dsn+'</td>'+
			                    					'<td>'+value.status_doc+'</td>'+
		                    				'</tr>');
					});

                   
                    $('#modal-ppi').modal('show'); // tampilin modal
  
                },
                error : function(jqXHR, textStatus, errorThrown)
                {
                	console.log(textStatus);
                	console.log(jqXHR);
                	console.log(errorThrown);
                    swal("Error!", "Error getting data.", "error"); // tampil sweet alert error
                }
            });
		});

		$(document).on('click', '.get-ta', function(){
			$('#ta').html('');   
			var id = $(this).attr('data-id');
            // Ajax ngeGET data berdasarkan id nya
            $.ajax({
                url : "<?php echo base_url('admin/get_doc_mhs_ta/') ?>" + id,
                type : "GET",
                /*dataType:"json",*/
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                  	console.log(res);
                  	 $.each(res, function(key, value) {
					        $('#ta').append('<tr>'+
			                    					'<td>'+value.nama_doc+'</td>'+
			                    					'<td>'+value.submission+'</td>'+
			                    					'<td>'+value.pembimbing1+'</td>'+
			                    					'<td>'+value.pembimbing2+'</td>'+
			                    					'<td>'+value.status1+'</td>'+
			                    					'<td>'+value.status2+'</td>'+
		                    					'</tr>');
					 
					});
                    $('#modal-ta').modal('show'); // tampilin modal
  
                },
                
                error : function(jqXHR, textStatus, errorThrown)
                {
                	console.log(textStatus);
                	console.log(jqXHR);
                	console.log(errorThrown);
                    swal("Error!", "Error getting data.", "error"); // tampil sweet alert error
                }
            });
		});
        
	});
</script>