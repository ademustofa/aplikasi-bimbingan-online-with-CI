
 <nav class="navbar">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      	<a class="navbar-brand" href="<?php echo base_url('mahasiswa/index'); ?>" data-toggle="tooltip" title="Home"><span class="glyphicon glyphicon-home"></span></a>
	    </div>
	    <ul class="nav navbar-nav">
		   <li><a href="<?php echo base_url('mahasiswa/ppi'); ?>"><i class="fa fa-book"></i> PPI</a></li>
		   <li><a href="<?php echo base_url('mahasiswa/tugas_akhir'); ?>"><i class="fa fa-book"></i> Tugas Akhir</a></li>
		   <li><a href="<?php echo base_url('mahasiswa/riwayat'); ?>"><i class="fa fa-history"></i> Riwayat</a></li>
		   <li><a href="<?php echo base_url('mahasiswa/bantuan'); ?>"><i class="fa fa-question-circle"></i> Bantuan</a></li>
		   <li><a href="<?php echo base_url('mahasiswa/chat'); ?>"><i class="fa fa-question-circle"></i> Chat Forum</a></li>      
	    </ul>
	    <ul class="nav navbar-nav navbar-right">
	      <!-- <li style="padding-top: 20px;">Anda login sebagai <?php echo $this->session->userdata('nama_mhs'); ?></li>
	      <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li> -->

	      <li class="dropdown">
	             <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"> </span>&nbsp; <?php echo $this->session->userdata('nama_mhs') ?>
	             <span class="caret"></span></a>
	             <ul class="dropdown-menu">
	                <li><a href="<?php echo base_url('mahasiswa/profile'); ?>"><span class="glyphicon glyphicon-cog"></span> Ganti profile</a></li>
	                 <li><a href="<?php echo base_url('mahasiswa/password'); ?>"><span class="glyphicon glyphicon-cog"></span> Ganti Password</a></li>
	                <li><a href="<?php echo base_url('auth/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
	              </ul>
	         </li>
	    </ul>
	  </div>
	</nav>	
	