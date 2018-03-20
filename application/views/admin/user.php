<div class="container">
	<div class="jumbotron">
	<?php echo $this->session->flashdata('message'); ?>
	<button class=" btn btn-info" data-toggle="modal" href="#myModal"><span class="glyphicon glyphicon-upload"></span>  Create User</button>
    <br>
    <h3>Daftar User</h3>
    <br>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#get-table-mhs" data-toggle="pill">Mahasiswa</a></li>
        <li><a href="#get-table-dsn" data-toggle="pill">Dosen</a></li>
    </ul>
    <br>
    <div class="tab-content">
        <div class="tab-pane active" id="get-table-mhs">
                <table class="table table-hover" id="data-search">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Edit Profile User</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($user_mhs as $mhs) { ?>
                        <tr>
                            <td><?php echo $mhs['username']; ?></td>
                            <td><?php echo $mhs['level']; ?></td>
                            <td><button class="btn btn-info edit_profile" data-id="<?php echo $mhs['user_id'] ?>">Edit Profile</button></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </div>
        <div class="tab-pane" id="get-table-dsn">
                <table class="table table-hover" id="data-search2">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Edit Profile User</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($user_dsn as $dsn) { ?>
                        <tr>
                            <td><?php echo $dsn['username']; ?></td>
                            <td><?php echo $dsn['level']; ?></td>
                            <td><button class="btn btn-info edit_profile_dsn" data-id="<?php echo $dsn['user_id'] ?>">Edit Profile</button></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </div>
    </div>    
			
		
	</div>
</div>

<!-- Modal -->
			<div id="myModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			     <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Form Create User</h4>
			      </div>
			      <div class="modal-body">
			         <!-- start form -->
                           <?php echo form_open_multipart('admin/tambah_user',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>

                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Username</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="username" value="">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-8">
                                        <input type="password" class="form-control" name="password" value="">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                       <label for="Pembimbing1" class="col-md-3 control-label"> Confirm Password</label>
                                       <div class="col-md-8">
                                           <input type="text" class="form-control" name="" value="">
                                           <?php echo form_error('pembimbing1'); ?>
                                       </div>
                                   </div> -->   
								
								<div class="form-group">
									<label for="sel1" class="col-md-3 control-label">Level</label>
                                     <div class="col-md-8">
                                          <select class="form-control" id="sel1" name="level">
                                            <option>Mahasiswa</option>
                                            <option>Dosen</option>
                                          </select>
                                     </div>
								</div>
                               
                                        

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-8">
                                        <button type="submit" class="btn btn-default">Submit</button> 
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                        <!-- end form -->         
			      </div>
			    </div>

			  </div>
			</div>
            <!-- end modal -->

            <!-- Modal -->
			<div id="myModal2" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			     <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Update User Profile</h4>
			      </div>
			      <div class="modal-body">
			         <!-- start form -->
                           <?php echo form_open_multipart('admin/update_profile/',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
								<input type="hidden" name="user_id" >
                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Nama</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="nama_mhs">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Nomor Induk</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="nim">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                       <label for="Pembimbing1" class="col-md-3 control-label"> Confirm Password</label>
                                       <div class="col-md-8">
                                           <input type="text" class="form-control" name="" value="">
                                           <?php echo form_error('pembimbing1'); ?>
                                       </div>
                                   </div> -->   
								
								<div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Kelas</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="kelas">
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
                        <!-- end form -->         
			      </div>
			    </div>

			  </div>
			</div>
            <!-- end modal -->

            <!-- Modal -->
            <div id="edit-dosen" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Dosen Profile</h4>
                  </div>
                  <div class="modal-body">
                     <!-- start form -->
                           <?php echo form_open_multipart('admin/update_profile_dosen/',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
                                <input type="hidden" name="user_id" >
                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Nama</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="nama_dsn">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">NIK</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="nik">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Nomor Handphone</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="no_hp">
                                        <!-- <?php echo form_error('pembimbing1'); ?> -->
                                     </div>
                                </div>   
                                
                                <div class="form-group">
                                    <label for="Pembimbing1" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="email">
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
                        <!-- end form -->         
                  </div>
                </div>

              </div>
            </div>
            <!-- end modal -->
<script type="text/javascript">
	$(document).ready(function() {
        $('#data-search').DataTable();
        $('#data-search2').DataTable();

		$(document).on('click', '.edit_profile', function(){
			var id = $(this).attr('data-id');

            // Ajax ngeGET data berdasarkan id nya
            $.ajax({
                url : "<?php echo base_url('admin/edit_profile/') ?>" + id,
                type : "GET",
                success : function(data)
                {
                	var res = $.parseJSON(data);
                   
                    console.log(res);
                    $('[name="user_id"]').val(res.user_id);
                    $('[name="nama_mhs"]').val(res.nama_mhs);
                    $('[name="nim"]').val(res.nim);
                    $('[name="kelas"]').val(res.kelas);

                    $('#myModal2').modal('show'); // tampilin modal
  
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

        $(document).on('click', '.edit_profile_dsn', function(){
            var id = $(this).attr('data-id');

            // Ajax ngeGET data berdasarkan id nya
            $.ajax({
                url : "<?php echo base_url('admin/edit_profile_dosen/') ?>" + id,
                type : "GET",
                success : function(data)
                {
                    var res = $.parseJSON(data);
                   
                    console.log(res);

                    $('[name="user_id"]').val(res.user_id);
                    $('[name="nama_dsn"]').val(res.nama_dsn);
                    $('[name="nik"]').val(res.nik);
                    $('[name="no_hp"]').val(res.no_hp);
                    $('[name="email"]').val(res.email);
                   
                    $('#edit-dosen').modal('show'); // tampilin modal
  
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