<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
	
add_action( 'widgets_init', 'dronza_recent_posts_entry_widget' );
if( !function_exists('dronza_recent_posts_entry_widget') ){
	function dronza_recent_posts_entry_widget() {
		register_widget( 'Widget_Recent_Posts_Entry' );
	}
}	
	
class Widget_Recent_Posts_Entry extends WP_Widget {

	/**
	 * @internal
	 */
	public function __construct() {
		$widget_ops = array( 'description' => '' );
		parent::__construct( false, esc_attr__( 'Dronza: Recent Posts', 'gridvalley-core' ), $widget_ops );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$category = $instance['category'];
		$num_fetch = $instance['num_fetch'];
		
		$query_args = array(
			'post_type' => 'post',
			'posts_per_page' => $num_fetch,
			'orderby' => 'comment_count',
			'order' => 'desc',
			'paged' => 1,
			'post__not_in' => array(get_the_ID()),
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'post_id',
					'terms'    => $category,
				),
			)
		);
		
		$query = new WP_Query( $query_args );
		
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
		$category = isset($instance['category'])? $instance['category']: '';
		$num_fetch = isset($instance['num_fetch'])? $instance['num_fetch']: 3;
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo esc_attr__('Title :', 'gridvalley-core'); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>		

		<!-- Post Category -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php echo esc_attr__('Category :', 'gridvalley-core'); ?></label>		
			<select class="widefat" name="<?php echo esc_attr($this->get_field_name('category')); ?>" id="<?php echo esc_attr($this->get_field_id('category')); ?>">
				<option value="" <?php if(empty($category)) echo esc_attr__(' selected ','gridvalley-core'); ?>><?php echo esc_attr__('All', 'gridvalley-core') ?></option>
				<?php 	
				$category_list = get_terms('category');
				foreach($category_list as $term){ ?>
					<option value="<?php echo esc_attr($term->term_id); ?>" <?php if ($category == $term->term_id){ echo esc_attr__(' selected ','gridvalley-core');} ?>><?php echo esc_attr($term->name); ?></option>				
					<?php 
				} ?>	
			</select> 
		</p>
			
		<!-- Show Num --> 
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>"><?php echo esc_attr__('Num Fetch :', 'gridvalley-core'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('num_fetch')); ?>" name="<?php echo esc_attr($this->get_field_name('num_fetch')); ?>" type="text" value="<?php echo esc_attr($num_fetch); ?>" />
		</p>
		<?php
	}
}