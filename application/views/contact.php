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
		<aside id="colorlib-hero">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(<?=base_url('images/img_bg_4.jpg')?>);">
						<div class="overlay"></div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-8 col-sm-12 col-md-offset-2 slider-text">
									<div class="slider-text-inner text-center">
										<h2>get in touch</h2>
										<h1>contact Us</h1>
									</div>
								</div>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</aside>
		<div id="colorlib-contact">
			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 animate-box">
						<h2>Contact Information</h2>
						<div class="row contact-info-wrap">
							<div class="col-md-4">
								<p><span><i class="icon-location-2"></i></span> Bharoki road, by pass, <br> Wazirabaad , Pakistan</p>
							</div>
							<div class="col-md-4">
								<p><span><i class="icon-paperplane"></i></span> <span >alamconcretes@hotmail.com</span></a></p>
							</div>
							<div class="col-md-4">
								<p><span><i class="icon-globe"></i></span> <a href="#"><?=$_SERVER['HTTP_HOST']?></a></p>
							</div>
							<div class="col-md-12">
								<p><span><i class="icon-phone3"></i></span> <a href="tel://+923006244105">+92 300 6244105</a>&nbsp;&nbsp;<a href="tel://+923008623660">+92 300 8623660</a></</p>
							</div>
						</div>
					</div>
					<div class="col-md-10 col-md-offset-1 animate-box">
						<h2>Get In Touch</h2>
						<form action="#" role="form" id="frm">
						<div class="row form-group">
						<div class="col-md-6">
						<label for="fname">First Name</label>
						<input type="text" id="fname" name="fname" class="form-control" placeholder="Your firstname">
						</div>
						<div class="col-md-6">
						<label for="lname">Last Name</label>
						<input type="text" id="lname" name="lname" class="form-control" placeholder="Your lastname">
						</div>
						</div>
						<div class="row form-group">
						<div class="col-md-12">
						<label for="email">Email</label>
						<input type="email" id="email" name="email" class="form-control" placeholder="Your email address">
						</div>
						</div>
						<div class="row form-group">
						<div class="col-md-12">
						<label for="subject">Subject</label>
						<input type="text" id="subject" name="subject" class="form-control" placeholder="Your subject of this message">
						</div>
						</div>
						<div class="row form-group">
						<div class="col-md-12">
						<label for="message">Message</label>
						<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Say something about us"></textarea>
						</div>
						</div>
						<div class="form-group">
						<input type="button" value="Send Message" id="send" class="btn btn-primary">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	
	<?php $this->load->view('includes/footer');?>
</div>
	<?php $this->load->view('includes/foot'); ?>
	<script src="<?=base_url('assets/plugins/toastr/toastr.min.js')?>"></script>
	<script src="<?=base_url('assets/plugins/sweetalert/dist/sweetalert.min.js')?>"></script>
</body>
	<script>
		$(document).on('click','#send',function(){
			var that = $(this);
			var fname = $('#fname').val();
			var email = $('#email').val();
			var subject = $('#subject').val();
			var msg = $('#message').val();
			if(fname=="") {
				toastr.error('Please enter name');
				return false;
			}
			if(email=="") {
				toastr.error('Please enter email');
				return false;
			}
			if(subject=="") {
				toastr.error('Please enter subject');
				return false;
			}
			if(msg=="") {
				toastr.error('Please enter message');
				return false;
			}
			var data = $('#frm').serialize();
			$.ajax({
				url:'<?=base_url("home/send_mail")?>',
				type:'post',
				dataType:'JSON',
				data:{'data':data},
				beforeSend:function() {
					that.val('Processing...').prop('disabled',true);
				},
				success:function(res) {
					if(res=='1') {
						 swal("Good job!","Message sent successfully","success",
							{button: "Close",}
						);
						window.location.reload();
					} else {
						swal("Awwww!",res,"error",
							{button: "Close",}
						);
					}
				},
				complete:function() {
					that.val('Send Message').prop('disabled',false);
				}
			});
		});
	</script>
</html>
