 <nav class="navbar">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="<?php echo base_url('admin/index'); ?>" data-toggle="tooltip" title="Home"><span class="glyphicon glyphicon-home"></span></a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li><a href="<?php echo base_url('admin/user'); ?>">User</a></li>
	      <li><a href="<?php echo base_url('admin/data_mhs'); ?>">Data Mahasiswa</a></li>
	      <li><a href="<?php echo base_url('admin/data_dosen'); ?>">Data Dosen</a></li>
	      <li><a href="<?php echo base_url('admin/upload_data'); ?>">Upload</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	     <!--  <li style="padding-top: 20px;">Anda login sebagai <?php echo $user; ?></li>
	     <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> -->
		     <li class="dropdown">
	             <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"> </span>&nbsp; <?php echo $user; ?>
	             <span class="caret"></span></a>
	             <ul class="dropdown-menu">
	                <li><a href=""><span class="glyphicon glyphicon-cog"></span> Ganti Password</a></li>
	                <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	              </ul>
	         </li>
	    </ul>
	  </div>
	</nav>