<?php
/**
 * The default template for displaying content
 *
 * Used for index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */
	global $post;
	$comment_count = wp_count_comments( $post->ID );
	$comment_count = $comment_count->total_comments;
	if($comment_count == 1){
		$dronza_comment_format = esc_html__('Comment','dronza');
	}else{
		$dronza_comment_format = esc_html__('Comments','dronza');
	}
	$post_categories = wp_get_post_categories( $post->ID );
	$custom_count_cats = 0;
	$count_post_categories = count($post_categories);
?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		
		<div class="blog-post date-style-2 blog-full">
			<?php 
			if(has_post_thumbnail()){
				$post_type = 'img_post';
				?>
				<div class="wt-post-media wt-img-effect zoom-slow">
					<a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo get_the_post_thumbnail($post->ID,'full'); ?></a>
				</div>
				<?php
			}else{
				$post_type = 'no_img';
			} ?>
			<div class="wt-post-info <?php echo esc_attr($post_type); ?>">
				<div class="wt-post-meta ">
					<ul>
						<li class="post-date"><?php echo esc_attr(get_the_date(get_option('date_format'))); ?></li>
						<li class="post-comment"><?php echo esc_attr($comment_count); ?> <?php echo esc_attr($dronza_comment_format); ?></li>                                      
					</ul>
				</div>                                  
				<div class="wt-post-title ">
					<h3 class="post-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="site-text-secondry"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
					<?php the_excerpt(); ?>
				</div>
				<div class="wt-post-readmore ">
					<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="site-button site-btn-effect"><?php echo esc_html__('Read More','dronza'); ?></a>
				</div>                                        
			</div>                                
		</div>
	</article><!-- .post -->
