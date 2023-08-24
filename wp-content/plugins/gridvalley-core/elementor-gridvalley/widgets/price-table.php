<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Price_Table extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'price-table';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Price Table', 'gridvalley-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fas fa-th-large';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'dronza' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'price_table',
			[
				'label' => __( 'Price Table', 'gridvalley-core' ),
			]
		);
		
		$this->add_control(
			'element_title',
			[
				'label' => __( 'Element Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		$this->add_control(
			'element_caption',
			[
				'label' => __( 'Element Caption', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		$repeater->add_control(
			'currency',
			[
				'label' => __( 'Currency symbol', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		$repeater->add_control(
			'price',
			[
				'label' => __( 'Price', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		$repeater->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		
		$repeater->add_control(
			'button_url',
			[
				'label' => __( 'Button Url', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gridvalley-core' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		
		$this->add_control(
			'price_tables',
			[
				'label' => __( 'Price Tables', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Enter Title', 'gridvalley-core' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();	
		global $dronza_allowed_html;
		?>
		
		<div class="section-full p-t80 p-b50">
			<!-- TITLE START-->
			<div class="section-head center wt-small-separator-outer text-center">
				<div class="wt-small-separator site-text-primary">
					<div  class="sep-leaf-left"></div>
					<div><?php echo esc_attr($settings['element_caption']); ?></div>
					<div  class="sep-leaf-right"></div>
				</div>
				<h2><?php echo esc_attr($settings['element_title']); ?></h2>
			</div>
			<!-- TITLE END-->
			<div class="section-content">
				<div class="pricingtable-row">
					<div class="row d-flex justify-content-center">
						<?php
						$custom_counter = 0;
						foreach($settings['price_tables'] as $index => $table_item){
							if($custom_counter == 1){
								$active = 'pricingtable-highlight';
							}else{
								$active = '';
							} ?>
							
							<div class="col-lg-4 col-md-6 col-sm-12 m-b30">
								<div class="pricingtable-wrapper">
									<div class="pricingtable-inner <?php echo esc_attr($active); ?>">	
										<div class="pricing-table-top-section">
											<div class="pricingtable-title">
												<h2 class="title-style-2"><?php echo esc_attr($table_item['title']); ?></h2>
											</div>	
											<div class="pricingtable-price">
												<h2 class="pricingtable-bx"><sup class="pricingtable-sign"><?php echo esc_attr($table_item['currency']); ?></sup><?php echo esc_attr($table_item['price']); ?></h2>
											</div>
										</div>
										<ul class="pricingtable-features">
											<?php echo wp_kses($table_item['description'],$dronza_allowed_html); ?>                                                
										</ul>
										
										<div class="pricingtable-footer">
											<a href="<?php echo esc_url($table_item['button_url']['url']); ?>" class="site-button site-btn-effect"><?php echo esc_attr($table_item['button_text']); ?></a>
										</div>
									
									</div>
								</div>
							</div>
							<?php
							$custom_counter++;
						} ?>
					</div>
				</div>
			</div>  
		</div>
		<?php
	}
}