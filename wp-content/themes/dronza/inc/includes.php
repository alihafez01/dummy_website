<?php
	/**
	 * Custom Includes this theme.
	 *
	 * @package WordPress
	 * @subpackage Dronza
	 * @since 1.0.0
	 */
	
	require get_template_directory() . '/inc/template-tags.php';
	// Custom comment walker.
	require get_template_directory() . '/classes/class-dronza-walker-comment.php';
	// styles-scripts.
	require get_template_directory() . '/inc/register-scripts.php';
	// color-scheme.
	require get_template_directory() . '/inc/color-scheme.php';
	// Widget Areas
	require get_template_directory() . '/inc/register-widget-areas.php';
	// TGM Library
	require get_template_directory() . '/inc/tgmpa/tgm_plugins.php';

	/**
	 * @param FW_Ext_Backups_Demo[] $demos
	 * @return FW_Ext_Backups_Demo[]
	 */
	function dronza_filter_theme_fw_ext_backups_demos($demos) {
		$demos_array = array(
			'dronza-dummy' => array(
				'title' => esc_html__('Dronza', 'dronza'),
				'screenshot' => get_template_directory_uri() . '/screenshot.png',
				'preview_link' => esc_url('gridvalley.net/wp/dronza')
			)
			// ...
		);

		$download_url = esc_url('gridvalley.net/dronza_importer/');

		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);

			$demos[ $demo->get_id() ] = $demo;

			unset($demo);
		}

		return $demos;
	}
	add_filter('fw:ext:backups-demo:demos', 'dronza_filter_theme_fw_ext_backups_demos');
	
	/**
	 * Overwrite default more tag with styling and screen reader markup.
	 *
	 * @param string $html The default output HTML for the more tag.
	 *
	 * @return string $html
	 */
	if(!function_exists('dronza_read_more_tag')){
		function dronza_read_more_tag( $html ) {
			return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', esc_attr(get_the_title( get_the_ID() ) )), $html );
		}
	}

	add_filter( 'the_content_more_link', 'dronza_read_more_tag' );
	/**
	 * Register custom fonts.
	 */
	if(!function_exists('dronza_fonts_url')){
		function dronza_fonts_url() {
			$fonts_url = '';
			$font_families = array();
			$font_families[] = 'Rajdhani:300,400,500,600,700';
			$font_families[] = 'Muli:200,300,400,500,600,700,800,900';
			
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => '',
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			
			return esc_url_raw( $fonts_url );
		}
	}
	
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	
	if(!function_exists('dronza_theme_support')){
		function dronza_theme_support() {

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );
			
			if(class_exists('WooCommerce')){
				add_theme_support( 'woocommerce' );
				add_theme_support( 'wc-product-gallery-zoom' );
				add_theme_support( 'wc-product-gallery-lightbox' );
				add_theme_support( 'wc-product-gallery-slider' );
			}
			
			// Custom background color.
			add_theme_support(
				'custom-background',
				array(
					'default-color' => 'f5efe0',
				)
			);

			// Set content-width.
			global $content_width;
			if ( ! isset( $content_width ) ) {
				$content_width = 580;
			}

			/*
			 * Enable support for Post Thumbnails on posts and pages.
			 *
			 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
			 */
			add_theme_support( 'post-thumbnails' );

			// Set post thumbnail size.
			set_post_thumbnail_size( 1200, 9999 );

			// Add custom image size used in dronza.
			add_image_size( 'dronza-post-medium', 500, 356, true );
			
			
			// Custom logo.
			$logo_width  = 120;
			$logo_height = 90;

			// If the retina setting is active, double the recommended width and height.
			if ( get_theme_mod( 'retina_logo', false ) ) {
				$logo_width  = floor( $logo_width * 2 );
				$logo_height = floor( $logo_height * 2 );
			}

			add_theme_support(
				'custom-logo',
				array(
					'height'      => $logo_height,
					'width'       => $logo_width,
					'flex-height' => true,
					'flex-width'  => true,
				)
			);

			/*
			 * Let WordPress manage the document title.
			 * By adding theme support, we declare that this theme does not use a
			 * hard-coded <title> tag in the document head, and expect WordPress to
			 * provide it for us.
			 */
			add_theme_support( 'title-tag' );

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
				)
			);

			// Add support for full and wide align images.
			add_theme_support( 'align-wide' );

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

		}	
	} 
	
	add_action( 'after_setup_theme', 'dronza_theme_support' );
	
	add_action( 'init', 'dronza_load_theme_textdomain' );
  
	/**
	 * Load theme textdomain.
	 */
	function dronza_load_theme_textdomain() {
	  load_theme_textdomain( 'dronza', get_template_directory() . '/languages' ); 
	}

	global $dronza_allowed_html;
	$dronza_allowed_html = 
		array(
		'a' => array(
				'id' => array(),
				'class' => array(),
				'rel' => array(),
				'data-commentid' => array(),
				'data-postid' => array(),
				'data-belowelement' => array(),
				'data-respondelement' => array(),
				'aria-label' => array(),
				'href' => array(),
				'title' => array()
			),
		'div' => array('id' => array(),'class' => array()),
		'img' => array(
				'id' => array(),
				'src' => array(),
				'alt' => array(),
				'width' => array(),
				'height' => array(),
				'loading' => array(),
				'srcset' => array(),
				'sizes' => array(),
				'class' => array(),
			),
		'h1' => array('id' => array(),'class' => array()),
		'h2' => array('id' => array(),'class' => array()),
		'h3' => array('id' => array(),'class' => array()),
		'h4' => array('id' => array(),'class' => array()),
		'h5' => array('id' => array(),'class' => array()),
		'h6' => array('id' => array(),'class' => array()),
		'p' => array('id' => array(),'class' => array()),
		'i' => array('id' => array(),'class' => array()),
		'ins' => array('id' => array(),'class' => array()),
		'ul' => array('id' => array(),'class' => array()),
		'del' => array('id' => array(),'class' => array()),
		'li' => array('id' => array(),'class' => array()),
		'span' => array('id' => array(),'class' => array()),
		'br' => array(),
		'em' => array(),
		'strong' => array(),
	);

	if( function_exists('acf_add_options_page') ) {
		
		acf_add_options_page(array(
			'page_title' 	=> esc_html__('Theme Options','dronza'),
			'menu_title'	=> esc_html__('Theme Options','dronza'),
			'menu_slug' 	=> 'theme-general-Options',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));
	}

	/**
	 * Register navigation menus uses wp_nav_menu in five places.
	 */
	if(!function_exists('dronza_menus')){
		function dronza_menus() {

			$locations = array(
				'primary'  => esc_html__( 'Main Menu', 'dronza' ),
				'footer_menu'  => esc_html__( 'Footer Menu', 'dronza' ),
			);

			register_nav_menus( $locations );
		}	
	}
	

	add_action( 'init', 'dronza_menus' );
	
	add_filter('wp_generate_tag_cloud', 'gridvalley_tag_cloud',10,3);

	function gridvalley_tag_cloud($tag_string){
	  return preg_replace('/style=("|\')(.*?)("|\')/','',$tag_string);
	}

	if ( ! function_exists( 'wp_body_open' ) ) {

		/**
		 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
		 */
		function wp_body_open() {
			do_action( 'wp_body_open' );
		}
	}

	// Breadcrumbs
	if(!function_exists('dronza_breadcrumbs')){
		function dronza_breadcrumbs() {
			   
			// Settings
			$separator          = '';
			$breadcrums_id      = 'breadcrumbs';
			$breadcrums_class   = 'wt-breadcrumb breadcrumb-style-2';
			$home_title         = esc_html__('Home','dronza');
			  
			// Get the query & post information
			global $post,$wp_query,$dronza_allowed_html;
			   
			// Do not display on the homepage
			if ( !is_front_page() ) {
			   
				// Build the breadcrums
				echo '<ul id="' . esc_attr($breadcrums_id) . '" class="' . esc_attr($breadcrums_class) . '">';
				   
				// Home page
				echo '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url(get_home_url()) . '" title="' . esc_attr($home_title) . '">' . esc_attr($home_title) . '</a></li>';
				
				   
				if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
					  
					echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . get_the_archive_title() . '</strong></li>';
					  
				} else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
					  
					// If post is a custom post type
					$post_type = get_post_type();
					  
					// If it is a custom post type display name and link
					if($post_type != 'post') {
						  
						$post_type_object = get_post_type_object($post_type);
						$post_type_archive = get_post_type_archive_link($post_type);
					  
						echo '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr($post_type) . '" href="' . esc_url($post_type_archive) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . esc_attr($post_type_object->labels->name) . '</a></li>';
					}
					  
					$dronza_tax_name = get_queried_object()->name;
					echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . esc_attr($dronza_tax_name) . '</strong></li>';
					  
				} else if ( is_single() ) {
					  
					// If post is a custom post type
					$post_type = get_post_type();
					  
					// If it is a custom post type display name and link
					if($post_type != 'post') {
						  
						$post_type_object = get_post_type_object($post_type);
						$post_type_archive = get_post_type_archive_link($post_type);
					  
						echo '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr($post_type) . '" href="' . esc_url($post_type_archive) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . esc_attr($post_type_object->labels->name) . '</a></li>';
					}
					  
					// Get post category info
					$category = get_the_category();
					 
					if(!empty($category)) {
					  
						// Get last category post is in
						$last_category = end($category);
						  
						// Get parent any categories and create array
						$get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
						$cat_parents = explode(',',$get_cat_parents);
						  
						// Loop through parent categories and store in variable $cat_display
						$cat_display = '';
						foreach($cat_parents as $parents) {
							$cat_display .= '<li class="item-cat">'.$parents.'</li>';
						}
					 
					}
					
					// If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
					if($post_type == 'services'){
						$dronza_taxonomy    = 'services_category';
					}else if($post_type == 'projects'){
						$dronza_taxonomy    = 'projects_category';
					}else if($post_type == 'product'){
						$dronza_taxonomy    = 'product_cat';
					}else if($post_type == 'team'){
						$dronza_taxonomy    = 'team_category';
					}else if($post_type == 'post'){
						$dronza_taxonomy    = 'category';
					}
					
					  
					// If it's a custom post type within a custom taxonomy
					$taxonomy_exists = taxonomy_exists($dronza_taxonomy);
					if(empty($last_category) && !empty($dronza_taxonomy) && $taxonomy_exists) {
						   
						$taxonomy_terms = get_the_terms( $post->ID, $dronza_taxonomy );
						$cat_id         = $taxonomy_terms[0]->term_id;
						$cat_nicename   = $taxonomy_terms[0]->slug;
						$cat_link       = get_term_link($taxonomy_terms[0]->term_id, $dronza_taxonomy);
						$cat_name       = $taxonomy_terms[0]->name;
					   
					}
					  
					// Check if the post is in a category
					if(!empty($last_category)) {
						echo wp_kses($cat_display,$dronza_allowed_html);
						echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '" title="' . esc_attr(get_the_title()) . '">' . wp_kses(get_the_title(),$dronza_allowed_html) . '</span></li>';
						  
					// Else if post is in a custom taxonomy
					} else if(!empty($cat_id)) {
						  
						echo '<li class="item-cat item-cat-' . esc_attr($cat_id) . ' item-cat-' . esc_attr($cat_nicename) . '"><a class="bread-cat bread-cat-' . esc_attr($cat_id) . ' bread-cat-' . esc_attr($cat_nicename) . '" href="' . esc_url($cat_link) . '" title="' . esc_attr($cat_name) . '">' . esc_attr($cat_name) . '</a></li>';
						echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '" title="' . esc_attr(get_the_title()) . '">' . esc_attr(get_the_title()) . '</span></li>';
					  
					} else {
						echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '" title="' . esc_attr(get_the_title()) . '">' . wp_kses(get_the_title(),$dronza_allowed_html) . '</span></li>';
					}
					  
				} else if ( is_category() ) {
					   
					// Category page
					echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
					   
				} else if ( is_page() ) {
					   
					// Standard page
					if( $post->post_parent ){
						   
						// If child page, get parents 
						$anc = get_post_ancestors( $post->ID );
						   
						// Get parents in the right order
						$anc = array_reverse($anc);
						   
						// Parent page loop
						if ( !isset( $parents ) ) $parents = null;
						foreach ( $anc as $ancestor ) {
							$parents .= '<li class="item-parent item-parent-' . esc_attr($ancestor) . '"><a class="bread-parent bread-parent-' . esc_attr($ancestor) . '" href="' . esc_url(get_permalink($ancestor)) . '" title="' . esc_attr(get_the_title($ancestor)) . '">' . esc_attr(get_the_title($ancestor)) . '</a></li>';
						}
						   
						// Display parent pages
						echo wp_kses($parents,$dronza_allowed_html);
						   
						// Current page
						echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span title="' . esc_attr(get_the_title()) . '"> ' . wp_kses(get_the_title(),$dronza_allowed_html) . '</span></li>';
						   
					} else {
						   
						// Just display current page if not parents
						echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '"> ' . wp_kses(get_the_title(),$dronza_allowed_html) . '</span></li>';
						   
					}
					   
				} else if ( is_tag() ) {
					   
					// Tag page
					   
					// Get tag information
					$term_id        = get_query_var('tag_id');
					$taxonomy       = 'post_tag';
					$args           = 'include=' . $term_id;
					$terms          = get_terms( $taxonomy, $args );
					$get_term_id    = $terms[0]->term_id;
					$get_term_slug  = $terms[0]->slug;
					$get_term_name  = $terms[0]->name;
					   
					// Display the tag name
					echo '<li class="item-current item-tag-' . esc_attr($get_term_id). ' item-tag-' . esc_attr($get_term_slug) . '"><strong class="bread-current bread-tag-' . esc_attr($get_term_id) . ' bread-tag-' . esc_attr($get_term_slug) . '">' . esc_attr($get_term_name) . '</strong></li>';
				   
				} elseif ( is_day() ) {
					   
					// Day archive
					   
					// Year link
					echo '<li class="item-year item-year-' . esc_attr(get_the_time('Y')) . '"><a class="bread-year bread-year-' . esc_attr(get_the_time('Y')) . '" href="' . esc_url(get_year_link( get_the_time('Y') )) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_attr(get_the_time('Y')) . esc_html__('Archives','dronza') . '</a></li>';
					 
					// Month link
					echo '<li class="item-month item-month-' . esc_attr(get_the_time('m')) . '"><a class="bread-month bread-month-' . esc_attr(get_the_time('m')) . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . esc_attr(get_the_time('M')) . '">' . esc_attr(get_the_time('M')) . esc_html__('Archives','dronza') . '</a></li>';
					 
					// Day display
					echo '<li class="item-current item-' . esc_attr(get_the_time('j')) . '"><strong class="bread-current bread-' . esc_attr(get_the_time('j')) . '"> ' . esc_attr(get_the_time('jS')) . ' ' . esc_attr(get_the_time('M'))  . esc_html__('Archives','dronza'). '</strong></li>';
					   
				} else if ( is_month() ) {
					   
					// Month Archive
					   
					// Year link
					echo '<li class="item-year item-year-' . esc_attr(get_the_time('Y')) . '"><a class="bread-year bread-year-' . esc_attr(get_the_time('Y')) . '" href="' . esc_url(get_year_link( get_the_time('Y') )) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_attr(get_the_time('Y')) . esc_html__('Archives','dronza'). '</a></li>';
					  
					// Month display
					echo '<li class="item-month item-month-' . esc_attr(get_the_time('m')) . '"><strong class="bread-month bread-month-' . esc_attr(get_the_time('m')) . '" title="' . esc_attr(get_the_time('M')) . '">' . esc_attr(get_the_time('M')) . esc_html__('Archives','dronza'). '</strong></li>';
					   
				} else if ( is_year() ) {
					   
					// Display year archive
					echo '<li class="item-current item-current-' . esc_attr(get_the_time('Y')) . '"><strong class="bread-current bread-current-' . esc_attr(get_the_time('Y')) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_attr(get_the_time('Y')) . esc_html__('Archives','dronza') .'</strong></li>';
					   
				} else if ( is_author() ) {
					   
					// Auhor archive
					   
					// Get the author information
					global $author;
					$userdata = get_userdata( $author );
					   
					// Display author name
					echo '<li class="item-current item-current-' . esc_attr($userdata->user_nicename) . '"><strong class="bread-current bread-current-' . esc_attr($userdata->user_nicename) . '" title="' . esc_attr($userdata->display_name) . '">' . esc_html__('Author: ','dronza') . esc_attr($userdata->display_name) . '</strong></li>';
				   
				} else if ( get_query_var('paged') ) {
					   
					// Paginated archives
					echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.esc_html__('Page','dronza') . ' ' . get_query_var('paged') . '</strong></li>';
					   
				} else if ( is_search() ) {
				   
					// Search results page
					echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">' . esc_html__(' Search results for: ','dronza') . get_search_query() . '</strong></li>';
				   
				} elseif ( is_404() ) {
					   
					// 404 page
					echo '<li>' . esc_html__('Error 404','dronza') . '</li>';
				}
				echo '</ul>';  
			}else{
				echo'<ul class="wt-breadcrumb breadcrumb-style-2">
							<li><a href="#">'.esc_html__('Home','dronza').'</a></li>
							<li>'.esc_html__('Blogs','dronza').'</li>
						</ul>';
			}  
		}	
	}
	
	if(!function_exists('dronza_get_post_thumbnail')){
		function dronza_get_post_thumbnail($post_id,$post_format,$format_value,$thumbnail_size){
			
			$return = '';
			
			if($post_format == 'gallery'){
				$return .= '
				<div id="post-slider" class="owl-carousel owl-theme"> ';
					foreach($format_value as $gallery){
						$return .= '
							<div class="item">
								'.wp_get_attachment_image( $gallery['attachment_id'], $thumbnail_size).'
							</div>';	
					}
					$return .= '
				</div> ';
				
			}else if($post_format == 'youtube-video'){
			if(has_post_thumbnail($post_id)){
				$return .= '
				<div class="wt-post-media wt-img-effect clear zoom-slow">
						<a href="'.esc_url($format_value).'" class="mfp-video play-now">
						'.wp_get_attachment_image( get_post_thumbnail_id($post_id), $thumbnail_size).'
						</a>
				</div>';
			}else{
				$return .= '
				<div class="wt-post-media wt-img-effect clear zoom-slow">
					<iframe width="560" height="315" src="'.esc_url($format_value).'"></iframe>
				</div>';
			}
			
		}else if($post_format == 'vimeo-video'){
			if(has_post_thumbnail($post_id)){
				$return .= '
				<div class="wt-post-media wt-img-effect clear zoom-slow">
						<a href="'.esc_url($format_value).'" class="mfp-video play-now">
						'.wp_get_attachment_image( get_post_thumbnail_id($post_id), $thumbnail_size).'
						</a>
				</div>';
			} else{
				$return .= '
				<div class="wt-post-media wt-img-effect clear zoom-slow">
					<iframe src="'.esc_url($format_value).'" width="560" height="315" ></iframe>
				</div>';	
			}
		}else if($post_format == 'soundcloud-audio'){
			$return = $format_value;
		}else{
			$return = get_the_post_thumbnail($post_id,$thumbnail_size );
		}
			return $return;
		}
	}
	
	if( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option('active_plugins' )))){
		
		/**
		 * Remove the breadcrumbs 
		 */
		add_action( 'init', 'dronza_remove_wc_actions' );
		if(!function_exists('dronza_remove_wc_actions')){
			function dronza_remove_wc_actions() {
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20, 0 );
				add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20, 0 );
			}
		}
		
		
		/**
		 * Change number or products per row
		*/
		
		add_filter('loop_shop_columns', 'dronza_loop_columns');
		if (!function_exists('dronza_loop_columns')) {
			function dronza_loop_columns() {
				if(class_exists('ACF')) {
					$products_per_row = get_field('products_per_row','option');
					if(isset($products_per_row) && !empty($products_per_row)){
						$products_per_row = $products_per_row;
					}else{
						$products_per_row = '3';
					}
				} else {
					$products_per_row = '3';
				}
				return $products_per_row; // 3 products per row
			}
		}
		
		/**
		 * Change number of products that are displayed per page (shop page)
		 */
		add_filter( 'loop_shop_per_page', 'dronza_new_loop_shop_per_page', 20 );
		if (!function_exists('dronza_new_loop_shop_per_page')) {
			function dronza_new_loop_shop_per_page( $cols ) {
				// Return the number of products you wanna show per page.
				if(class_exists('ACF')) {
					$products_per_page = get_field('products_per_page','option');
					if(isset($products_per_page) && !empty($products_per_page)){
						$products_per_page = $products_per_page;
					}else{
						$products_per_page = '6';
					}
				} else {
					$products_per_page = '6';
				}
					
				return $products_per_page;
			}
		}
	}
	
	if(class_exists('ACF')) {
		//// ADD FAVICON //////
		function gridvalley_favicon() {
			$favicon = get_field('favicon','option');
			?>
			<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" >
			<?php 
		}
		add_action('wp_head', 'gridvalley_favicon');
	}