
<div class="container">
	<div class="jumbotron">
	<?php echo $this->session->flashdata('message'); ?>
		<h3 style="text-align: center; font-weight: bold;">Edit Profile</h3>
		<br>	
		<?php echo form_open_multipart('mahasiswa/profile_update',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			  <div class="form-group">	
			    <label class="control-label col-sm-2" for="Nama_mhs">Nama Lengkap</label>
			    <div class="col-sm-6">
			    <?php if (!empty($nama_mhs)): ?>
					<input type="text" class="form-control" id="searchTextField" name="nama_mhs" placeholder="Masukan nama lengkap" class="searchMaps" value="<?php echo $nama_mhs; ?>" >	
				<?php else: ?>
					<input type="text" class="form-control" id="searchTextField" name="nama_mhs" placeholder="Masukan nama lengkap" class="searchMaps" value="<?php echo set_value('nama_mhs'); ?>" >
				<?php endif; ?>
				<?php echo form_error('nama_mhs', '<div class="alert alert-danger">', '</div>'); ?>
			
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="control-label col-sm-2" for="NIM">NIM</label>
			    <div class="col-sm-6">
			    <?php if (!empty($nim)): ?>
					<input type="text" class="form-control" id="searchTextField" name="nim" placeholder="Masukan NIM" class="searchMaps" value="<?php echo $nim; ?>" >	
				<?php else: ?>
					<input type="text" class="form-control" id="searchTextField" name="nim" placeholder="Masukan NIM" class="searchMaps" value="<?php echo set_value('nim'); ?>" >
				<?php endif; ?>
				<?php echo form_error('nim', '<div class="alert alert-danger">', '</div>'); ?>
			    </div>
			  </div>
			   <div class="form-group">
			    <label class="control-label col-sm-2" for="Kelas">Kelas</label>
			    <div class="col-sm-6">
			    <?php if (!empty($kelas)): ?>
					<input type="text" class="form-control" id="searchTextField" name="kelas" placeholder="Masukan kelas" class="searchMaps" value="<?php echo $kelas; ?>" >	
				<?php else: ?>
					<input type="text" class="form-control" id="searchTextField" name="kelas" placeholder="Masukan kelas" class="searchMaps" value="<?php echo set_value('kelas'); ?>" >
				<?php endif; ?>
				<?php echo form_error('kelas', '<div class="alert alert-danger">', '</div>'); ?>
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