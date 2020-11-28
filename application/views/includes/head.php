	
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= isset($title)?$title:'Pak Blocks'?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="We provide complete building solutions" />
	<meta name="keywords" content="bricks,hollow,curve stone,tuff tiles,building blocks,concretes,concrete" />
	<meta name="author" content="Haji Muhammad Alam" />

	<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,700" rel="stylesheet">

	<?php 
		$pathc = 'assets/front/';
		echo link_tag($pathc.'css/animate.css');
		echo link_tag($pathc.'css/icomoon.css');
		echo link_tag($pathc.'css/bootstrap.css');
		echo link_tag($pathc.'css/magnific-popup.css');
		echo link_tag($pathc.'css/flexslider.css');
		echo link_tag($pathc.'css/owl.carousel.min.css');
		echo link_tag($pathc.'css/owl.theme.default.min.css');
		echo link_tag($pathc.'fonts/flaticon/font/flaticon.css');
		echo link_tag($pathc.'css/style.css');
	?>
	<script src="<?=base_url($pathc.'js/modernizr-2.6.2.min.js')?>"></script>
	<script src="<?=base_url($pathc.'js/jquery.min.js')?>" ></script>
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style>
		#colorlib-testimony .testimony-slide blockquote {
			border: none;
			margin: 0 auto;
			width: 100%;
			position: relative;
			padding: 0 0 0 0px !important;
			color: #000;
		}
	</style>