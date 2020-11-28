
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?=is_set($title,'Login Page');?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<?php 
		$pre = "";
		echo link_tag($pre.'assets/css/default/app.min.css');
		echo link_tag($pre.'assets/plugins/toastr/toastr.min.css');
	?>
	<!-- ================== END BASE CSS STYLE ================== -->
</head>
<body class="pace-top">
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- begin login -->
		<div class="login login-with-news-feed">
			<!-- begin news-feed -->
			<div class="news-feed">
				<div class="news-image" style="background-image: url(<?=base_url('images/login-bg-11.jpg')?>)"></div>
				<div class="news-caption">
					<h4 class="caption-title">Admin Login</h4>
					<p>
						<!-- some basic info if any -->
					</p>
				</div>
			</div>
			<!-- end news-feed -->
			<!-- begin right-content -->
			<div class="right-content">
				<!-- begin login-header -->
				<div class="login-header">
					<div class="brand">
						<span class="logo"></span> Admin
						<small>Login</small>
					</div>
					<div class="icon">
						<i class="fa fa-sign-in-alt"></i>
					</div>
				</div>
				<!-- end login-header -->
				<!-- begin login-content -->
				<div class="login-content">
					<form class="margin-bottom-0" role="form">
						<div class="form-group m-b-15">
							<input type="text" class="form-control form-control-lg" placeholder="Email Address" required id="email" autocomplete="off" name="email" />
						</div>
						<div class="form-group m-b-15">
							<input type="password" class="form-control form-control-lg" placeholder="Password" required autocomplete="off" id="password" name="password" />
						</div>
						<!--<div class="checkbox checkbox-css m-b-30">
							<input type="checkbox" id="remember" value="" />
							<label for="remember_me_checkbox">
							Remember Me
							</label>
						</div>-->
						<div class="login-buttons">
							<button type="submit" id="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
						</div>
						
						<hr />
						<p class="text-center text-grey-darker mb-0">
							&copy; All Right Reserved <?=date('Y');?>
						</p>
					</form>
				</div>
				<!-- end login-content -->
			</div>
			<!-- end right-container -->
		</div>
		<!-- end login -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="<?=base_url($pre.'assets/js/app.min.js');?>"></script>
	<script src="<?=base_url($pre.'assets/js/theme/default.min.js');?>"></script>
	<script src="<?=base_url($pre.'/assets/plugins/toastr/toastr.min.js');?>"></script>
	
	<script>
		$(document).on('click','#submit',function(e) {
			e.preventDefault();
			var email = $('#email').val();
			var pass = $('#password').val();
			//var remember = $('#remember').is( ":checked" )? '1' : '0';
			if(email=="") {
				toastr.error('Please enter email');
				return false;
			} 
			if(pass=="") {
				toastr.error('Please enter password');
				return false;
			}
			$.ajax({
				url:'<?=base_url("login/process")?>',
				type:'POST',
				dataType:'JSON',
				data:{'email':email,'password':pass},
				success:function(res) {
					if(res=="1") {
						window.location.href='<?=base_url("admin/index")?>';
					} else {
						toastr.error(res);
					}
				}
			});
		});
	</script>
</body>
</html>