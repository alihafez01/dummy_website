<?php 
	
	/*	
	*	GridValley Services Team
	*	---------------------------------------------------------------------
	*	This file contains services single Team page
	*	---------------------------------------------------------------------
	*/

get_header(); ?>
	<?php while ( have_posts() ){
		the_post(); 
		global $post;
		
		$designation = get_field('designation',$post->ID);
		$experience = get_field('experience',$post->ID);
		$level = get_field('level',$post->ID);
		$phone = get_field('phone',$post->ID);
		$email = get_field('email',$post->ID);
		$facebook_url = get_field('facebook_url',$post->ID);
		$twitter_url = get_field('twitter_url',$post->ID);
		$instagram_url = get_field('instagram_url',$post->ID);
		$linkedin = get_field('linkedin',$post->ID);
		
		?>
		<div class="section-full p-t80 p-b50 bg-gray">
			<div class="container">
				<div class="section-content">
					<div class="section-content">
						<div class="row justify-content-center">
							<div class="col-lg-4 col-md-4 m-b30">
								<div class="wt-team-1">
									<div class="wt-media">
										<?php echo get_the_post_thumbnail($post->ID,'full'); ?>
										<div class="team-social-center">
											<ul class="team-social-bar">
												<li><a href="<?php echo esc_url($facebook_url); ?>"><i class="fa fa-facebook"></i></a></li>
												<li><a href="<?php echo esc_url($twitter_url); ?>"><i class="fa fa-twitter"></i></a></li>
												<li><a href="<?php echo esc_url($instagram_url); ?>"><i class="fa fa-instagram"></i></a></li>
												<li><a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
											</ul>
											
										</div>                                              
									</div>
									<div class="wt-info p-a30  p-b0">
										<div class="team-detail  text-center">
											<h3 class="m-t0 team-name"><?php echo the_title(); ?></h3>
											<span class="title-style-2 team-position site-text-primary"><?php echo esc_attr($designation); ?></span>
										</div>
									</div>
							
								</div>
							</div>
							<div class="col-lg-8 col-md-8 m-b30">
								<div class="wt-team-1-single">
									<h3 class="m-t0"><?php echo esc_attr__('About Me','gridvalley-core'); ?></h3>
									<?php the_content(); ?>
									<ul class="wt-team-1-single-info bg-white">
										<li><span><?php echo esc_attr__('Position','gridvalley-core'); ?></span><span><?php echo esc_attr($designation); ?></span></li>
										<li><span><?php echo esc_attr__('Level','gridvalley-core'); ?></span><span><?php echo esc_attr($level); ?></span></li>
										<li><span><?php echo esc_attr__('Experience','gridvalley-core'); ?></span><span><?php echo esc_attr($experience); ?></span></li>
										<li><span><?php echo esc_attr__('Phone','gridvalley-core'); ?></span><span><?php echo esc_attr($phone); ?></span></li>
										<li><span><?php echo esc_attr__('Email','gridvalley-core'); ?></span><span><?php echo esc_attr($email); ?></span></li>
									</ul> 
								</div>
							</div>  
						</div>
					</div>  
				</div>
			</div>
		</div>
		<?php
		$contact_form = get_field('contact_form','option');
		if($contact_form <> ''){ ?>
			<div class="section-full p-t80 p-b50 bg-white">
				<div class="container">
					<div class="section-content">
							<div class="section-content">
								<div class="row d-flex justify-content-center">
									<div class="col-lg-8 col-md-12 col-sm-12">
										<div class="home-contact-section site-bg-primary m-b30 p-a40">
											<?php echo do_shortcode($contact_form); ?>                                
										</div>

									</div>
								</div>
							</div>      
					</div>
				</div>
			</div>	
			<?php
		}
	} ?>
<?php get_footer(); ?>