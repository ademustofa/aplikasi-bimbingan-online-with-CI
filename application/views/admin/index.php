
<div class="container">
	<div class="jumbotron">
		<h3>Welcome to halaman Admin</h1>
		<br>
		<?php echo $this->session->flashdata('message'); ?>
		<button class="btn btn-info" data-toggle="modal" href="#pengumuman"><span class="glyphicon glyphicon-upload"></span>  Post Pengumuman</button>
	</div>	
</div>

<!-- Modal -->
				<div id="pengumuman" class="modal fade" role="dialog">
				  <div class="modal-dialog" style="width: 1000px;">

				    <!-- Modal content-->
				    <div class="modal-content">
				     <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title" style="text-align: center;">Post Pemberitahuan</h4>
				      </div>
				      <div class="modal-body">
				         <!-- start form -->
	                           <?php echo form_open_multipart('admin/add_pengumuman',array(
	                                'method' => 'POST',
	                                'class'  => 'form-horizontal'
	                            )); ?>         
	                                <div class="form-group">
									    <div class="col-md-10 col-md-offset-1">
									    	<label for="judul">Masukan Judul</label>
									    	<input type="text" class="form-control" name="judul">
									    </div>
									</div>
									<div class="form-group">
									    <div class="col-md-10 col-md-offset-1">
									    	<label for="pwd">Keterangan</label>
									    	<textarea class="form-control posting" name="keterangan"></textarea>
									    </div>
									</div>
									<div class="form-group">
									    <div class="col-md-10 col-md-offset-1">
									    	<button type="submit" class="btn btn-primary">Submit</button>
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

</script>