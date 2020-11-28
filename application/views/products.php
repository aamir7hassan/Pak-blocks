<!DOCTYPE HTML>
<html>
	<?php 
		$this->load->view('includes/head');
	?>
	<style>
		.titles {
			text-transform:uppercase;
		}
		.box {
			height: 330px;
			border: 1px solid #9E9E9E;
			padding: 2px;
			background-color: #fafafa;
			margin-bottom:30px;
			box-shadow: 0px 0px 5px 5px #e6e6e6;
		}
		img.imgg {
			width: 100%;
			height: 215px;
		}
		.desc {
			background-color: #fafafa;
			padding: 10px;
			text-align: center;
		}
		.desc p {
			margin-bottom:1px;
			color: #212121;
			font-weight: 600;
		}
	</style>
	</head>
<body>

	<div id="page">
	
		<?php $this->load->view('includes/header');?>
		<aside id="colorlib-hero">
		<div class="flexslider">
			<ul class="slides">
				<li style="background-image: url(images/pk1.jpg);">
					<div class="overlay"></div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-8 col-sm-12 col-md-offset-2 slider-text">
								<div class="slider-text-inner text-center">
									<h2>Products</h2>
									<h1>Pak Blocks</h1>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		</aside>
	

	<div id="colorlib-about">
		<div class="container">
			<div class="row row-pb-lg">
				<div class="col-md-12">
					<div class="about animate-box">
						<h2>
							<center>Products</center><br>
							<center class="titles">hollow, curve stone, tuff tiles & bricks</center>
						</h2>
						<br>
						<div class="row">
							<?php 
								foreach($items as $k=>$v) {
								$l=$h=$w='';
								$l = $v['length'];
								$h = $v['height'];
								$w = $v['width'];
								$imgg = $v['image'];
								if(empty($imgg)) {
									$img = base_url('images/products/default.png');
								} else {
									$img = base_url('images/products/'.$imgg);
								}
							?>
							<div class="col-md-3">
								<div class="box">
									<img src="<?=$img?>" class="imgg" />
									<div class="desc">
										<p class="length">Length: <?=$l.'"'?></p>
										<p class="width">Width: <?=$w.'"'?></p>
										<p class="height">Height: <?=$h.'"'?></p>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<?php $this->load->view('includes/feedbacks');?>
	<?php $this->load->view('includes/footer');?>
</div>
	<?php $this->load->view('includes/foot'); ?>

</body>

<!-- Mirrored from colorlib.com/preview/theme/architect/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 09 Feb 2020 18:01:15 GMT -->
</html>
