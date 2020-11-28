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
			</ol>
			<h1 class="page-header">Dashboard</h1>
			<div class="row">
				<!-- begin col-3 -->
				<div class="col-xl-4 col-md-6">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon"><i class="fa fa-dollar-sign"></i></div>
						<div class="stats-info">
							<h4>Today Net Sale</h4>
							<p><?=number_format($today_sale,2)?></p>	
						</div>
						<div class="stats-link">
							<a href="<?=base_url('admin/sales')?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-md-6">
					<div class="widget widget-stats bg-orange">
						<div class="stats-icon"><i class="fa fa-dollar-sign"></i></div>
						<div class="stats-info">
							<h4>Today Borrowed Sale</h4>
							<p><?=number_format($borrowed,2)?></p>	
						</div>
						<div class="stats-link">
							<a href="<?=base_url('admin/sales');?>">View Detail<i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-xl-4 col-md-6">
					<div class="widget widget-stats bg-info">
						<div class="stats-icon"><i class="fa fa-dollar-sign"></i></div>
						<div class="stats-info">
							<h4>Today Total Sale</h4>
							<p><?=number_format(($today_sale + $borrowed),2)?></p>	
						</div>
						<div class="stats-link">
							<a href="<?=base_url('admin/sales')?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-inverse">
				<div class="panel-heading">
					<h4 class="panel-title">Dashboard</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="<?=base_url('admin/make-sale')?>" class="btn btn-xs btn-success" > Make Sale </a>
						<a href="<?=base_url('admin/products')?>" class="btn btn-xs btn-green" > Products </a>
						<a href="<?=base_url('admin/companies')?>" class="btn btn-xs btn-indigo" > Companies </a>
						<a href="<?=base_url('admin/users')?>" class="btn btn-xs btn-lime" > Users </a>
						<a href="<?=base_url('admin/sales')?>" class="btn btn-xs btn-warning" > Sales </a>
					</div>
				</div>
				<div class="panel-body  pr-1">
					<div id="interactive-chart" class="height-sm"></div>
				</div>
			</div>
		</div>
		<!-- #content -->
	</div>
	<?php 
		$this->load->view($prefix.'foot');
		$pre="";
	?>
	<script src=<?=base_url($pre."/assets/plugins/flot/jquery.flot.js");?>></script>
	<script src=<?=base_url($pre."/assets/plugins/flot/jquery.flot.time.js");?>></script>
	<script src=<?=base_url($pre."/assets/plugins/flot/jquery.flot.resize.js");?>></script>
	<script src=<?=base_url($pre."/assets/plugins/flot/jquery.flot.pie.js");?>></script>
	<script src=<?=base_url($pre."/assets/plugins/jquery-sparkline/jquery.sparkline.min.js");?>></script>
	<script src=<?=base_url($pre."/assets/plugins/jvectormap-next/jquery-jvectormap.min.js");?>></script>
	<script src=<?=base_url($pre."/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js");?>></script>
	<script src=<?=base_url($pre."/assets/js/demo/dashboard.js");?>></script>
	<script>
		var handleInteractiveChart = function () {
			"use strict";
			function showTooltip(x, y, contents) {
				$('<div id="tooltip" class="flot-tooltip">' + contents + '</div>').css( {
					top: y - 45,
					left: x - 55
				}).appendTo("body").fadeIn(200);
			}
			if ($('#interactive-chart').length !== 0) {
				
				var data1 = [ 
					<?php 
						
						
						$last = date('t');
						if(count($today)>0){
						$max = max(array_column($today,'total'));
						}else {$max=0;}
						for($a=1;$a<=$last;$a++) {
							$price=0;
							$ke = array_search($a,array_column($today,'day'));
							
							if($ke==0 && $a==$today[$ke]['day']) {
								$price = $today[$ke]['total'];
							}
							else if($ke==false) {
								$price = 0;
							} else {
								$price = $today[$ke]['total'];
							}
					?>
					[<?=$a?>, <?=$price?>],
					<?php } ?>
				];
				var xLabel = [
					<?php 
						$last = date('t');
						$month = date('M');
							for($a=1;$a<=$last;$a++) {
					?>
					[<?=$a?>,'<?=$month?>&nbsp;<?=$a?>'],
					<?php $price=0;} ?>
				];
				$.plot($("#interactive-chart"), [{
						data: data1, 
						label: "Total Sale", 
						color: COLOR_BLUE,
						lines: { show: true, fill:false, lineWidth: 2 },
						points: { show: true, radius: 3, fillColor: COLOR_WHITE },
						shadowSize: 0
					}], {
						xaxis: {  ticks:xLabel, tickDecimals: 0, tickColor: COLOR_DARK_TRANSPARENT_2 },
						yaxis: {  ticks: 10, tickColor: COLOR_DARK_TRANSPARENT_2, min: 0, max: <?=$max?> },
						grid: { 
						hoverable: true, 
						clickable: true,
						tickColor: COLOR_DARK_TRANSPARENT_2,
						borderWidth: 1,
						backgroundColor: 'transparent',
						borderColor: COLOR_DARK_TRANSPARENT_2
					},
					legend: {
						labelBoxBorderColor: COLOR_DARK_TRANSPARENT_2,
						margin: 10,
						noColumns: 1,
						show: true
					}
				});
				var previousPoint = null;
				$("#interactive-chart").bind("plothover", function (event, pos, item) {
					$("#x").text(pos.x.toFixed(2));
					$("#y").text(pos.y.toFixed(2));
					if (item) {
						if (previousPoint !== item.dataIndex) {
							previousPoint = item.dataIndex;
							$("#tooltip").remove();
							var y = item.datapoint[1].toFixed(2);

							var content = item.series.label + " " + y;
							showTooltip(item.pageX, item.pageY, content);
						}
					} else {
						$("#tooltip").remove();
						previousPoint = null;            
					}
					event.preventDefault();
				});
			}
		};
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