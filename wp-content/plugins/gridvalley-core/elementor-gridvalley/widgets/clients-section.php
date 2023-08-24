<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Clients_Section extends Widget_Base {

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
		return 'clients-section';
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
		return __( 'Clients Section', 'gridvalley-core' );
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
			'clients_section',
			[
				'label' => __( 'Clients Section', 'gridvalley-core' ),
			]
		);
		
		$this->add_control(
			'select_style',
			[
				'label' => __( 'Select Style', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1', 'gridvalley-core' ),
				],
			]
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'external_url', [
				'label' => __( 'External Link', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'External Link' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'client_image',[
				'label' => __('Client Image', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'clients_repeater',
			[
				'label' => __( 'Clients', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'external_url' => __( 'External Link', 'gridvalley-core' ),
					],
				],
				'title_field' => '{{{ external_url }}}',
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
		
		if($settings['select_style'] == 'style1'){ ?>
			
			<div class="section-full p-tb50">
                <div class="container-fluid">
                     <div class="section-content p-tb30 owl-btn-vertical-center">
                        <div class="owl-carousel home-client-carousel-2">
							<?php 
							foreach($settings['clients_repeater'] as $index => $item){ ?>
								<div class="item">
									<div class="ow-client-logo">
										<div class="client-logo client-logo-media">
											<a href="<?php echo esc_url($item['external_url']); ?>">
												<img src="<?php echo esc_url($item['client_image']['url']); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>">
											</a>
										</div>
									</div>
								</div>
								<?php
							} ?> 
                        </div>
                    </div>
                </div>
            </div>
			
			<?php 
		}else{ ?>
			
			<?php
		}
	}
}