
<div class="container">
	<div class="jumbotron">
		<ul class="nav nav-tabs">
		    <li class="active"><a href="#get-table-ppi" data-toggle="pill" class="ppi">PPI</a></li>
		    <li><a href="#get-table-ta" data-toggle="pill" class="ta">Tugas Akhir</a></li>
		</ul>
		<br>
		<div class="tab-content">
			<div class="tab-pane active" id="get-table-ppi">
				<h3>Daftar Nama Dosen Pembimbing PPI</h3>	
				<br>
				<div class="table-responsive">
							<table class="table">
							<thead>
								<tr>
									<th>Nama Dosen</th>
									<th>NIK</th>
									<th>Email</th>
									<th>Pembimbing PPI</th>
									<!-- <td>Pembimbing TA</td -->
								</tr>
							</thead>
							<tbody>
								<?php foreach ($dosen as $dsn) { 
										
										?>
									
										<tr>
											<td><?php echo $dsn['nama_dsn']; ?></td>
											<td><?php echo $dsn['nik']; ?></td>
											<td><?php echo $dsn['email']; ?></td>
											<td>
												<button class="btn btn-info view-ppi" data-id="<?php echo $dsn['nik'] ?>">View</button>
												<!-- <button class="btn btn-success add-ppi" data-id="<?php echo $dsn['id'] ?>">Add</button> -->
											</td>
								
										</tr>
									<?php } ?>
							</tbody>
						</table>
				</div>
		</div>
		<div class="tab-pane" id="get-table-ta">
				<h3>Daftar Nama Dosen Pembimbing Tugas Akhir</h3>
				<br>	
				<div class="table-responsive">
							<table class="table">
							<thead>
								<tr>
									<th>Nama Dosen</th>
									<th>NIK</th>
									<th>Email</th>
									<th>Pembimbing 1 TA</th>
									<th>Pembimbing 2 TA</th>
									<!-- <td>Pembimbing TA</td -->
								</tr>
							</thead>
							<tbody>
								<?php foreach ($dosen as $dsn) { 
										
										?>
									
										<tr>
											<td><?php echo $dsn['nama_dsn']; ?></td>
											<td><?php echo $dsn['nik']; ?></td>
											<td><?php echo $dsn['email']; ?></td>
											<td>
												<button class="btn btn-info view-pem1-ta" data-id="<?php echo $dsn['nik'] ?>">View</button>
												<!-- <button class="btn btn-success add-pem1-ta" data-id="<?php echo $dsn['id'] ?>">Add</button> -->
											</td>
											<td>
												<button class="btn btn-info view-pem2-ta" data-id="<?php echo $dsn['nik'] ?>">View</button>
												<!-- <button class="btn btn-success add-pem2-ta" data-id="<?php echo $dsn['id'] ?>">Add</button> -->
											</td>
										</tr>
									<?php } ?>
							</tbody>
						</table>
				</div>
		</div>
		</div>
	</div>
</div>

	<!-- modal view ppi -->
 	<div id="view-ppi" class="modal fade" role="dialog">
       	<div class="modal-dialog" style="width: 900px;">
        
        	<!--Modal content-->
        	<div class="modal-content">
        	    <div class="modal-header">
        	        <button type="button" class="close" data-dismiss="modal">&times;</button>
        	        <h4 class="modal-title" style="text-align: center;">Daftar Mahasiswa</h4>
        	    </div>
        	    <div class="modal-body">
        	        <div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Nama Mahasiswa</th>
										<th>NIM</th>
										<th>Kelas</th>
										<th>Nama Perusahaan</th>
										<th>Pembimbing Perusahaan</th>
										
									</tr>
								</thead>
								<tbody id="pem-ppi">
											
								</tbody>
							</table>   
			      		</div>
        	    </div>
        	    <div class="modal-footer">
        	    
        	    </div>
        	</div>
        
        </div>
    </div>  
    <!-- end modal view ppi -->


    <!-- modal view ta -->
 	<div id="view-ta" class="modal fade" role="dialog">
       	<div class="modal-dialog" style="width: 1000px; margin: auto;">
        
        	<!--Modal content-->
        	<div class="modal-content">
        	    <div class="modal-header">
        	        <button type="button" class="close" data-dismiss="modal">&times;</button>
        	        <h4 class="modal-title">Daftar Mahasiswa</h4>
        	    </div>
        	    <div class="modal-body">
        	       <div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Nama Mahasiswa</th>
										<th>NIM</th>
										<th>Kelas</th>
										<th>Judul</th>
										
									</tr>
								</thead>
								<tbody id="pem-ta">
											
								</tbody>
							</table>   
			      		</div>
        	    </div>
        	    <div class="modal-footer">
        	    
        	    </div>
        	</div>
        
        </div>
    </div>  
    <!-- end modal view ta -->

    <!-- modal view ta2 -->
 	<div id="view-ta2" class="modal fade" role="dialog">
       	<div class="modal-dialog" style="width: 1000px; margin: auto;">
        
        	<!--Modal content-->
        	<div class="modal-content">
        	    <div class="modal-header">
        	        <button type="button" class="close" data-dismiss="modal">&times;</button>
        	        <h4 class="modal-title">Daftar Mahasiswa</h4>
        	    </div>
        	    <div class="modal-body">
        	        <div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Nama Mahasiswa</th>
										<th>NIM</th>
										<th>Kelas</th>
										<th>Judul</th>
										
									</tr>
								</thead>
								<tbody id="pem-ta2">
											
								</tbody>
							</table>   
			      		</div>
        	    </div>
        	    <div class="modal-footer">
        	    
        	    </div>
        	</div>
        
        </div>
    </div>  
    <!-- end modal view ta2 -->


<script type="text/javascript">
	

	$(document).on('click','.view-ppi',function(){
			$('#pem-ppi').html('');   
			var id = $(this).attr('data-id');
			console.log(id);
            // Ajax ngeGET data berdasarkan id nya
            $.ajax({
                url : "<?php echo base_url('admin/get_pembimbing_ppi/') ?>" + id,
                type : "GET",
                /*dataType:"json",*/
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                  	console.log(res);
                  	 $.each(res, function(key, value) {
					        $('#pem-ppi').append('<tr>'+
			                    	'<td>'+value.nama_mhs+'</td>'+
			                    	'<td>'+value.nim+'</td>'+
			                    	'<td>'+value.kelas+'</td>'+
			                    	'<td>'+value.nama_magang+'</td>'+
			                    	'<td>'+value.pembimbing_magang+'</td>'+
		                    	'</tr>');

					 
					});
                    $('#view-ppi').modal('show'); // tampilin modal
  
                },
                
                error : function(jqXHR, textStatus, errorThrown)
                {
                	console.log(textStatus);
                	console.log(jqXHR);
                	console.log(errorThrown);
                    swal("Error!", "Error getting data.", "error"); // tampil sweet alert error
                }
            });
	}); //end function view pembimbing ta 2

	
	$(document).on('click','.view-pem1-ta',function(){
			$('#pem-ta').html('');
			var id=$(this).attr("data-id");
			console.log(id);
			 $.ajax({
                url : "<?php echo base_url('admin/get_pembimbing_ta1/') ?>" + id,
                type : "GET",
                /*dataType:"json",*/
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                  	console.log(res);
                  	 $.each(res, function(key, value) {
					        $('#pem-ta').append('<tr>'+
			                    		'<td>'+value.nama_mhs+'</td>'+
			                    		'<td>'+value.nim+'</td>'+
			                    		'<td>'+value.kelas+'</td>'+
			                    		'<td>'+value.judul+'</td>'+
		                    			'</tr>');
					        	
					 
					});
                    $('#view-ta').modal('show'); // tampilin modal
  
                },
                
                error : function(jqXHR, textStatus, errorThrown)
                {
                	console.log(textStatus);
                	console.log(jqXHR);
                	console.log(errorThrown);
                    swal("Error!", "Error getting data.", "error"); // tampil sweet alert error
                }
            });
	}); //end function add pembimbing ta 1

	$(document).on('click','.view-pem2-ta',function(){
			$('#pem-ta2').html('');
			var id=$(this).attr("data-id");
			console.log(id);
			 $.ajax({
                url : "<?php echo base_url('admin/get_pembimbing_ta2/') ?>" + id,
                type : "GET",
                /*dataType:"json",*/
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                  	console.log(res);
                  	 $.each(res, function(key, value) {
					        $('#pem-ta2').append('<tr>'+
			                    		'<td>'+value.nama_mhs+'</td>'+
			                    		'<td>'+value.nim+'</td>'+
			                    		'<td>'+value.kelas+'</td>'+
			                    		'<td>'+value.judul+'</td>'+
		                    			'</tr>');
					 
					});
                    $('#view-ta2').modal('show'); // tampilin modal
  
                },
                
                error : function(jqXHR, textStatus, errorThrown)
                {
                	console.log(textStatus);
                	console.log(jqXHR);
                	console.log(errorThrown);
                    swal("Error!", "Error getting data.", "error"); // tampil sweet alert error
                }
            });
	}); //end function view pembimbing ta 2

</script>