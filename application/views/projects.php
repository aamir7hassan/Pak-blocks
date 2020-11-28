<!DOCTYPE HTML>
<html>
	<?php 
		$this->load->view('includes/head');
	?>

	</head>
<body>

	<div id="page">
		<?php $this->load->view('includes/header');?>
		<aside id="colorlib-hero">
		<div class="flexslider">
			<ul class="slides">
				<li style="background-image: url(<?=base_url('images/img_bg_3.jpg')?>);">
					<div class="overlay"></div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-8 col-sm-12 col-md-offset-2 slider-text">
								<div class="slider-text-inner text-center">
									<h2>Secret of our success</h2>
									<h1>Our projects</h1>
								</div>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>
		</aside>
	
		<div id="colorlib-project">
			<div class="container">
				<div class="row">
					<?php 
						foreach($projects as $p=>$pro) {
						$img = empty($pro['image'])?base_url('images/projects/default.png'):base_url('images/projects/'.$pro['image']);
					?>
					<div class="col-md-6 animate-box">
						<div class="item item-2">
							<a href="<?=$img?>" class="project image-popup-link" style="background-image: url(<?=$img?>);">
								<div class="desc-t">
									<div class="desc-tc">
										<div class="desc">
											<h3><span><small><?=$p+1?></small></span><?=$pro['title']?></h3>
											<p><?=$pro['description']?></p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					<?php } ?>
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
