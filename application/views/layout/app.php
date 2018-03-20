<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
</head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>">
	<!-- <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/font-awesome.min.css');?>"> -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css"> -->
  	<link rel="stylesheet" href="<?php echo base_url('assets/sweetalert2/sweetalert2.min.css');?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/animate/animate.min.css');?>">
  	<link rel="stylesheet" href="<?php echo base_url('assets/datatable/jquery.dataTables.min.css');?>">
  	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style.css');?>">
  	<script src="<?php echo base_url('assets/tinymce/tinymce.min.js');?>"></script>
  	<script>
		tinymce.init({ selector: ".posting" });
	</script>
	
<body>
<?php $this->load->view($header) ?>





<script src="<?php echo base_url('assets/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/datatable/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.js"></script> -->
<script src="<?php echo base_url('assets/sweetalert2/sweetalert2.min.js');?>"></script>
<?php $this->load->view($page) ?>

</body>
</html>
