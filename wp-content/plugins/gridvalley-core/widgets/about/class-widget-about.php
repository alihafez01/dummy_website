<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
	
add_action( 'widgets_init', 'dronza_about_widget' );
if( !function_exists('dronza_about_widget') ){
	function dronza_about_widget() {
		register_widget( 'Widget_About' );
	}
}	
	
class Widget_About extends WP_Widget {

	/**
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array( 'description' => '' );
		parent::__construct( false, esc_attr__( 'Dronza: About Widget', 'gridvalley-core' ), $widget_ops );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );	
		$widget_phone = $instance['widget_phone'];	
		$widget_address = $instance['widget_address'];	
		$widget_email = $instance['widget_email'];	
		
		require_once ('views/widget.php');

	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$title = isset($instance['title'])? $instance['title']: '';
		$widget_address = isset($instance['widget_address'])? $instance['widget_address']: '';
		$widget_phone = isset($instance['widget_phone'])? $instance['widget_phone']: '';
		$widget_email = isset($instance['widget_email'])? $instance['widget_email']: '';
			
		?>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_attr__('Title :', 'gridvalley-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('widget_address')); ?>"><?php echo esc_attr__('Address:', 'gridvalley-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_address')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_address')); ?>" type="text" value="<?php echo esc_attr($widget_address); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('widget_email')); ?>"><?php echo esc_attr__('First Email address:', 'gridvalley-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_email')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_email')); ?>" type="text" value="<?php echo esc_attr($widget_email); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('widget_phone')); ?>"><?php echo esc_attr__('First Phone Number:', 'gridvalley-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_phone')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_phone')); ?>" type="text" value="<?php echo esc_attr($widget_phone); ?>" />
		</p>
		<?php
	}
}