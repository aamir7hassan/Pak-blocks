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
						<a href="<?=base_url('admin/products')?>" class="btn btn-xs btn-indigo" > Projects</a>
					</div>
				</div>
				<div class="panel-body">
					<form role="form" method="post" action="<?=base_url('admin/dashboard/process_project')?>" data-parsley-validate="true" enctype="multipart/form-data" novalidate>
						<input type="hidden" value="<?=$item['pro_id']?>" name="id" />
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Title</label>
									<input type="text" class="form-control" name="title" id="title" value="<?=$item['title']?>" />
									<?php echo form_error('title');?>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="control-label">Height</label>
									<textarea type="text"  class="form-control" name="desc" id="desc" ><?=$item['description']?></textarea>
									<?php echo form_error('desc');?>
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
								<img src="<?=base_url('images/projects/'.$item['image'])?>" style="width:100px;height:100px" alt="your image" />
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