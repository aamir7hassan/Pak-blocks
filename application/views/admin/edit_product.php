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
				<li class="breadcrumb-item active">Products</li>
			</ol>
			<h1 class="page-header">Products </h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Edit product</h4>
					<div class="panel-heading-btn">
						
						<a href="<?=base_url('admin/products')?>" class="btn btn-xs btn-green" > Products</a>
						
					</div>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?=base_url('admin/dashboard/process_product')?>" data-parsley-validate="true" enctype="multipart/form-data" novalidate>
						<input type="hidden" value="<?=$item['pr_id']?>" name="id" />
						<!--<div class="form-group">
							<label class="control-label">Name</label>
							<input type="text" data-parsley-required="true" data-parsley-required-message="Enter first name" class="form-control" name="name" id="name" value="<?=$item['name']?>" />
							<?php echo form_error('name');?>
						</div>-->
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Length</label>
									<input type="text" class="form-control" name="length" id="length" value="<?=$item['length']?>" />
									<?php echo form_error('length');?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Height</label>
									<input type="text"  class="form-control" name="height" id="height" value="<?=$item['height']?>" />
									<?php echo form_error('height');?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label class="control-label">Width</label>
									<input type="text" class="form-control" name="width" id="width" value="<?=$item['width']?>" />
									<?php echo form_error('width');?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<h3>Upload Image</h3>
								<input type="file" name="image" id="image"  />
								<input type="hidden" name="old" value="<?=$item['image']?>" />
							</div>
							<div class="col-md-4">
								<h3>Image Preview</h3>
								<img id="blah" src="#" style="width:100px;height:100px" alt="your image" />
							</div>
							<div class="col-md-4">
								<h3>Old Image</h3>
								<img src="<?=base_url('images/products/'.$item['image'])?>" style="width:100px;height:100px" alt="your image" />
							</div>
						</div><br>
						<div class="form-group">
							<button type="submit" name="update_settings" id="update_settings" class="btn btn-green" >Update</button>
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
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#blah').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]); // convert to base64 string
			}
		}

		$("#image").change(function() {
			readURL(this);
		});
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