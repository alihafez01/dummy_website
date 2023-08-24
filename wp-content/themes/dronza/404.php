	<?php
/**
 * The template for displaying the 404 template in the Dronza theme.
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

get_header();
	
	$custom_css ='.error-full-page.bg-image-moving{background-image:url('.esc_url(get_template_directory_uri()).'/assets/images/bg-2.jpg);}';

	wp_enqueue_style('industroz-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
	wp_add_inline_style( 'industroz-inline-style', $custom_css);
?>
	<div class="page-content">
		<div class="error-full-page bg-cover overlay-wraper bg-image-moving">
			<div class="overlay-main bg-black opacity-07"></div>
			<div class="error-full-page-inner">
				<div class="error-full-page-inner-info">
					<div class="error-media">
						<img src="<?php echo esc_url(get_template_directory_uri()) ?>/assets/images/404.png"  class="slide-top"  alt="<?php echo esc_attr__('404 image','dronza'); ?>">
					</div>
					<h3 class="title-style-2"><?php echo esc_html__('Error','dronza'); ?></h3>
					<strong><?php echo esc_html__('404','dronza'); ?></strong>
					<h4 class="title-style-2">
						<?php echo esc_html__('Oops! Looks like the page is gone.','dronza'); ?>
					</h4>
					<p><?php echo esc_html__('We’re sorry but we can’t seem to find the page you requested. This might be because you have typed the web address incorrectly.','dronza'); ?></p>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="site-button site-btn-effect"><?php echo esc_html__('GO TO HOME','dronza'); ?></a>
				</div>
			</div>
		</div>   
		<!-- Error  SECTION END -->  
    </div>
<?php
get_footer();