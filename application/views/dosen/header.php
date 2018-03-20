 <nav class="navbar">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="<?php echo base_url('dosen/index'); ?>" data-toggle="tooltip" title="Home"><span class="glyphicon glyphicon-home"></span></a>
	    </div>
	    <ul class="nav navbar-nav">
	      <li><a href="<?php echo base_url('dosen/ppi'); ?>">PPI</a></li>
	      <li><a href="<?php echo base_url('dosen/tugas_akhir'); ?>">Tugas Akhir</a></li>
	      <li><a href="<?php echo base_url('dosen/riwayat'); ?>">Riwayat</a></li>
	      <li><a href="<?php echo base_url('dosen/bantuan'); ?>">Bantuan</a></li>
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	     <!--  <li style="padding-top: 20px;">Anda login sebagai <?php echo $this->session->userdata('nama_dsn') ?></li>
	     <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> -->

	     <li class="dropdown">
	             <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"> </span>&nbsp; <?php echo $this->session->userdata('nama_dsn') ?>
	             <span class="caret"></span></a>
	             <ul class="dropdown-menu">
	             	<li><a href="<?php echo base_url('dosen/profile'); ?>"><span class="glyphicon glyphicon-cog"></span> Edit profile</a></li>
	                <li><a href="<?php echo base_url('dosen/password_dsn'); ?>"><span class="glyphicon glyphicon-cog"></span> Ganti Password</a></li>
	                <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	              </ul>
	         </li>
	    </ul>
	  </div>
</nav>