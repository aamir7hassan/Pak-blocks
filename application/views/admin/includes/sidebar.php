<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<a href="javascript:;" data-toggle="nav-profile">
					<div class="cover with-shadow"></div>
					<div class="image">
						<img src="../assets/img/user/user-13.jpg" alt="" />
					</div>
					<div class="info">
						<b class="caret pull-right"></b>Admin	
						<small>Dashboard</small>
					</div>
				</a>
			</li>
			<li>
				<ul class="nav nav-profile">
					<li><a href="<?=_url('admin/update-profile')?>"><i class="fa fa-cog"></i> Profile</a></li>
				</ul>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav"><li class="nav-header">Navigation</li>	
			<li> 
				<a href="<?=base_url('admin/index');?>">
					<i class="fab fa-simplybuilt"></i>
					<span>Dashboard</span> 
				</a>
			</li>
			<li> 
				<a href="<?=base_url('admin/products');?>">
					<i class="fa fa-calendar-alt"></i>
					<span>Products</span> 
				</a>
			</li>
			<li> 
				<a href="<?=base_url('admin/reviews');?>">
					<i class="fa fa-users"></i>
					<span>Reviews</span> 
				</a>
			</li>
			<li> 
				<a href="<?=base_url('admin/projects');?>">
					<i class="fab fa-simplybuilt"></i>
					<span>Projects</span> 
				</a>
			</li>
			<!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			<!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
		