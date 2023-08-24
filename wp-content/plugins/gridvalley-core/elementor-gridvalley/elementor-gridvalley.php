<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Elementor GridValley Class
 *
 * The init class that runs the plugin.

 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Elementor_GridValley {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}
	
	/**
	 * Initialize the plugin
	 * @since 1.2.0
	 * @access public
	 */
	public function init() {

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}
}

// Instantiate Elementor_GridValley.
new Elementor_GridValley();
