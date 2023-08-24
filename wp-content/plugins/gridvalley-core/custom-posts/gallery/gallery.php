<?php
/*
Plugin Name: GridValley Gallery
Plugin URI: 
Description: A Custom Post Type Plugin To Use With GridValley Themes ( This plugin functionality might not working properly on another theme )
Version: 1.0.0
Author: GridValley
Author URI: http://www.gridvalley.net
License: 
*/

// add action to create gallery post type
add_action( 'init', 'gridvalley_create_gallery' );
if( !function_exists('gridvalley_create_gallery') ){
	function gridvalley_create_gallery() {

		$gallery_slug = 'gallery';
		$gallery_category_slug = 'gallery_category';
		$gallery_tag_slug = 'gallery_tag';		
		
		register_post_type( 'gallery',
			array(
				'labels' => array(
					'name'               => esc_attr__('Gallery', 'gridvalley-core'),
					'singular_name'      => esc_attr__('Gallery', 'gridvalley-core'),
					'add_new'            => esc_attr__('Add New', 'gridvalley-core'),
					'add_new_item'       => esc_attr__('Add New Gallery', 'gridvalley-core'),
					'edit_item'          => esc_attr__('Edit Gallery', 'gridvalley-core'),
					'new_item'           => esc_attr__('New Gallery', 'gridvalley-core'),
					'all_items'          => esc_attr__('All Gallery', 'gridvalley-core'),
					'view_item'          => esc_attr__('View Gallery', 'gridvalley-core'),
					'search_items'       => esc_attr__('Search Gallery', 'gridvalley-core'),
					'not_found'          => esc_attr__('No Gallery found', 'gridvalley-core'),
					'not_found_in_trash' => esc_attr__('No Gallery found in Trash', 'gridvalley-core'),
					'parent_item_colon'  => '',
					'menu_name'          => esc_attr__('Gallery', 'gridvalley-core')
				),
				'public'             => true,
				'publicly_queryable' => true,
				'rewrite' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,				
				'rewrite'            => array( 'slug' => $gallery_slug  ),
				'capability_type'    => 'post',
				'menu_icon'    		=> 'dashicons-format-gallery',
				'has_archive'        => true,
				'hierarchical'       => true,
				'menu_position'      => 5,
				'supports'           => array( 'title','editor', 'thumbnail','excerpt')
			)
		);
		
		// create gallery categories
		register_taxonomy(
			'gallery_category', array("gallery"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => esc_attr__('Gallery Categories', 'gridvalley-core'), 
				'singular_label' => esc_attr__('Gallery Category', 'gridvalley-core'), 
				'rewrite' => array( 'slug' => $gallery_category_slug  )));

		// add filter to style single template
		add_filter('single_template', 'gridvalley_register_gallery_template');
		
	}
}

if( !function_exists('gridvalley_register_gallery_template') ){
	function gridvalley_register_gallery_template($single_template) {
		global $post;

		if ($post->post_type == 'gallery') {
			$single_template = dirname( __FILE__ ) . '/single-gallery.php';
		}
		return $single_template;	
	}
}	
?>