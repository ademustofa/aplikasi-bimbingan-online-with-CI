
<div class="container-fluid">
	<div class="jumbotron">
	<ul>
		<li>
		Klik <button class="btn btn-info show-bimbingan-ta1" data-id="">Disini</button> untuk melihat Daftar Mahasiswa yang dibimbing sebegai pembimbing 1 
		</li>
		&nbsp
		<li>
		Klik <button class="btn btn-info show-bimbingan-ta2" data-id="">Disini</button> untuk melihat Daftar Mahasiswa yang dibimbing sebegai pembimbing 2 
		</li>
	</ul>
	<br>
	
    <?php echo $this->session->flashdata('message'); ?>
    <hr>
    <?php if (empty($docs_ta)): ?>
    	<h3 style="text-align: center;">Tak ada File Tugas Akhir yang diupload</h3>
	<?php elseif (!empty($docs_ta)):  ?>
		<h3 style="text-align: center;">Daftar Laporan Tugas Akhir Mahasiswa</h3>
	    <br>
		<div class="table-responsive">
			<table class="table" id="ta">
			<thead>
				<tr>
					<th>Nama Mhs</th>
					<th>NIM</th>
					<th>Kelas</th>
					<th>Nama Sub</th>
					<th>Submission</th>
					<th>Tanggal Upload</th>
					<th>Tanggal Update</th>
					<th>Status1</th>
					<th>Status2</th>
					<th>Ubah Status</th>
					<th>Upload Revisi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($docs_ta as $doc) { ?>
				<tr>
					<td><?php echo $doc['nama_mhs'] ?></td>
					<td><?php echo $doc['nim'] ?></td>
					<td><?php echo $doc['kelas'] ?></td>
					<td><?php echo $doc['nama_doc'] ?></td>
					<td><a href="<?php echo base_url('assets/pdfjs/web/uploads/'.$doc['submission']); ?>" class="btn btn-info" target="_blank">Download</a></td>
					<td><?php echo $doc['create_at'] ?></td>
					<td><?php echo $doc['update_at'] ?></td>
					
					<?php if ($doc['status1'] == 'draft'): ?>
				 		<td><span class="label label-default">Draft</span></td>
				 	<?php elseif($doc['status1'] == 'revisi' ): ?>
				 		<td><span class="label label-warning">Revisi</span></td>
				 	<?php elseif($doc['status1'] == 'selesai' ): ?>
				 		<td><span class="label label-success">Selesai</span></td>
				 	<?php endif; ?>

				 	<?php if ($doc['status2'] == 'draft'): ?>
				 		<td><span class="label label-default">Draft</span></td>
				 	<?php elseif($doc['status2'] == 'revisi' ): ?>
				 		<td><span class="label label-warning">Revisi</span></td>
				 	<?php elseif($doc['status2'] == 'selesai' ): ?>
				 		<td><span class="label label-success">Selesai</span></td>
				 	<?php endif; ?>

					<td><button class="btn btn-info ubah_status" data-id="<?php echo $doc['id']; ?>">Ubah Status</button></td>
					<td><button class="btn btn-info upload-revisi" data-id="<?php echo $doc['id']; ?>">Upload</button></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		</div>
		<?php endif ?>
	</div>
</div>

     <div id="modal-status" class="modal fade" role="dialog">
        	  <div class="modal-dialog">
        
        	    <!--Modal content-->
        	    <div class="modal-content">
        	      <div class="modal-header">
        	        <button type="button" class="close" data-dismiss="modal">&times;</button>
        	        <h4 class="modal-title">Ubah Status</h4>
        	      </div>
        	      <div class="modal-body" style="text-align: center;">
        	      	<h3>Masukkan Keterangan Anda</h3>
        	      	<textarea class="form-control ta" name="keterangan" required></textarea>        
        	      </div>
        	      <div class="modal-footer">
        	      	<button type="button" class="btn btn-default revisi" data-id="">Revisi</button>
        	      	<button type="button" class="btn btn-default selesai" data-id="">Selesai</button>
        	    
        	      </div>
        	    </div>
        
        	  </div>
        	</div>  

    <div id="pembimbing-ta1" class="modal fade" role="dialog">
        	  <div class="modal-dialog" style="width: 1200px;">
        
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
										<th>Judul TA</th>
										<th>Status Sidang</th>
										<th>Ubah Status Sidang</th>
									</tr>
								</thead>
								<tbody id="bim-ta1">
											
								</tbody>
							</table>   
			      		</div>
        	      </div>
        	    </div>
        
        	</div>
    </div>

    <div id="pembimbing-ta2" class="modal fade" role="dialog">
        	  <div class="modal-dialog">
        
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
										<th>Judul TA</th>
									</tr>
								</thead>
								<tbody id="bim-ta2">
											
								</tbody>
							</table>   
			      		</div>
        	      </div>
        	    </div>
        
        	</div>
    </div> 


    <div id="revisi-sub" class="modal fade" role="dialog">
            <div class="modal-dialog">
        
              <!--Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="text-align: center;">Upload File Revisi</h4>
                </div>
                <div class="modal-body">
                <?php echo form_open_multipart('dosen/revisi_sub/',array(
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
$(function(){
	$('#ta').DataTable();

	$(document).on('click','.ubah_status',function(){
		var id=$(this).attr("data-id");
		console.log(id);
		$('#modal-status').modal('show');
		$('.revisi').attr('data-id', id);
		$('.selesai').attr('data-id', id);
	});

	$('#modal-status').on('hidden.bs.modal', function () {
		    $('.revisi').attr("data-id", "");
		    $('.selesai').attr("data-id", "");
	});

	$('.revisi').on('click', function(){
		var id = $(this).attr("data-id");
		var keterangan = $(this).parent().prev().find("textarea").val();
		var stts_revisi = 'revisi';
		console.log(id);
		console.log(stts_revisi);
		console.log(keterangan);
		swal({
				title:'Status Revisi',
				text: 'Apakah anda yakin akan merubah Status ke Revisi?',
				type: 'warning',
				  showCancelButton: true,
			      confirmButtonColor: '#3085d6',
			      cancelButtonColor: '#d33',
			      confirmButtonText: 'Yes, Revisi!'
			}) 
			.then(function () {
				$.ajax({
					type: "POST",
					url:"<?php echo base_url('dosen/ubah_status'); ?>",
					data: {
						id:id,
						keterangan:keterangan,
	    				status:stts_revisi
					},
				})
				swal('Revisi!', 'Status laporan telah diubah!', 'success')
				    $(".modal").modal('hide');
				    setTimeout(function() {
						location.reload();
					}, 2000)
			})	
			
	});
	
	$('.selesai').on('click', function(){
		var id = $(this).attr("data-id");
		var keterangan = $(this).parent().prev().find("textarea").val();
		var stts_selesai = 'selesai';
		console.log(id);
		console.log(stts_selesai);
		console.log(keterangan);
		swal({
				title: 'Status Selesai',
				text:  'Apakah anda yakin akan merubah Status ke Selesai?',
				type: 'warning',
				  showCancelButton: true,
			      confirmButtonColor: '#3085d6',
			      cancelButtonColor: '#d33',
			      confirmButtonText: 'Yes, Selesai!'
			})
			.then(function () {
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('dosen/ubah_status'); ?>",
						data: {
							id:id,
							keterangan:keterangan,
	    					status:stts_selesai
						},
					}) 
				    swal('Selesai!', 'Status laporan telah diubah!', 'success')
				    	$(".modal").modal('hide');
				    	setTimeout(function() {
							location.reload();
						}, 2000)
				    	
			})
		
	});

	$(document).on('click', '.show-bimbingan-ta1', function(){ 
			$('#bim-ta1').html('');
			console.log('tampilkan modal');
            // Ajax ngeGET data berdasarkan id nya
            $.ajax({
                url : "<?php echo base_url('dosen/get_bimbingan_mhs_ta1') ?>",
                type : "GET",
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                  	console.log(res);
                    $.each(res, function(key, value) {

					        $('#bim-ta1').append('<tr>'+
			                    					'<td>'+value.nama_mhs+'</td>'+
			                    					'<td>'+value.nim+'</td>'+
			                    					'<td>'+value.kelas+'</td>'+
			                    					'<td>'+value.judul+'</td>'+
			                    					'<td>'+value.status_sidang+'</td>'+
			                    					'<td><button class="btn btn-primary status-ta" data-id="'+value.id+'">  <span class="glyphicon glyphicon-cog"></span> Ubah Status</button></td>'+
		                    					'</tr>');
					});

                   
                    $('#pembimbing-ta1').modal('show'); // tampilin modal
  
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

	$(document).on('click', '.show-bimbingan-ta2', function(){ 
			$('#bim-ta2').html('');
			console.log('tampilkan modal');
            // Ajax ngeGET data berdasarkan id nya
            $.ajax({
                url : "<?php echo base_url('dosen/get_bimbingan_mhs_ta2') ?>",
                type : "GET",
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                  	console.log(res);
                    $.each(res, function(key, value) {

					        $('#bim-ta2').append('<tr>'+
			                    					'<td>'+value.nama_mhs+'</td>'+
			                    					'<td>'+value.nim+'</td>'+
			                    					'<td>'+value.kelas+'</td>'+
			                    					'<td>'+value.judul+'</td>'+
		                    					'</tr>');
					});

                   
                    $('#pembimbing-ta2').modal('show'); // tampilin modal
  
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


	$(document).on('click','.upload-revisi',function(){
      var id=$(this).attr("data-id");
      console.log(id);

      $.ajax({
                url : "<?php echo base_url('dosen/upload_revisi/') ?>" + id,
                type : "GET",
                success : function(data)
                {
                  var res = $.parseJSON(data);
                   
                    console.log(res);
                    $('[name="id"]').val(res.id);
                   
                    $('#revisi-sub').modal('show'); // tampilin modal
  
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

    $(document).on('click', '.status-ta', function () {
    var id=$(this).attr("data-id");
    var status_ta = 'siap sidang';
    console.log(id);
    console.log(status_ta);

      swal({
        title: 'Apakah anda yakin?',
        text: 'Status TA akan dirubah menjadi Siap Sidang',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      })
      .then(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('dosen/ubah_status_data_ta'); ?>',
            data:{
              id:id,
              status_ta:status_ta
            },
      })
        swal('Ubah Status berhasil!', 'Status TA menjadi Siap Sidang', 'success')
        console.log(id);
        console.log(status_ta);
        setTimeout(function() {
            location.reload();
          }, 1500)
      })
    })

});	
</script>         