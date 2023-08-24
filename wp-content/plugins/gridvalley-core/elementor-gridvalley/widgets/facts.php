<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Facts extends Widget_Base {

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
		return 'facts';
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
		return __( 'Facts', 'gridvalley-core' );
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
			'facts',
			[
				'label' => __( 'Facts', 'gridvalley-core' ),
			]
		);
		
		$this->add_control(
			'select_style',
			[
				'label' => __( 'Select Style', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1'  => __( 'Style 1', 'gridvalley-core' ),
				],
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
			'value',
			[
				'label' => __( 'Value', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		
		$this->add_control(
			'project_facts',
			[
				'label' => __( 'Facts List', 'gridvalley-core' ),
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
		
		if($settings['select_style'] == 'style1'){ ?>
			
			<div class="section-full counter-outer3 p-t80 p-b50">
				<div class="section-content"> 
					<div class="counter-outer">  
						<div class="row justify-content-center">
							<?php
							$custom_counter = 0;
							foreach($settings['project_facts'] as $index => $fact_item){
								?>    
								<div class="col-lg-3 col-md-6 col-sm-6 col-6 m-b30 ">
									<div class="counter-box">
										<h2 class="counter"><?php echo esc_attr($fact_item['value']); ?></h2>
										<span class="site-text-primary title-style-2"><?php echo esc_attr($fact_item['title']); ?></span>
									</div>
								</div>
								<?php
							} ?>
						</div>                            
					
					</div> 
				</div> 
            </div>
			<?php
		}else if($settings['select_style'] == 'style2'){ ?>
			
			<?php
		}else if($settings['select_style'] == 'style3'){ ?>
			
			<?php
		}
		?>
		<?php
	}
}