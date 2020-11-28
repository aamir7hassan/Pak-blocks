<?php 
	$seg = $this->uri->segment(1);
	
?>
<nav class="colorlib-nav" role="navigation">
	<div class="top-menu">
		<div class="container">
			<div class="row">
				<div class="col-xs-2">
					<div id="colorlib-logo"><a href="<?=base_url()?>">Pak Blocks</a></div>
				</div>
				<div class="col-xs-10 text-right menu-1">
					<ul>
						<li class="<?php echo $seg=='' || $seg=='index'? 'active':'';?>"><a href="<?=base_url()?>">Home</a></li>
						<li class="<?php echo $seg=='projects'?'active':'';?>"><a href="<?=base_url('projects')?>">Projects</a></li>
						<li class="<?= $seg=='products'?'active':'';?>"><a href="<?=base_url('products');?>">Products</a></li>
						<li class="<?=$seg=='about-us'?'active':'';?>"><a href="<?=base_url('about-us')?>">About</a></li>
						<li class="<?=$seg=='contact-us'?'active':'';?>"><a href="<?=base_url('contact-us');?>">Contact</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>