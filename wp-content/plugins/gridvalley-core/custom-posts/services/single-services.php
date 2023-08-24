<?php
	/*	
	*	GridValley Services Single
	*	---------------------------------------------------------------------
	*	This file contains services single detail page
	*	---------------------------------------------------------------------
	*/

	get_header(); 
	
	
	while ( have_posts() ){ 
		the_post(); 
		global $post;
		
		$service_images = get_field('service_images',$post->ID);
		?>
		<div class="section-full  p-t80 p-b80" >
			<div class="section-content">     
				<div class="container">
					<div class="services-large-block-outer">
						<div class="service-detail-for">
							<?php 
							foreach($service_images as $image){ ?>
								<div class="services-large">
									<div class="services-large-media"><?php echo wp_get_attachment_image($image, 'full' ); ?></div>
									<div class="services-large-info">
										<h3 class="services-title site-text-white"><?php echo esc_attr(get_the_title($image)); ?></h3>
									</div>
								</div>
								<?php
							} ?>	
						</div>
						<div  class="services-large-thumb service-detail-nav">
							<?php 
							foreach($service_images as $image){ ?>
								<div class="services-thumb">
									<div class="services-thumb-media"><?php echo wp_get_attachment_image($image, 'full' ); ?></div>
								</div>
								<?php
							} ?>
						</div>
					</div>
					<div class="wt-box services-etc">
						<div class="wt-info">
							<?php the_content(); ?>   
						</div>
					</div>
				</div>
			</div>
		</div> 
		<?php
	} ?>
	<?php get_footer(); ?>