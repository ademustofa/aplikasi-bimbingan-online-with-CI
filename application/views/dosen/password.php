<?php echo $user_id; ?>
<div class="container">
	<div class="jumbotron">
	<?php echo $this->session->flashdata('message'); ?>
		<h3 style="text-align: center; font-weight: bold;">Ganti Password</h3>
		<br>	
		<?php echo form_open_multipart('dosen/change_password',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
	
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="Pass-lama">Password Lama</label>
			    <div class="col-sm-4">
					<input type="password" class="form-control" name="password" placeholder="Masukan Password Lama">
			    </div>
			    <div class="col-sm-4">
			    	<?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>
			    </div>
			  </div>

			  <div class="form-group">
			    <label class="control-label col-sm-2" for="New Password">Password Baru</label>
			    <div class="col-sm-4">
					<input type="password" class="form-control" name="newpass" placeholder="Masukan Password Baru">
			    </div>
			    <div class="col-sm-4">
			    	<?php echo form_error('newpass', '<div class="alert alert-danger">', '</div>'); ?>
			    </div>
			  </div>

			  <div class="form-group">
			    <label class="control-label col-sm-2" for="Confirm Password">Confirm Password</label>
			    <div class="col-sm-4">
					<input type="password" class="form-control" name="confirmpass" placeholder="Konfirmasi Password Baru">
			    </div>
			    <div class="col-sm-4">
			    	<?php echo form_error('confirmpass', '<div class="alert alert-danger">', '</div>'); ?>
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <div class="col-sm-offset-4 col-sm-6">
			      <button type="submit" class="btn btn-default">Submit</button>
			    </div>
			  </div>
		<?php echo form_close(); ?>
	</div>
</div>