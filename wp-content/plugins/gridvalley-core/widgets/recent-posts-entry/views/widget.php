<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_title
 * @var string $after_title
 * @var string $before_widget
 * @var string $after_widget
 */
	global $dronza_allowed_html;

	echo wp_kses($before_widget,$dronza_allowed_html);

	if($query->have_posts()){ ?>   
		<div class="recent-posts-entry">
			<?php
			if( !empty($title) ){ 
				echo wp_kses($args['before_title'],$dronza_allowed_html) . esc_attr($title) . $args['after_title']; 
			}
			?>
			<div class="section-content">
				<div class="widget-post-bx">
				   <?php
					while($query->have_posts()){ $query->the_post(); global $post;
						$comment_count = wp_count_comments( $post->ID );
						$comment_count = $comment_count->total_comments;
						if($comment_count == 1){
							$dronza_comment_format = esc_attr__('Comment','gridvalley-core');
						}else{
							$dronza_comment_format = esc_attr__('Comments','gridvalley-core');
						}
						?>
						<div class="widget-post clearfix">
							<div class="wt-post-media">
								<?php echo get_the_post_thumbnail($post->ID,'thumbnail'); ?>
							</div>
							<div class="wt-post-info">
								<div class="wt-post-meta">
									<ul>
										<li class="post-author"><?php echo esc_attr(get_the_date('d F')); ?></li>
									</ul>
								</div>                                            
								<div class="wt-post-header">
									<a href="<?php echo esc_url(get_permalink());?>" class="post-title"><?php echo esc_attr(get_the_title()); ?></a>
								</div>
							</div>
						</div>
						<?php
					} ?>
				</div>
			</div>
		</div>
		<?php
	}
	wp_reset_postdata();
	echo wp_kses($after_widget,$dronza_allowed_html); ?>