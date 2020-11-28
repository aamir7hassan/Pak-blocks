<div id="colorlib-testimony" class="colorlib-light-grey">
	<div class="container">
		<div class="row">
			<div class="col-md-4 animate-box colorlib-heading animate-box">
				<span class="sm">Testimonial</span>
				<h2><span class="thin">What Our</span> <span class="thick">Client Says</span></h2>
			</div>
			<div class="col-md-7 col-md-push-1">
				<div class="row animate-box">
					<span class="icon"><i class="icon-quotes-left"></i></span>
					<div class="owl-carousel1">
						<?php 
							if(count($reviews)>0) {
							foreach($reviews as $k=>$rev) {
								$name = $rev['name'];
								$email = $rev['email'];
								$msg  = $rev['message'];
								//$cls = $k==0?'active':'';
						?>
						<div class="item">
							<div class="testimony-slide active">
								<div class="testimony-wrap">
									<blockquote>
									<span><?=ucwords($name)?></span>
									<p><?=$msg?></p>
									</blockquote>
								</div>
							</div>
						</div>
						<?php } }?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 