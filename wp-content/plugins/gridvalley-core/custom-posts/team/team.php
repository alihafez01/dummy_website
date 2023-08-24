<?php
/*
Plugin Name: GridValley Team
Plugin URI: 
Description: A Custom Post Type Plugin To Use With GridValley Themes ( This plugin functionality might not working properly on another theme )
Version: 1.0.0
Author: GridValley
Author URI: http://www.gridvalley.net
License: 
*/

// add action to create team post type
add_action( 'init', 'gridvalley_create_team' );
if( !function_exists('gridvalley_create_team') ){
	function gridvalley_create_team() {
			
		$team_slug = 'team';
		$team_category_slug = 'team_category';
		$team_tag_slug = 'team_tag';		
		
		register_post_type( 'team',
			array(
				'labels' => array(
					'name'               => esc_attr__('Team', 'gridvalley-core'),
					'singular_name'      => esc_attr__('Team', 'gridvalley-core'),
					'add_new'            => esc_attr__('Add New', 'gridvalley-core'),
					'add_new_item'       => esc_attr__('Add New Team', 'gridvalley-core'),
					'edit_item'          => esc_attr__('Edit Team', 'gridvalley-core'),
					'new_item'           => esc_attr__('New Team', 'gridvalley-core'),
					'all_items'          => esc_attr__('All Team', 'gridvalley-core'),
					'view_item'          => esc_attr__('View Team', 'gridvalley-core'),
					'search_items'       => esc_attr__('Search Team', 'gridvalley-core'),
					'not_found'          => esc_attr__('No Team found', 'gridvalley-core'),
					'not_found_in_trash' => esc_attr__('No Team found in Trash', 'gridvalley-core'),
					'parent_item_colon'  => '',
					'menu_name'          => esc_attr__('Team', 'gridvalley-core')
				),
				'public'             => true,
				'publicly_queryable' => false,
				'rewrite' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,				
				'rewrite'            => array( 'slug' => $team_slug  ),
				'capability_type'    => 'post',
				'menu_icon'    		=> 'dashicons-admin-users',
				'has_archive'        => true,
				'hierarchical'       => true,
				'menu_position'      => 5,
				'supports'           => array( 'title', 'editor', 'thumbnail')
			)
		);
		
		// create team categories
		register_taxonomy(
			'team_category', array("team"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => esc_attr__('Team Categories', 'gridvalley-core'), 
				'singular_label' => esc_attr__('Team Category', 'gridvalley-core'), 
				'rewrite' => array( 'slug' => $team_category_slug  )));

		// add filter to style single template
		add_filter('single_template', 'gridvalley_register_team_template');
		
	}
}

if( !function_exists('gridvalley_register_team_template') ){
	function gridvalley_register_team_template($single_template) {
		global $post;

		if ($post->post_type == 'team') {
			$single_template = dirname( __FILE__ ) . '/single-team.php';
		}
		return $single_template;	
	}
}	
?>