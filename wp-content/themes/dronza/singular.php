<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

get_header();
	
?>

<div class="section-full  p-t80 bg-white-new">
	<div class="container">
		<!-- BLOG SECTION START -->
		<div class="section-content">
			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					global $post,$dronza_allowed_html;
					$comment_count = wp_count_comments( $post->ID );
					$comment_count = $comment_count->total_comments;
					
					$default_terms = get_the_term_list($post->ID,'post_tag');
					$post_categories = wp_get_post_categories( $post->ID );
					$post_tags = wp_get_post_tags( $post->ID, 'post_tag');
					$post_format = '';
					$enable_social_share = 'false';
					if(class_exists('ACF')){
						$post_format = get_field('post_format',$post->ID);
						$enable_social_share = get_field('enable_social_share','option');
					
						if($post_format <> ''){
							if($post_format == 'youtube-video'){
								$format_value = get_field('add_youtube_video_url',$post->ID);
							}else if($post_format == 'vimeo-video'){
								$format_value = get_field('add_vimeo_video_url',$post->ID);
							}else if($post_format == 'gallery'){
								$format_value = get_field('add_image_gallery',$post->ID);
							}else if($post_format == 'soundcloud-audio'){
								$format_value = get_field('audio_soundcloud_embed_code',$post->ID);
							}else{
								$image_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full' );
								$format_value = '';
							}	
						}
					}
					if(has_post_thumbnail()){
						$img_class = '';
					}else{
						$img_class = 'no_img_detail';
					}
					?>
					<div class="post-content-parent">
						<?php
						if(isset($post_format) && $post_format <> ''){
							if($post_format == 'image'){
								if(has_post_thumbnail()){
									?>
									<div class="wt-post-media wt-img-effect zoom-slow">
										<?php echo get_the_post_thumbnail($post->ID,'full' );?> 
									</div>
									<?php
								}
							}else{ ?>
								<?php echo dronza_get_post_thumbnail($post->ID,$post_format,$format_value,'full');  ?>
								<?php
							}	
						}else{
							if(has_post_thumbnail()){
								?>
								<div class="wt-post-media wt-img-effect zoom-slow">
									<?php echo get_the_post_thumbnail($post->ID,'full' );?> 
								</div>
								<?php
							} 
						} ?>
						<div class="row justify-content-center">
							<div class="col-lg-10 col-md-10 col-sm-12">
								<div class="blog-post blog-full-detail blog-lg">
									<div class="blog-full-detail-info <?php echo esc_attr($img_class); ?>">
										<div class="wt-post-info  bg-white">
											<div class="wt-post-title ">
												<h2 class="post-title"><?php the_title(); ?></h2>
											</div>
											<div class="post-meta">
												<span class="posted-on"><?php echo esc_html__('Posted on','dronza'); ?>
													<a href="#"><?php echo esc_attr(get_the_date(get_option( 'date_format' ))); ?></a>
												</span>
												<span class="byline"> <?php echo esc_html__('by','dronza'); ?> <span class="author">
													<?php echo get_the_author_link(); ?></span>
												</span>
											</div>
											<div class="wt-post-text">
												<?php 
												the_content();
												wp_link_pages( array(
													'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dronza' ) . '</span>',
													'after'       => '</div>',
													'link_before' => '<span class="page-number">',
													'link_after'  => '</span>',
													'pagelink'    => '%',
													'separator'   => '',
												) ); ?>
											</div>
										</div>
										<?php 
										if(has_tag()){
											$custom_count_tags = 0;
											$count_post_tags = count($post_tags);											
											?>
											<div class="tags-inline">
												<span class="cat-links">
													<?php
													if(isset($post_tags) && $post_tags <> ''){ ?>
														<?php
														foreach($post_tags as $t){
															$custom_count_tags++;
															if($custom_count_tags == $count_post_tags){
																$sep_format = ' ';
															}else{
																$sep_format = ' ';
															}
															
															$tag = get_tag( $t ); ?>
															<a href="<?php echo get_tag_link($t); ?>"><?php echo esc_attr($tag->name); ?></a><?php echo esc_attr($sep_format); ?>
															<?php
														}
													}
													?>
												</span> 
											</div>
											<?php 
										}
										
										if(function_exists('dronza_get_social_shares') && $enable_social_share == 'true'){ ?>
											<div class="share-wrapper">
												<div class="dronza-social-share">
													<a href="#" class="post-share"><i class="fa fa-share fa-fw"></i></a>
													<?php echo dronza_get_social_shares($post->ID); ?>
												</div>
												<div class="comments-wrapper">
													<a href="#">
													<i class="fa fa-comments"></i>
													<span><?php echo esc_attr($comment_count); ?></span>
													</a>
												</div>
											</div>
											<?php
										} 
										if(get_next_post() || get_previous_post()){
											$prevPost = get_previous_post(); 
											$nextPost = get_next_post(); 
											
											?>
											<div class="post-detail-pagination previous-next previous next">
												<?php 
												if(!empty($prevPost)){ ?>
													<div class="paging-left paging-item">
														<div class="paging-content"> 
															<a class="paging-link" href="<?php echo esc_url(get_permalink($prevPost->ID)); ?>">
																<i class="fa fa-angle-left"></i>
																<?php echo esc_html__('Previous Post', 'dronza'); ?>
															</a>
															<h3 class="paging-title">
																<a href="<?php echo esc_url(get_permalink($prevPost->ID)); ?>"><?php echo esc_attr(get_the_title($prevPost->ID)); ?></a>
															</h3>
														</div>
													</div>
													<?php
												}
												if(!empty($nextPost)){ ?>
													<div class="paging-right paging-item">
														<div class="paging-content"> 
															<a class="paging-link" href="<?php echo esc_url(get_permalink($nextPost->ID)); ?>"><?php echo esc_html__('Next Post', 'dronza'); ?> 
																<i class="fa fa-angle-right"></i> 
															</a>
															<h3 class="paging-title">
																<a href="<?php echo esc_url(get_permalink($nextPost->ID)); ?>"><?php echo esc_attr(get_the_title($nextPost->ID)); ?></a>
															</h3>
														</div>
													</div>
													<?php
												} ?>
											</div> 
											<?php	
										} ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
					if(get_the_author_meta('description') <> ''){ ?>
						<div class="post-author-detail">
							<figure>
							   <?php echo get_avatar(get_the_author_meta('ID'), 99); ?>
							</figure>
							<div class="author_meta">
								<h5><?php the_author_posts_link(); ?></h5>
								<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
							</div>
						</div>
						<?php 
					} ?>
					<?php comments_template( '', true ); ?>	
					<?php
				}
			} 	?> 
		</div>
	</div>
</div>

<?php get_footer(); ?>