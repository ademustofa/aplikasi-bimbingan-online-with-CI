
<div class="container-fluid">
	<div class="jumbotron">

		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		    <!-- Indicators -->
		    <ol class="carousel-indicators">
		      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		      <li data-target="#myCarousel" data-slide-to="1"></li>
		    </ol>

		    <!-- Wrapper for slides -->
		    <div class="carousel-inner">

		      <div class="item active">
		        <img src="<?php echo base_url('assets/img/polindra1.jpg');?>" alt="Los Angeles" style="width:100%;">
		        <div class="carousel-caption bounceInLeft">
		          <h3>Selamat Datang di E-Consult</h3>
		        </div>
		      </div>

		      <div class="item">
		        <img src="<?php echo base_url('assets/img/polindra2.jpg');?>" alt="Chicago" style="width:100%;">
		        <div class="carousel-caption">
		          <h3>Bimbingan laporan Mudah, Dimana saja, dan Kapan saja</h3>
		        </div>
		      </div>
		    
		  
		    </div>

		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
		      <span class="glyphicon glyphicon-chevron-left"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#myCarousel" data-slide="next">
		      <span class="glyphicon glyphicon-chevron-right"></span>
		      <span class="sr-only">Next</span>
		    </a>
		  </div>
	
		<h2 style="text-align: center;">Pengumuman</h2>
		<br>
		<?php foreach ($post as $key) { ?>
			
			<p style="font-weight: bold;">-- <?php echo $key['judul'] ?> --</p>
			<h5> Posted By: <span class="label label-primary"><span class="glyphicon glyphicon-user"></span> <?php echo $key['username'] ?></span></h5>
			<button type="button" class="btn btn-info" data-toggle="modal" href="#demo">Detail info</button>
				
			<h4>Posted At: <span class="label label-info"><span class="glyphicon glyphicon-calendar"></span> <?php echo $key['create_at'] ?></span></h4>

		<hr>
		<?php } ?>
	</div>

</div>

<div id="demo" class="modal fade" role="dialog">
				  <div class="modal-dialog" style="width: 1000px;">

				    <!-- Modal content-->
				    <div class="modal-content">
				     <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title" style="text-align: center;">Post Pemberitahuan</h4>
				      </div>
				      <div class="modal-body">
				      	<div class="row">
				         <div class="col-md-6 col-md-offset-2" style="font-size: 15px;">
				         	<?php echo $key['keterangan'] ?>
				         </div>  
				         </div> 
				      </div>
		
				    </div>

				  </div>
				</div>
	            <!-- end modal -->