<?php
/**
 * Dronza functions and definitions
 *
 *
 * @package GridValley
 * @subpackage Dronza
 * @since 1.0.0
 */

/**
 * REQUIRED FILES
 * Include required files.
 */

require get_template_directory() . '/inc/includes.php';
 
	if(!function_exists('dronza_sub_header_image')){
	
		function dronza_sub_header_image() {
			
			if( is_home() ){
				$page_id = '';
			} else{
				$page_id = get_the_ID();
			}
			
			if( is_page()){
				if(class_exists('ACF')){
					$header_style = get_field('select_header_style', 'option');
					$page_sub_header_status = get_field('sub_header_status', $page_id);
					if(isset($page_sub_header_status)){
						$page_sub_header_status = $page_sub_header_status;
					}else{
						$page_sub_header_status = 'enable';
					}
					
					if(isset($page_sub_header_status) && $page_sub_header_status == 'enable'){
						$option_sub_header_image = get_field('default_page_subheader_background_image', 'option');
						
						$page_sub_header_image = get_field('sub_header_background_image', $page_id);
						if(isset($page_sub_header_image) && !empty($page_sub_header_image)){
							$sub_bg_image = $page_sub_header_image;
						}else if(isset($option_sub_header_image) && !empty($option_sub_header_image)){
							$sub_bg_image = $option_sub_header_image;
						}else{
							$sub_bg_image = get_template_directory_uri().'/assets/images/inner-banner.jpg';
						}
						
						$custom_css ='.wt-bnr-inr.overlay-wraper.bg-center{background:url('.esc_url($sub_bg_image).');}';
						wp_enqueue_style('dronza-style2',get_template_directory_uri() . '/assets/css/style-empty.css');
						wp_add_inline_style( 'dronza-style2', $custom_css);
					}	
				}
			}else if( is_single() && get_post_type() == 'post' ){

				if(class_exists('ACF')){
					$option_sub_header_image = get_field('default_all_posts_subheader_background_image', 'option');
					if(isset($option_sub_header_image) && $option_sub_header_image <> ''){
						$sub_bg_image = $option_sub_header_image;
						
						$custom_css ='.wt-bnr-inr.overlay-wraper.bg-center{background:url('.esc_url($sub_bg_image).');}';
						wp_enqueue_style('dronza-style2',get_template_directory_uri() . '/assets/css/style-empty.css');
						wp_add_inline_style( 'dronza-style2', $custom_css);
					}
				}
				
			}else if( is_single()){
				
				if(class_exists('ACF')){
					$option_sub_header_image = get_field('default_all_posts_subheader_background_image', 'option');
					if(isset($option_sub_header_image) && $option_sub_header_image <> ''){
						$sub_bg_image = $option_sub_header_image;
						
						$custom_css ='.wt-bnr-inr.overlay-wraper.bg-center{background:url('.esc_url($sub_bg_image).');}';
						wp_enqueue_style('dronza-style2',get_template_directory_uri() . '/assets/css/style-empty.css');
						wp_add_inline_style( 'dronza-style2', $custom_css);
					}
				}
				
			}else if( is_archive() || is_search() || is_author() ){
				
				if(class_exists('ACF')){
					$option_sub_header_image = get_field('default_searcharchive_subheader_background_image', 'option');
					if(isset($option_sub_header_image) && $option_sub_header_image <> ''){
						$sub_bg_image = $option_sub_header_image;
						
						$custom_css ='.wt-bnr-inr.overlay-wraper.bg-center{background:url('.esc_url($sub_bg_image).');}';
						wp_enqueue_style('dronza-style2',get_template_directory_uri() . '/assets/css/style-empty.css');
						wp_add_inline_style( 'dronza-style2', $custom_css);
					}
				}
			}
		}
	}
	
	
	add_action( 'wp_enqueue_scripts', 'dronza_sub_header_image' );	 	