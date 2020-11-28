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
				<li style="background-image: url(images/pk1.jpg);">
					<div class="overlay"></div>
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-8 col-sm-12 col-md-offset-2 slider-text">
								<div class="slider-text-inner text-center">
									<h2>Company Info</h2>
									<h1>About Us</h1>
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
				<div class="col-md-6">
					<div class="about animate-box">
						<h2>Welcome to Pak Blocks</h2>
						<p>H. Alam concretes is an established company which has been setup in Pakistan keeping in view the vast requirements of construction going on in the county. The company at present specializes in making hollow concrete blocks. The company has setup its first production plant in Wazirabad (bharoke), which is producing all the products the company is to offer.</p>
						<p>A fully Automatic Computerized plant has been imported from France with the help of French Technicians. The plant has been brought into production. Now a day’s construction scenario the economic factor plays a very vital role along with a standardized quality.</p>
						<p>We never compromise on quality.Therefore,providing a iron strength block.
							Raw material's recipie is as same as in France.its strength is 800 PSI for France but here we are producing 1600 PSI Strength</p>
					</div>
				</div>
				<div class="col-md-6">
					<img class="img-responsive" src="<?=base_url('images/about.jpg')?>" alt="Free HTML5 Bootstrap Template by colorlib.com">
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
