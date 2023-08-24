<?php
/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dronza_sidebar_registration() {
	
	$footer_col_layout = 'col-lg-4';
	
	if(class_exists('ACF')){
		$footer_col_layout = get_field('footer_column_layout','option');
		
		if(isset($footer_col_layout) && $footer_col_layout <> ''){
			$footer_col_layout = $footer_col_layout;
		}else{
			$footer_col_layout = 'col-lg-4';
		}
	}
	
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'dronza' ),
		'id'            => 'default-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'dronza' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-widget dronza-widget p-a20">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'dronza' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar on Shop posts.', 'dronza' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-widget dronza-widget p-a20">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Pages Custom Sidebar', 'dronza' ),
		'id'            => 'pages-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your pages.', 'dronza' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s sidebar-widget dronza-widget p-a20">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	// Footer
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'dronza' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'dronza' ),
		'before_widget' => '<div id="%1$s" class="'.esc_attr($footer_col_layout).' col-md-6 col-sm-12 %2$s dronza-widget"><div class="widget footer-widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'dronza_sidebar_registration' );