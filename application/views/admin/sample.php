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
				<li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Dashboard</a></li>
				<li class="breadcrumb-item active">Pages</li>
			</ol>
			<h1 class="page-header">Dashboard <small>header small text goes here...</small></h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Pages</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="<?=base_url('admin/front/add-page')?>" class="btn btn-xs btn-green" ><i class="fa fa-plus"></i> Add Page</a>
						
					</div>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?=base_url('admin/dashboard/process_user')?>" data-parsley-validate="true" enctype="multipart/form-data" novalidate>
						<input type="hidden" name="id" value="<?=$user['id']?>" />
						<div class="form-group">
							<label class="control-label">First Name</label>
							<input type="text" data-parsley-required="true" data-parsley-required-message="Enter first name" class="form-control" name="fname" id="fname" value="<?=$user['fname']?>" />
							<?php echo form_error('fname');?>
						</div>
						<div class="form-group">
							<button type="submit" name="update_settings" id="update_settings" class="btn btn-green" >Save</button>
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