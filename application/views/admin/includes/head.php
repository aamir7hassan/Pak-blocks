<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?=isset($title)?$title:'Admin'?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<?php 
		
		echo link_tag('assets/css/default/app.min.css');
		echo link_tag('assets/plugins/jvectormap-next/jquery-jvectormap.css');
		echo link_tag('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css');
		echo link_tag('assets/plugins/gritter/css/jquery.gritter.css');
		echo link_tag('assets/plugins/toastr/toastr.min.css');
	?>
	<script src="<?=base_url('assets/js/app.min.js');?>"></script>
	<script src="<?=base_url('assets/js/theme/default.min.js');?>"></script>
	<script src="<?=base_url('assets/plugins/gritter/js/jquery.gritter.js');?>"></script>
	
</head> 