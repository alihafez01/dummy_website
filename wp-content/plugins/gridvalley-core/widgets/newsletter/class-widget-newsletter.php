<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

add_action( 'widgets_init', 'dronza_newsletter_widget' );
if( !function_exists('dronza_newsletter_widget') ){
	function dronza_newsletter_widget() {
		register_widget( 'Widget_Newsletter' );
	}
}	
	
class Widget_Newsletter extends WP_Widget {

	/**
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array( 'description' => '' );
		parent::__construct( false, esc_attr__( 'Dronza: Newsletter Widget', 'gridvalley-core' ), $widget_ops );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$description = $instance['description'];
		$caption = $instance['caption'];
		
		include ('views/widget.php');
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
		$description = isset($instance['description'])? $instance['description']: '';
		$caption = isset($instance['caption'])? $instance['caption']: '';
		
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_attr__('Title :', 'gridvalley-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('description')); ?>"><?php echo esc_attr__('Description :', 'gridvalley-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('description')); ?>" name="<?php echo esc_attr($this->get_field_name('description')); ?>" type="text" value="<?php echo esc_attr($description); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('caption')); ?>"><?php echo esc_attr__('Caption :', 'gridvalley-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('caption')); ?>" name="<?php echo esc_attr($this->get_field_name('caption')); ?>" type="text" value="<?php echo esc_attr($caption); ?>" />
		</p>
	<?php
	}
}