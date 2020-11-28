<?php 
	$prefix = "admin/includes/";
	$this->load->view($prefix.'head');
?>
<body>
	 
	<?php 
		$this->load->view($prefix.'loader');
	?>
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<?php 
			$this->load->view($prefix.'top');
			$this->load->view($prefix.'sidebar');
		?>		
		
		<div id="content" class="content">
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">Dashboard</a></li>
				<li class="breadcrumb-item active">Profile</li>
			</ol>
			<h1 class="page-header">Dashboard</h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Update Profile</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="<?=base_url('admin/dashboard')?>" class="btn btn-xs btn-green" >Dashboard</a>
						
					</div>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?=base_url('login/processProfile')?>"  data-parsley-validate="true" novalidate autocomplete="off">
						
						<div class="form-group">
							<label class="control-label">First Name</label>
							<input type="text" data-parsley-required="true" data-parsley-required-message="Enter first name" class="form-control" name="fname" id="fname" value="<?=$user['fname']?>" />
							<?php echo form_error('fname');?>
						</div>
						<div class="form-group">
							<label class="control-label">Last Name</label>
							<input type="text"  class="form-control" name="lname" id="lname" value="<?=$user['lname']?>" />
							
						</div>
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email"  class="form-control" name="email" data-parsley-required="true" data-parsley-required-message="Enter email"  id="email" value="<?=$user['email']?>" />
							<?php echo form_error('email');?>
						</div>
						<small class="text-danger">If password fields are left empty then password will not update.</small>
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control" name="pass" id="pass" autocomplete="new-password" value="" />
							<?php echo form_error('pass');?>
						</div>
						<div class="form-group">
							<label class="control-label">Confirm password</label>
							<input type="password"  class="form-control" name="cpass" autocomplete="new-password" id="cpass" value="" />
							<?php echo form_error('cpass');?>
						</div>
						
						<div class="form-group">
							<button type="submit" name="updated" id="updated" class="btn btn-green" >Updated</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- #content -->
	</div>
	<?php 
		$this->load->view($prefix.'foot');
	?>
	<script>
		<?php 
			if($this->session->has_userdata('data')) {
				$msg = $this->session->userdata('data');
				$class= $this->session->userdata('class');
		?>
			toastr.<?=$class?>('<?=$msg?>');
		<?php } ?>
	</script>
</body>
</html>