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
				<li class="breadcrumb-item active">Reviews</li>
			</ol>
			<h1 class="page-header">Reviews</h1>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Reviews</h4>
					<div class="panel-heading-btn">
						<a href="<?=base_url('admin/products')?>"  class="btn btn-xs btn-green" >Products</a>
						<a href="<?=base_url('admin/projects')?>"  class="btn btn-xs btn-indigo" >Projects</a>
					</div>
				</div>
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th>Sr.</th>
								<th>Name</th>
								<th>Email</th>
								<th>Status</th>
								<th>Created</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach($items as $k=>$cat) {
									$id = $cat['review_id'];
									$created = date('F d, Y',strtotime($cat['created']));
									$name = $cat['name'];
									$email = $cat['email'];
									$st = $cat['approved'];
									$msg = $cat['message'];
									if($st=="1") {
										$status = '<span class="text-success">Published</span>';
										$title="Mark as pending";
										$btn = "Published";
									} else {
										$status = '<span class="text-danger">Pending</span>';
										$title="Publish";
										$btn = "Publish";
									}
							?>
								<tr>
									<td><?=$k+1;?></td>
									<td><?=ucwords($name);?></td>
									<td><?=$email;?></td>
									<td><?=$status;?></td>
									<td><?=$created?></td>
									<td>
										<center>
										<ul class="list-inline">
											<li class="list-inline-item"><a href="#" class="btn btn-xs btn-info publish" data-id="<?=$id?>" title="<?=$title?>" data-st="<?=$st?>"><?=$btn?></a></li>
											
											<li class="list-inline-item"><a href="#" data-name="<?=$name?>" data-msg="<?=$msg?>" data-email="<?=$email?>" data-date="<?=$created?>" data-status="<?=$st?>" data-id="<?=$id?>" class="btn btn-xs btn-indigo view icons">View</a></li>
											
											<li class="list-inline-item"><a href="#" data-id="<?=$id?>" class="btn btn-xs btn-danger del icons">Delete</a></li>
										</ul>
										</center>
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
						<h4 class="modal-title">Review's Detail</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<th>Name</th><td id="name"></td>
								</tr>
								<tr>
									<th>Email</th><td id="email"></td>
								</tr>
								<tr>
									<th>Message</th><td id="msg"></td>
								</tr>
								<tr>
									<th>Status</th><td id="status"></td>
								</tr>
								<tr>
									<th>Review Date</th><td id="date"></td>
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
			responsive: true,
			pageLength:50
		});
		
		$(document).on('click','.view',function(e) {
			var name = $(this).data('name');
			var email = $(this).data('email');
			var msg = $(this).data('msg');
			var date = $(this).data('date');
			var status = $(this).data('status');
			$('#name').html(name);
			$('#email').html(email);
			$('#msg').html(msg);
			$('#date').html(date);
			if(status=="1") {
				var v = '<span class="text-success">Published</span>';
			} else {
				var v = '<span class="text-danger">Pending</span>';
			}
			$('#status').html(v);
			$('#reviewsM').modal('show');
		});
		
		
		$(document).on('click','.publish',function() {
			var id = $(this).attr('data-id');
			var st = $(this).attr('data-st');
			if(id=="" || id <=0 ) {
				toastr.error('Invalid id,reload this page');
				return false;
			}
			swal({
				title: "Are you sure?",
				text: "you will be able to recover this record!",
				icon: "warning",
				buttons: true,
				dangerMode: true,
			})
			.then((willDelete) => {
				if (willDelete) {
					$.ajax({
						url:'<?=base_url("admin/dashboard/publish_review")?>',
						type:'POST',
						dataType:'JSON',
						data:{'id':id,'status':st},
						success:function(res) {
							if(res=="1") {
								swal("Record updated successfully!", {
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
						url:'<?=base_url("admin/dashboard/delete_review")?>',
						type:'POST',
						dataType:'JSON',
						data:{'req':'del_company','id':id},
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