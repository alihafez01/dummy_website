<?php
/*
Plugin Name: GridValley Services
Plugin URI: 
Description: A Custom Post Type Plugin To Use With GridValley Themes ( This plugin functionality might not working properly on another theme )
Version: 1.0.0
Author: GridValley
Author URI: http://www.gridvalley.net
License: 
*/

// add action to create services post type
add_action( 'init', 'gridvalley_create_services' );
if( !function_exists('gridvalley_create_services') ){
	function gridvalley_create_services() {
		register_post_type( 'services',
			array(
				'labels' => array(
					'name'               => esc_attr__('Service', 'gridvalley-core'),
					'singular_name'      => esc_attr__('Service', 'gridvalley-core'),
					'add_new'            => esc_attr__('Add New', 'gridvalley-core'),
					'add_new_item'       => esc_attr__('Add New Service', 'gridvalley-core'),
					'edit_item'          => esc_attr__('Edit Service', 'gridvalley-core'),
					'new_item'           => esc_attr__('New Service', 'gridvalley-core'),
					'all_items'          => esc_attr__('All Services', 'gridvalley-core'),
					'view_item'          => esc_attr__('View Service', 'gridvalley-core'),
					'search_items'       => esc_attr__('Search Service', 'gridvalley-core'),
					'not_found'          => esc_attr__('No Services found', 'gridvalley-core'),
					'not_found_in_trash' => esc_attr__('No Services found in Trash', 'gridvalley-core'),
					'parent_item_colon'  => '',
					'menu_name'          => esc_attr__('Service', 'gridvalley-core')
				),
				'public'             => true,
				'publicly_queryable' => true,
				'rewrite' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,				
				'rewrite'            => array( 'slug' => 'services'  ),
				'menu_icon'    		=> 'dashicons-schedule',
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => true,
				'menu_position'      => 5,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail','excerpt')
			)
		);
		
		// create services categories
		register_taxonomy(
			'services_category', array("services"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => esc_attr__('Service Categories', 'gridvalley-core'), 
				'singular_label' => esc_attr__('Service Category', 'gridvalley-core'), 
				'rewrite' => array( 'slug' => 'services_category'  )));
		register_taxonomy_for_object_type('services_category', 'services');
		
		// add filter to style single template
		add_filter('single_template', 'gridvalley_register_services_template');
		
	}
}

if( !function_exists('gridvalley_register_services_template') ){
	function gridvalley_register_services_template($single_template) {
		global $post;

		if ($post->post_type == 'services') {
			$single_template = dirname( __FILE__ ) . '/single-services.php';
		}
		return $single_template;	
	}
}
	
?>