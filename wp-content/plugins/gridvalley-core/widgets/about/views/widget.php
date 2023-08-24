<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_title
 * @var string $after_title
 * @var string $before_widget
 * @var string $after_widget
 */
	global $dronza_allowed_html;
	// Opening of widget
	echo wp_kses($before_widget,$dronza_allowed_html);
	
	?>
	<div class="recent-posts-entry">
		<?php 
		if( !empty($title) ){
			echo wp_kses($args['before_title'], $dronza_allowed_html) . esc_attr($title) . $args['after_title']; 
		} ?>                            
	   <ul class="widget_address"> 
			<li><i class="fa fa-map-marker"></i><?php echo esc_attr($widget_address);?></li>
			<li><i class="fa fa-envelope"></i><?php echo esc_attr($widget_email);?></li>
			<li> <i class="fa fa-phone"></i><?php echo esc_attr($widget_phone);?></li>
		</ul>  
	</div>
	<?php
	
	echo wp_kses($after_widget,$dronza_allowed_html);