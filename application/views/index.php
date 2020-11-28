<!DOCTYPE HTML>
<html>
	<?php 
		$this->load->view('includes/head');
		echo link_tag('assets/plugins/toastr/toastr.min.css');
	?>

	</head>
<body>

	<div id="page">
	
		<?php $this->load->view('includes/header');?>
		<?php $this->load->view('includes/slider');?>
	
	<div id="colorlib-intro">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-push-4 animate-box colorlib-heading animate-box">
					<span class="sm">Welcome!</span>
					<h2><span class="thin">Secrets of Success</span> <span class="thick">of Our Projects</span></h2>
				</div>
				<div class="col-md-4 col-md-pull-4 animate-box">
					<div class="box text-center">
						<span class="num">25</span>
						<span class="yr">Years</span>
						<span class="thin">Experience</span>
					</div>
				</div>
				<div class="col-md-4 animate-box">
					<p>Pak Blocks company is a well established company which has been setup in Pakistan keeping in new the vast requirements of construction going on in the country.The company has latest machines imported from <b>France</b> and plant is setup with the help of french technicians.The company at presernt specializes in making hollow concrete blocks.The aim of pak blocks is to supply all its valuable customer quality products at a competitive prices.</p>
				</div>
			</div>
		</div>
	</div>
	<div id="colorlib-project">
		<div class="container">
			<div class="row">
				<div class="col-md-4 animate-box colorlib-heading animate-box">
					<span class="sm">Works</span>
					<h2><span class="thin">Our Done</span> <span class="thick">Projects</span></h2>
					<p>We have build life long valuable projects which ranges from houses to comapny buildings And customers are fully satisfied with the quality of blocks.</p>
					<p><a href="<?=base_url('projects')?>">View All Projects <i class="icon-arrow-right3"></i></a></p>
				</div>
				<div class="col-md-7 col-md-push-1">
					<div class="row">
						<div class="col-md-12 animate-box">
							<div class="owl-carousel owl-carousel2 project-wrap">
								<?php 
									foreach($projects as $p=>$proj) {
									$name = $proj['title'];
									$desc  = $proj['description'];
									if(empty($proj['image'])) {
										$imgp = base_url('images/projects/default.png');
									} else {
										$imgp = base_url('images/projects/'.$proj['image']);
									}
								?>
								<div class="item">
									<a href="<?=$imgp?>" class="project image-popup-link" style="background-image: url(<?=$imgp?>);">
									<div class="desc-t">
									<div class="desc-tc">
									<div class="desc">
									<h3><span><small><?=$p+1?></small></span><?=$name?></h3>
									<p><?=$desc?></p>
									</div>
									</div>
									</div>
									</a>
								</div>
									<?php } ?>
									
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="colorlib-counter" class="colorlib-counters" style="background-image: url(images/cover_img_1.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
		<div class="row">
		</div>
		<div class="row">
		<div class="col-md-3 text-center animate-box">
		<span class="icon"><i class="flaticon-skyline"></i></span>
		<span class="colorlib-counter js-counter" data-from="0" data-to="345" data-speed="5000" data-refresh-interval="50"></span>
		<span class="colorlib-counter-label">Projects</span>
		</div>
		<div class="col-md-3 text-center animate-box">
		<span class="icon"><i class="flaticon-engineer"></i></span>
		<span class="colorlib-counter js-counter" data-from="0" data-to="60" data-speed="5000" data-refresh-interval="50"></span>
		<span class="colorlib-counter-label">Workers</span>
		</div>
		<div class="col-md-3 text-center animate-box">
		<span class="icon"><i class="flaticon-architect-with-helmet"></i></span>
		<span class="colorlib-counter js-counter" data-from="0" data-to="5987" data-speed="5000" data-refresh-interval="50"></span>
		<span class="colorlib-counter-label">Constructor</span>
		</div>
		<div class="col-md-3 text-center animate-box">
		<span class="icon"><i class="flaticon-worker"></i></span>
		<span class="colorlib-counter js-counter" data-from="0" data-to="18" data-speed="5000" data-refresh-interval="50"></span>
		<span class="colorlib-counter-label">Clients</span>
		</div>
		</div>
		</div>
	</div>
	<?php $this->load->view('includes/feedbacks');?>
	
	<div class="col-md-10 col-md-offset-1 animate-box">
		<br/>
		<center><h2><span class="thick" style="font-weight:700;">Submit Review</span></h2></center>
		<form action="#" role="form" id="frm">
		<div class="row form-group">
			<div class="col-md-6">
				<label for="fname">Name</label>
				<input type="text" id="name" name="name" class="form-control" placeholder="Your Name">
			</div>
			<div class="col-md-6">
				<label for="fname">Email</label>
				<input type="email" id="email" name="email" class="form-control" placeholder="Email address">
			</div>
		</div>
		<div class="row form-group">
			<div class="col-md-12">
				<label for="message">Message</label>
				<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us"></textarea>
			</div>
		</div>
		<div class="form-group">
		<input type="button" value="Submit Review" id="sendr" class="btn btn-primary">
		</div>
		</form>
	</div>
	<?php $this->load->view('includes/footer');?>
</div>
	<?php $this->load->view('includes/foot');?>
	<script src="<?=base_url('assets/plugins/toastr/toastr.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/sweetalert/dist/sweetalert.min.js')?>"></script>
	<script>
		
		$(document).on('click','#sendr',function(e){
			var that = $(this);
			var name = $('#name').val();
			var msg  = $('#message').val();
			var email = $('#email').val();
			if(name=="") {
				toastr.error('Please enter your name');
				return false;
			}
			if(email=="") {
				toastr.error('Please enter email address');
				return false;
			}
			if(msg=="") {
				toastr.error('Please enter message');
				return false;
			}
			
			$.ajax({
				url:'<?=base_url("home/process_review")?>',
				type:'POST',
				dataType:'JSON',
				data:{'name':name,'msg':msg,'email':email},
				beforeSend:function() {
					that.val('Processing...').prop('disabled',true);
				},
				success:function(res) {
					if(res=="1") {
						 swal("Good job!","Thankyou for your valuable feedback","success",
							{button: "Close",}
							);
						 window.location.reload();
					} else {
						that.val('Submit Review').prop('disabled',false);
						swal("Sorry!","Process failed,try again","error",
							{button: "Close",}
						);
					}
				}
			});
		});
	</script>
</body>
</html>
