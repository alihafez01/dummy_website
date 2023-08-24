<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_title
 * @var string $after_title
 * @var string $before_widget
 * @var string $after_widget
 */

	global $dronza_allowed_html;
	
	echo wp_kses($before_widget,$dronza_allowed_html);
	?>
		<form method="post" id="gridvalley-submit-form" data-ajax="" data-security="<?php wp_create_nonce('gridvalley-create-nonce'); ?>" data-action="newsletter_mailchimp">                           
			<div class="widget_newsletter">
				<?php	
				if( !empty($title) ){
					echo wp_kses($args['before_title'],$dronza_allowed_html) . esc_attr($title) . $args['after_title']; 
				}
				?>
				<p><?php echo esc_attr($description); ?></p>
				<div class="newsletter-input">
				  <div class="input-group">
						<input id="newsletter_email" name="newsletter_email" type="text" class="form-control" placeholder="<?php echo esc_attr__('Enter your email','gridvalley-core');?>">
						<div class="input-group-append">
						<button type="submit" class="input-group-text nl-search-btn text-black site-bg-primary title-style-2"><?php echo esc_attr__('Subscribe','gridvalley-core');?></button>
						</div>
					</div>
				</div>
			</div>
		</form>
	<?php 
	echo wp_kses($after_widget,$dronza_allowed_html); ?>