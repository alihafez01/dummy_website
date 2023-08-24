<?php 
	/*	
	*	GridValley Gallery
	*	---------------------------------------------------------------------
	*	This file contains gallery single page
	*	---------------------------------------------------------------------
	*/
get_header(); ?>
	<?php while ( have_posts() ){
		the_post(); 
		global $post;
		
		$gallery_images = get_field('gallery_images',$post->ID);
		
		?>
		<div class="section-full p-t80">
			<div class="container">
				<div class="section-content"> 
					<div class="owl-carousel project-detail-slider owl-btn-vertical-center mfp-gallery">
						<?php 
						foreach($gallery_images as $image){ ?>
							<div class="item">
								<div class="project-img-effect-1">
									<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>" />
								</div>
							</div> 
							<?php
						} ?>
					</div>
				</div> 
			</div>
		</div>  
		<div class="section-full p-t50 p-b80">
			<div class="container">
				<div class="sing-gallery-detail">
					<?php the_content(); ?>
				</div>   
		   </div>
		</div>
		<?php
	} ?>
<?php get_footer(); ?>