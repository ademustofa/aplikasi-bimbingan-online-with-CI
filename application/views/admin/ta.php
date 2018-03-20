<br>
<div class="container-fluid">
	<div class="jumbotron">
  <?php echo $this->session->flashdata('message'); ?>
  <br>
  <p>Catatan :</p>
  <ul>
    <li>Format excel harus berupa .xls</li>
    <li>Klik <a href="<?php echo base_url('assets/excel/data_ppi.xls'); ?>">Disini</a> untuk mendownload template data PPI</li>
    <li>Klik <a href="<?php echo base_url('assets/excel/data_tugas_akhir.xls'); ?>">Disini</a> untuk mendownload template data Tugas Akhir</li>
  </ul>
  <br><br>
    <ul class="nav nav-tabs">
            <li class="active"><a href="#get-data-ppi" data-toggle="pill">PPI</a></li>
            <li><a href="#get-data-ta" data-toggle="pill">Tugas Akhir</a></li>
    </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="get-data-ppi">
        <br>
        <button class="btn btn-success upload-csv-ppi">Upload Data PPI</button>
            <br>
            <br>
            <div class="table-responsive">          
                      <table class="table" id="data-search">
                        <thead>
                          <tr>
                            <th>NIM</th>
                            <th>Pembimbing</th>
                            <th>Nama Perusahaan</th>
                            <th>Pembimbing Perusahaan</th>
                            <th>Status PPI</th>
                            <th>Opsi</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_ppi as $ppi) {
                            /*echo "<pre>";
                            var_dump($ppi);
                            echo "</pre>";*/
                         ?>
                         <tr>
                           <td><?php echo $ppi['nim'] ?></td>
                           <td><?php echo $ppi['nama_dsn'] ?></td>
                           <td><?php echo $ppi['nama_magang'] ?></td>
                           <td><?php echo $ppi['pembimbing_magang'] ?></td>
                           <td><?php echo $ppi['status_ppi']; ?></td>
                           <td>
                           <button class="btn btn-danger del-data-ppi" data-id="<?php echo $ppi['id']; ?>">  <span class="glyphicon glyphicon-trash"></span></button>
                           <button class="btn btn-success edit-data-ppi" data-id="<?php echo $ppi['id']; ?>">  <span class="glyphicon glyphicon-edit"></span></button>
                           <button class="btn btn-primary status-ppi" data-id="<?php echo $ppi['id']; ?>">  <span class="glyphicon glyphicon-cog"></span></button>
                           </td>
                         </tr>
                           
                        <?php } ?>
                        </tbody>
                      </table>
              </div> 
        </div>
        <div class="tab-pane" id="get-data-ta">
        <br>
          <button class="btn btn-success upload-csv">Upload Data TA</button>
            <br>
            <br>
            <div class="table-responsive">          
                      <table class="table" id="data-search2">
                        <thead>
                          <tr>
                            <th>Judul Tugas Akhir</th>
                            <th>NIM</th>
                            <th>Pembimbing 1</th>
                            <th>Pembimbing 2</th>
                            <th>Status Sidang</th>
                            <th>Opsi</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data_ta as $ta) {
                            /*echo "<pre>";
                            var_dump($ta);
                            echo "</pre>";*/
                         ?>
                         <tr>
                           <td><?php echo $ta['judul']; ?></td>
                           <td><?php echo $ta['nim'] ?></td>
                           <td><?php echo $ta['pembimbing1'] ?></td>
                           <td><?php echo $ta['pembimbing2'] ?></td>
                           <td><?php echo $ta['status_sidang']; ?></td>
                           <td>
                           <button class="btn btn-danger del-data-ta" data-id="<?php echo $ta['id']; ?>"><span class="glyphicon glyphicon-trash"></span></button>
                           <button class="btn btn-success edit-data-ta" data-id="<?php echo $ta['id']; ?>"><span class="glyphicon glyphicon-edit"></span></button>
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
	


<!-- Modal -->			
        <div id="csvf" class="modal fade" role="dialog">
           	<div class="modal-dialog" >

            	<div class="modal-content">
              		<div class="modal-header">
              			<button type="button" class="close" data-dismiss="modal">&times;</button>
              			<h4 class="modal-title" style="text-align: center;">Upload Data Tugas Akhir</h4>
              		</div>
            		
            		<form method="post" action="<?php echo base_url("admin/import_excel");?>" enctype="multipart/form-data">
					
      					<div class="modal-body">							
      						  <div class="form-group">
      	                 <label for="lastname" class="col-md-3 control-label">Submission</label>
      	                 <div class="col-md-8 col-md-offset-3">
      	                     <input type="file" name="userfile">
                          </div>
                    </div>
      					</div>
    					<br><br><br>
    					<div class="modal-footer">
    						<input class="btn btn-success " type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
    					</div>						
    				</form>
					
            </div>				
            </div>
        </div>
      <!-- end modal -->

      <div id="csvf-ppi" class="modal fade" role="dialog">
         <div class="modal-dialog" >

            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="text-align: center;">Upload Data PPI</h4>
                </div>
                
                <form method="post" action="<?php echo base_url("admin/import_excel_ppi");?>" enctype="multipart/form-data">
          
                <div class="modal-body">              
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Submission</label>
                        <div class="col-md-8 col-md-offset-3">
                            <input type="file" name="userfile">
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="modal-footer">
                  <input class="btn btn-success " type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT"> 
                </div>           
              </form>
              
            </div>        
        </div>
      </div>
      <!-- end modal -->

      <div id="edit-ppi" class="modal fade" role="dialog">
         <div class="modal-dialog" style="width: 900px;">

            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="text-align: center;">Edit data PPi</h4>
                </div>
          
                <div class="modal-body">              
                    <?php echo form_open_multipart('admin/update_data_ppi',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
                    <input type="hidden" name="id" >
                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Pembimbing</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="sel1" name="pembimbing">
                                           <?php foreach ($options as $dosen) { ?>
                                               <option value="<?php echo $dosen['nik'] ?>"><?php echo $dosen['nama_dsn'] ?></option>
                                           <?php } ?>
                                          </select>
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                     </div>
                                </div>

                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Nama Perusahaan</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="nama_magang">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>   
                                
                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Pembimbing Perusahaan</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="pembimbing_magang">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>


                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-8">
                                        <button type="submit" class="btn btn-default">Submit</button> 
                                    </div>
                                </div>
                  <?php echo form_close(); ?>
                </div>
              
            </div>        
        </div>
      </div>
      <!-- end modal -->

      <div id="edit-ta" class="modal fade" role="dialog">
         <div class="modal-dialog" style="width: 1000px">

            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="text-align: center;">Edit Data TA</h4>
                </div>
          
                <div class="modal-body">              
                  <?php echo form_open_multipart('admin/update_data_ta',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
                    <input type="hidden" name="id" >
                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-1 control-label">Judul</label>
                                    <div class="col-md-11">
                                        <input type="text" class="form-control" name="judul">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-2 control-label">Pembimbing1</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="sel1" name="pembimbing1">
                                           <?php foreach ($options as $dosen) { ?>
                                               <option value="<?php echo $dosen['nik'] ?>"><?php echo $dosen['nama_dsn'] ?></option>
                                           <?php } ?>
                                          </select>
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                     </div>
                                </div>   
                                
                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-2 control-label">Pembimbing2</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="sel1" name="pembimbing2">
                                           <?php foreach ($options as $dosen) { ?>
                                               <option value="<?php echo $dosen['nik'] ?>"><?php echo $dosen['nama_dsn'] ?></option>
                                           <?php } ?>
                                          </select>
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>


                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-8">
                                        <button type="submit" class="btn btn-default">Submit</button> 
                                    </div>
                                </div>
                  <?php echo form_close(); ?>
                </div>
              
            </div>        
        </div>
      </div>
      <!-- end modal -->
					

<script type="text/javascript">
  
  $(document).ready(function() {
        $('#data-search').DataTable();
        $('#data-search2').DataTable();
  });

	$(document).on('click', '.upload-csv', function(){ 
		$('#csvf').modal('show')
	});

  $(document).on('click', '.upload-csv-ppi', function(){ 
    $('#csvf-ppi').modal('show')
  });

  $(document).on('click', '.edit-data-ppi', function(){ 
    var id=$(this).attr("data-id");
    console.log(id);
    $.ajax({
                url : "<?php echo base_url('admin/edit_data_ppi/') ?>" + id,
                type : "GET",
                success : function(data)
                {
                  var res = $.parseJSON(data);
                   
                    console.log(res);
                    $('[name="id"]').val(res.id);
                    $('[name="nama_magang"]').val(res.nama_magang);
                    $('[name="pembimbing_magang"]').val(res.pembimbing_magang);

                    $('#edit-ppi').modal('show') // tampilin modal
  
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

  $(document).on('click', '.edit-data-ta', function(){ 
    var id=$(this).attr("data-id");
    console.log(id);

            $.ajax({
                url : "<?php echo base_url('admin/edit_data_ta/') ?>" + id,
                type : "GET",
                success : function(data)
                {
                  var res = $.parseJSON(data);
                   
                    console.log(res);
                    $('[name="id"]').val(res.id);
                    $('[name="judul"]').val(res.judul);

                    $('#edit-ta').modal('show') // tampilin modal
  
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

  $(document).on('click', '.del-data-ppi', function () {
    var id=$(this).attr("data-id");
    console.log(id);

      swal({
        title: 'Apakah anda yakin?',
        text: 'You won\'t be able to revert this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })
      .then(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/delete_data_ppi'); ?>',
            data:{id:id},
      })
        swal('Deleted!', 'Data PPI berhasil Dihapus', 'success')
        setTimeout(function() {
            location.reload();
          }, 1500)
      })
    })

  $(document).on('click', '.del-data-ta', function () {
    var id=$(this).attr("data-id");
    console.log(id);

      swal({
        title: 'Apakah anda yakin?',
        text: 'You won\'t be able to revert this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })
      .then(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/delete_data_ta'); ?>',
            data:{id:id},
      })
        swal('Deleted!', 'Data TA ebrhasil Dihapus', 'success')
        setTimeout(function() {
            location.reload();
          }, 1500)
      })
    })

    $(document).on('click', '.status-ppi', function () {
    var id=$(this).attr("data-id");
    var status_ppi = 'selesai';
    console.log(id);
    console.log(status_ppi);

      swal({
        title: 'Apakah anda yakin?',
        text: 'Status PPI akan dirubah menjadi Selesai',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      })
      .then(function () {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/ubah_status_data_ppi'); ?>',
            data:{
              id:id,
              status_ppi:status_ppi
            },
      })
        swal('Ubah Status berhasil!', 'Status PPI menjadi Selesai', 'success')
        console.log(id);
        console.log(status_ppi);
        setTimeout(function() {
            location.reload();
          }, 1500)
      })
    })

</script>		