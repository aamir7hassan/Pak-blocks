<?php 
	$prefix = "admin/includes/";
	$this->load->view($prefix.'head'); 
	$pre = "";

	echo link_tag($pre.'assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css');
	echo link_tag($pre.'assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css');
?>
<style>
	table tr th, table tr td {
		text-align:center;
	}
	.select2.select2-container .selection .select2-selection.select2-selection--multiple .select2-selection__rendered, .select2.select2-container .selection .select2-selection.select2-selection--single .select2-selection__rendered {
		font-weight:500;
	}
	.ir {
		display: block;
		margin: auto;
		width: 100px;
		height: 100px;
	}
</style>
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
				<li class="breadcrumb-item"><a href="<?php echo base_url('admin');?>">Dashboard</a></li>
				<li class="breadcrumb-item active">Projects</li>
			</ol>
			<h1 class="page-header">Projects</h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Projects</h4>
					<div class="panel-heading-btn">
						<a href="<?=base_url('admin/add-project')?>" class="btn btn-xs btn-green" ><i class="fa fa-plus"></i> Add Projects</a>
						
					</div>
				</div>
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th>Sr.</th>
								<th>Title</th>
								<th>Image</th>
								<th>Date</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($projects as $k=>$v) {
									$id = $v['pro_id'];
									$title = $v['title'];
									
									$desc = $v['description'];
									$created = date('F d, Y',strtotime($v['created']));
									if($v['image']=='') {
										$image = base_url('images/products/default.png');
									} else {
										$image = base_url('images/projects/'.$v['image']);
									}
									
							?>
								<tr>
									<td><?=$k+1?></td>
									<td><?=$title?></td>
									<td><img src="<?=$image?>" width="100" height="60" class="img img-responsive ir" /></td>
									<td><?=$created?></td>
									<td>
										<a href="<?=base_url('admin/edit-project/'.$id)?>" class="btn btn-sm btn-green" >Edit</a>
										<a href="#" data-title="<?=$title?>" data-desc="<?=$desc?>" data-created="<?=$created?>" class="btn btn-sm btn-indigo view">View</a>
										<a href="#" data-id="<?=$id?>" class="btn btn-sm btn-danger del">Delete</a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- #content -->
	</div>
	
	<div class="modal" id="reviewsM" aria-modal="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Project's Detail</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>Title</th><td id="title"></td>
								</tr>
								<tr>
									<th>Message</th><td id="msg"></td>
								</tr>
								<tr>
									<th>Last Modified</th><td id="date"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php 
		$this->load->view($prefix.'foot');
	?>

	<script src="<?=base_url($pre.'assets/plugins/datatables.net/js/jquery.dataTables.min.js');?>"></script>
	<script src="<?=base_url($pre.'assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js');?>"></script>
	<script src="<?=base_url($pre.'assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js');?>"></script>
	<script src="<?=base_url($pre.'assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js');?>"></script>
	
	<script>
	
		$('#data-table-default').DataTable({
			"pageLength":50,
			"fnDrawCallback": function(oSettings) {
				var rowCount = this.fnSettings().fnRecordsDisplay();
				if(rowCount<=50) {
				  $('.dataTables_length').hide();
				  $('.dataTables_paginate').show();
				}
		    }
		});
		
		$(document).on('click','.view',function(e) {
			var name = $(this).data('title');
			var msg = $(this).data('desc');
			var date = $(this).data('created');
			$('#title').html(name);
			$('#msg').html(msg);
			$('#date').html(date);
			$('#reviewsM').modal('show');
		});
		
		$(document).on('click','.del',function() {
			var id = $(this).attr('data-id');
			if(id=="" || id <=0 ) {
				toastr.error('Invalid id,reload this page');
				return false;
			}
			swal({
				title: "Are you sure?",
				text: "you will not be able to recover this record!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url:'<?=base_url("admin/dashboard/delete_project")?>',
						type:'POST',
						dataType:'JSON',
						data:{'id':id},
						success:function(res) {
							if(res=="1") {
								swal("Record deleted successfully!", {
									icon: "success",
								});
								window.location.reload();
							} else {
								swal("Error",res,"error");
							}
						}
					});
					
				} else {
					swal("Your record is safe!");
				}
			});
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