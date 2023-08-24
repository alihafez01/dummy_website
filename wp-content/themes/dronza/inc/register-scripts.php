<?php
/**
 * Register Scripts for this theme.
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

/**
 * Register and Enqueue Styles.
 */
function dronza_register_styles() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'dronza-fonts', dronza_fonts_url(), array(), null );
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', null, $theme_version);
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/fontawesome/css/font-awesome.min.css', null, $theme_version);
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', null, $theme_version);
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', null, $theme_version);
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css', null, $theme_version);
	wp_enqueue_style( 'bootstrap-select', get_template_directory_uri() . '/assets/css/bootstrap-select.min.css', null, $theme_version);
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.min.css', null, $theme_version);
	wp_enqueue_style( 'loader', get_template_directory_uri() . '/assets/css/loader.min.css', null, $theme_version);
	wp_enqueue_style( 'dronza-style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/css/flaticon.min.css', null, $theme_version);
	wp_enqueue_style( 'dronza-wp-styling', get_template_directory_uri() . '/assets/css/wp-styling.css', null,4);
	wp_enqueue_style( 'dronza-responsive', get_template_directory_uri() . '/assets/css/responsive.css', null, $theme_version);
	wp_enqueue_style( 'dronza-skin-1', get_template_directory_uri() . '/assets/css/skin/skin-1.css', null, $theme_version);
	wp_enqueue_style( 'maxmenu', get_template_directory_uri() . '/assets/css/maxmenu.css', null, $theme_version);
}

add_action( 'wp_enqueue_scripts', 'dronza_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function dronza_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), $theme_version, true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', '', $theme_version, true );
	wp_enqueue_script( 'bootstrap-select', get_template_directory_uri() . '/assets/js/bootstrap-select.min.js', '', $theme_version, true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', '', $theme_version, true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', '', $theme_version, true );
	if(in_array('elementor/elementor.php', apply_filters( 'active_plugins', get_option('active_plugins' )))){
		wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array('elementor-waypoints'), $theme_version, true );
	}else{
		wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array(), $theme_version, true );
	}
	
	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/assets/js/counterup.min.js', '', $theme_version, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', '', $theme_version, true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', '', $theme_version, true );
	wp_enqueue_script( 'stellar', get_template_directory_uri() . '/assets/js/stellar.min.js', '', $theme_version, true );
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js', '', $theme_version, true );
	wp_enqueue_script( 'bootstrap-touchspin', get_template_directory_uri() . '/assets/js/jquery.bootstrap-touchspin.js', '', $theme_version, true );
	wp_enqueue_script( 'bgscroll', get_template_directory_uri() . '/assets/js/jquery.bgscroll.js', '', $theme_version, true );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', '', $theme_version, true );
	wp_enqueue_script( 'maxmenu', get_template_directory_uri() . '/assets/js/maxmenu.js', '', $theme_version, true );
	wp_enqueue_script('dronza-functions', get_template_directory_uri().'/assets/js/functions.js', '', $theme_version, true);
	
	// Localize the script with new data
    $script_array = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce("subscribe_user"),
    );
    wp_localize_script( 'dronza-functions', 'aw', $script_array );
}

add_action( 'wp_enqueue_scripts', 'dronza_register_scripts');