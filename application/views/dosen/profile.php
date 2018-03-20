
<div class="container">
	<div class="jumbotron">
	<?php echo $this->session->flashdata('message'); ?>
		<h3 style="text-align: center;">Sunting Profil</h3>
		<?php echo form_open_multipart('dosen/profile_update',array(
                                'method' => 'POST',
                                'class'  => 'form-horizontal'
                            )); ?>
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			  <div class="form-group">	
			    <label class="control-label col-sm-2" for="Nama_dsn">Nama Lengkap</label>
			    <div class="col-sm-10">
			    <?php if (!empty($nama_dsn)): ?>
					<input type="text" class="form-control" id="searchTextField" name="nama_dsn" placeholder="Masukan nama lengkap" class="searchMaps" value="<?php echo $nama_dsn; ?>" >	
				<?php else: ?>
					<input type="text" class="form-control" id="searchTextField" name="nama_dsn" placeholder="Masukan nama lengkap" class="searchMaps" value="<?php echo set_value('nama_dsn'); ?>" >
				<?php endif; ?>
				<?php echo form_error('nama_dsn', '<div class="alert alert-danger">', '</div>'); ?>
			
			    </div>
			  </div>

			  <div class="form-group">
			    <label class="control-label col-sm-2" for="NIK">NIK</label>
			    <div class="col-sm-10">
			    <?php if (!empty($nik)): ?>
					<input type="text" class="form-control" id="searchTextField" name="nik" placeholder="Masukan NIK" class="searchMaps" value="<?php echo $nik; ?>" >	
				<?php else: ?>
					<input type="text" class="form-control" id="searchTextField" name="nik" placeholder="Masukan NIK" class="searchMaps" value="<?php echo set_value('nik'); ?>" >
				<?php endif; ?>
				<?php echo form_error('nik', '<div class="alert alert-danger">', '</div>'); ?>
			    </div>
			  </div>

			  <div class="form-group">
			    <label class="control-label col-sm-2" for="No_hp">Nomor Handphone</label>
			    <div class="col-sm-10">
			    <?php if (!empty($no_hp)): ?>
					<input type="text" class="form-control" id="searchTextField" name="no_hp" placeholder="Masukan Nomor Handphone" class="searchMaps" value="<?php echo $no_hp; ?>" >	
				<?php else: ?>
					<input type="text" class="form-control" id="searchTextField" name="no_hp" placeholder="Masukan Nomor Handphone" class="searchMaps" value="<?php echo set_value('no_hp'); ?>" >
				<?php endif; ?>
				<?php echo form_error('no_hp', '<div class="alert alert-danger">', '</div>'); ?>
			    </div>
			  </div>

			  <div class="form-group">
			    <label class="control-label col-sm-2" for="Email">Email</label>
			    <div class="col-sm-10">
			    <?php if (!empty($email)): ?>
					<input type="text" class="form-control" id="searchTextField" name="email" placeholder="Masukan email" class="searchMaps" value="<?php echo $email; ?>" >	
				<?php else: ?>
					<input type="text" class="form-control" id="searchTextField" name="email" placeholder="Masukan email" class="searchMaps" value="<?php echo set_value('email'); ?>" >
				<?php endif; ?>
				<?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
			    </div>
			  </div>

			  
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default">Submit</button>
			    </div>
			  </div>
		<?php echo form_close(); ?>
	</div>
</div>