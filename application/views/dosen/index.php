<div class="container">
	<div class="jumbotron">
		<h3>Welcome to halaman Dosen</h1>
		<br>
		<?php echo $this->session->flashdata('message'); ?>
		<button class="btn btn-info" data-toggle="modal" href="#post-dosen"><span class="glyphicon glyphicon-upload"></span>  Post Pengumuman</button>
	</div>	
</div>

<!-- Modal -->
			<div id="post-dosen" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			     <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Post Pemberitahuan</h4>
			      </div>
			      <div class="modal-body" style="text-align: center;">
			         <!-- start form -->
                           <?php echo form_open_multipart('dosen/post_pengumuman',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>         
                                
                                    <h3>Masukan Pemberitahuan</h3>
                                    <textarea class="form-control" name="keterangan" required></textarea>
									<br>
									<button type="submit" class="btn btn-default">Submit</button>
                            <?php echo form_close(); ?>
                        <!-- end form -->         
			      </div>
	
			    </div>

			  </div>
			</div>
            <!-- end modal -->
<script type="text/javascript">

</script>