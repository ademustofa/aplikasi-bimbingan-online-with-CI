
<div class="container">
	<!-- form login -->
	<div id="form">
		<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-warning" id="form-login">
				  	<div class="panel-heading">Sign In</div>
	  				<div class="panel-body">
	  				<?php echo $this->session->flashdata('message'); ?>
	  				<?php echo form_open('auth/cek_login',array(
			  			'method' => 'POST',
			  			'class'	 => 'form'
			  		)); ?>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
   							<input type="text" class="form-control" name="username" id="username" placeholder="Username">
						</div>
						<?php echo form_error('username', '<div class="alert alert-danger">', '</div>'); ?>
					</div>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    						<input type="password" class="form-control" name="password" id="password" placeholder="Password">
						</div>
						<?php echo form_error('password', '<div class="alert alert-danger">', '</div>'); ?>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-defaukt btn-block">Login</button>
					</div>	
					<?php echo form_close(); ?>
	  				</div>
				</div>
			
		</div>
	</div>

</div>
