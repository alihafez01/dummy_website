<?php
namespace ElementorGridValley;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'elementor-gridvalley', plugins_url('dronza-core/elementor-gridvalley/assets/js/gridvalley.js'));
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/services-section.php' );
		require_once( __DIR__ . '/widgets/about-info.php' );
		require_once( __DIR__ . '/widgets/shop-products.php' );
		require_once( __DIR__ . '/widgets/gallery-section.php' );
		require_once( __DIR__ . '/widgets/team-section.php' );
		require_once( __DIR__ . '/widgets/testimonials.php' );
		require_once( __DIR__ . '/widgets/news-section.php' );
		require_once( __DIR__ . '/widgets/clients-section.php' );
		require_once( __DIR__ . '/widgets/info-section.php' );
		require_once( __DIR__ . '/widgets/facts.php' );
		require_once( __DIR__ . '/widgets/price-table.php' );
		require_once( __DIR__ . '/widgets/dronza-toggle.php' );
		require_once( __DIR__ . '/widgets/contact-info.php' );
		require_once( __DIR__ . '/widgets/dronza-sidebar.php' );
		// require_once( __DIR__ . '/widgets/fancy-heading.php' );
		
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Services_Section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\About_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Shop_Products() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Gallery_Section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Team_Section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\News_Section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Clients_Section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Facts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Info_section() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Price_Table() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Dronza_Toggle() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Contact_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Dronza_Sidebar() );
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Fancy_Heading() );
		
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();