
<div class="container-fluid">
	<div class="jumbotron">
	<ul>
	<li>Klik <button class="btn btn-info show-bimbingan" data-id="">disini</button> untuk melihat daftar Mahasiswa yang dibimmbing</li>
	</ul>
	<br>
		<hr>
		<?php if (empty($docs_ppi)): ?>
			<h3 style="text-align: center;">Tak ada File Tugas Akhir yang diupload</h3>
		<?php elseif (!empty($docs_ppi)):  ?>
			<h3 style="text-align: center;">Daftar Laporan PPI Mahasiswa</h3>
			<br>
		<div class="table-responsive">
			<table class="table" id="ppi">
			<thead>
				<tr>
					<th>Nama Mahasiswa</th>
					<th>NIM</th>
					<th>Kelas</th>
					<th>Nama Sub</th>
					<th>Submission</th>
					<th>Tanggal Upload</th>
					<th>Tanggal Update</th>
					<th>Status Sub</th>
					<th>Ubah Status</th>
					<th>Upload Revisi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($docs_ppi as $doc) { ?>
				
				<tr>
					<td><?php echo $doc['nama_mhs'] ?></td>
					<td><?php echo $doc['nim'] ?></td>
					<td><?php echo $doc['kelas'] ?></td>
					<td><?php echo $doc['nama_doc'] ?></td>
					<td><a href="<?php echo base_url('assets/pdfjs/web/uploads/'.$doc['submission']); ?>" class="btn btn-default" target="_blank">Download</a></td>
					<td><?php echo $doc['create_at'] ?></td>
					<td><?php echo $doc['update_at'] ?></td>
					
					<?php if ($doc['status_doc'] == 'draft'): ?>
				 		<td><span class="label label-default">Draft</span></td>
				 	<?php elseif($doc['status_doc'] == 'revisi' ): ?>
				 		<td><span class="label label-warning">Revisi</span></td>
				 	<?php elseif($doc['status_doc'] == 'selesai' ): ?>
				 		<td><span class="label label-success">Selesai</span></td>
				 	<?php endif; ?>

					<td><button class="btn btn-primary ubah_status1" data-id="<?php echo $doc['id']; ?>">Ubah Status</button></td>
					<td><button class="btn btn-info upload-revisi-ppi" data-id="<?php echo $doc['id']; ?>">Upload</button></td>
					
				</tr>
				
			<?php } ?>
			</tbody>
		</table>
		</div>
		<?php endif ?>	
	</div>
</div>


	<div id="modal-status1" class="modal fade" role="dialog">
        	  <div class="modal-dialog">
        
        	    <!--Modal content-->
        	    <div class="modal-content">
        	      <div class="modal-header">
        	        <button type="button" class="close" data-dismiss="modal">&times;</button>
        	        <h4 class="modal-title">Ubah Status</h4>
        	      </div>
        	      <div class="modal-body" style="text-align: center;">
        	      	<h3>Masukkan Keterangan Anda</h3>
        	      	<textarea class="form-control ppi" name="keterangan" required></textarea>        
        	      </div>
        	      <div class="modal-footer">
        	      	<button type="button" class="btn btn-default revisi" data-id="">Revisi</button>
        	      	<button type="button" class="btn btn-default selesai" data-id="">Selesai</button>
        	    
        	      </div>
        	    </div>
        
        	  </div>
        	</div>

    <div id="pembimbing-ppi" class="modal fade" role="dialog">
        	  <div class="modal-dialog" style="width: 800px;">
        
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
										<th>Tempat Magang</th>
									</tr>
								</thead>
								<tbody id="bim-ppi">
											
								</tbody>
							</table>   
			      		</div>
        	      </div>
        	    </div>
        
        	</div>
    </div>


	<div id="revisi-ppi" class="modal fade" role="dialog">
            <div class="modal-dialog">
        
              <!--Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="text-align: center;">Upload File Revisi</h4>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('dosen/revisi_ppi/',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
                    <input type="hidden" name="id" >
                    <div class="form-group">
                      <label for="lastname" class="col-md-3 control-label">Submission</label>
                      <div class="col-md-8 col-md-offset-3">
                        <input type="file" name="userfile">
                      </div>
                    </div>

                    <div class="form-group">                            
                        <div class="col-md-8 col-md-offset-3">
                          <button type="submit" class="btn btn-default">Submit</button> 
                        </div>
                    </div>
                <?php echo form_close(); ?>       
                </div>
                <div class="modal-footer">
              
                </div>
              </div>
        
            </div>
          </div> 
<script type="text/javascript">

$(document).ready(function(){
		$('#ppi').DataTable();
	});
$(function(){


	$(document).on('click','.ubah_status1',function(){
		var id=$(this).attr("data-id");
		console.log(id);
		$('#modal-status1').modal('show');
		$('.revisi').attr('data-id', id);
		$('.selesai').attr('data-id', id);
	});


	$(document).on('click','.revisi',function(){
		var id = $(this).attr("data-id");
		var keterangan = $(this).parent().prev().find("textarea").val();
		var status_doc = 'revisi';
		console.log(id);
		console.log(status_doc);
		console.log(keterangan);
		swal({
				title:"Status Revisi",
				text:"Apakah anda yakin akan merubah Status ke Revisi?",
				type: "warning",
				showCancelButton: true,
			      confirmButtonColor: '#3085d6',
			      cancelButtonColor: '#d33',
			      confirmButtonText: 'Yes, Revisi!'
			}) 
			.then(function () {
				$.ajax({
					type: "POST",
					url:"<?php echo base_url('dosen/ubah_status_ppi'); ?>",
					data: {
						id:id,
						keterangan:keterangan,
	    				status:status_doc
					},
				})
				swal('Revisi!', 'Status laporan telah diubah!', 'success')
					
				    console.log(id);
					console.log(status_doc);
					console.log(keterangan);
				    $(".modal").modal('hide');
				    setTimeout(function() {
							location.reload();
					}, 2000)
			})
	});
	
	$(document).on('click','.selesai',function(){
		var id = $(this).attr("data-id");
		var keterangan = $(this).parent().prev().find("textarea").val();
		var status_doc = 'selesai';
		console.log(id);
		console.log(status_doc);
		console.log(keterangan);
		swal({
				title:"Status Selesai",
				text:"Apakah anda yakin akan merubah Status ke Selesai?",
				type: "warning",
				showCancelButton: true,
			      confirmButtonColor: '#3085d6',
			      cancelButtonColor: '#d33',
			      confirmButtonText: 'Yes, Selesai!'
			})
			.then(function () {
				$.ajax({
					type: "POST",
					url:"<?php echo base_url('dosen/ubah_status_ppi'); ?>",
					data: {
						id:id,
						keterangan:keterangan,
	    				status:status_doc
					},
				})
				swal('Selesai!', 'Status laporan telah diubah!', 'success')
					
				    console.log(id);
					console.log(status_doc);
					console.log(keterangan);
				    $(".modal").modal('hide');
				    setTimeout(function() {
						location.reload();
					}, 2000)
			})
	});

	$(document).on('click', '.show-bimbingan', function(){ 
			$('#bim-ppi').html('');
			console.log('tampilkan modal');
            
            $.ajax({
                url : "<?php echo base_url('dosen/get_bimbingan_mhs_ppi') ?>",
                type : "GET",
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                  	console.log(res);
                    $.each(res, function(key, value) {

					        $('#bim-ppi').append('<tr>'+
			                    					'<td>'+value.nama_mhs+'</td>'+
			                    					'<td>'+value.nim+'</td>'+
			                    					'<td>'+value.kelas+'</td>'+
			                    					'<td>'+value.nama_magang+'</td>'+
		                    					'</tr>');
					});

                   
                    $('#pembimbing-ppi').modal('show'); // tampilin modal
  
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

	$(document).on('click','.upload-revisi-ppi',function(){
      var id = $(this).attr("data-id");
      console.log(id);

      $.ajax({
                url : "<?php echo base_url('dosen/upload_revisi_ppi/') ?>" + id,
                type : "GET",
                success : function(data)
                {
                  var res = $.parseJSON(data);
                   
                    console.log(res);
                    $('[name="id"]').val(res.id);
                   
                    $('#revisi-ppi').modal('show'); // tampilin modal
  
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