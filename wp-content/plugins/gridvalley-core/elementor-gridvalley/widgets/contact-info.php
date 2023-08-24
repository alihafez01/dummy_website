<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Contact_Info extends Widget_Base {

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
		return 'contact-info';
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
		return __( 'Contact Info', 'gridvalley-core' );
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
			'contact_info',
			[
				'label' => __( 'Contact Info', 'gridvalley-core' ),
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		$this->add_control(
			'caption',
			[
				'label' => __( 'Caption', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'info_title', [
				'label' => __( 'Info Title', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Info Title' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'info_description', [
				'label' => __( 'Enter Info Description', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Service Description' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'contact_infos',
			[
				'label' => __( 'Contact Info', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'info_title' => __( 'Enter Info Title', 'gridvalley-core' ),
					],
				],
				'title_field' => '{{{ info_title }}}',
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
		<div class="contact-info">
			<div class="contact-info-inner">
				<!-- TITLE START-->
				<div class="section-head left wt-small-separator-outer">
					<div class="wt-small-separator site-text-primary">
						<div class="sep-leaf-left"></div>
						<div> <?php echo esc_attr($settings['caption']); ?></div>
						<div class="sep-leaf-right"></div>
					</div>
					<h2><?php echo esc_attr($settings['title']); ?></h2>
					
				</div>
				<!-- TITLE END-->
				<div class="contact-info-section">  
					<?php
					$custom_counter = 1;
					$info_count = count($settings['contact_infos']);
					foreach($settings['contact_infos'] as $index => $contact_info){
						if($info_count == $custom_counter){
							$margin = '';
						}else{
							$margin = 'm-b30';
						}
						?>	
						<div class="wt-icon-box-wraper left <?php echo esc_attr($margin); ?>">
							<div class="icon-content">
								<span class="m-t0"><?php echo esc_attr($contact_info['info_title']); ?></span>
								<p><?php echo wp_kses($contact_info['info_description'],$dronza_allowed_html); ?></p>
							</div>
						</div>
						<?php
						$custom_counter++;
					} ?>
				</div>
			</div>
		</div>
		<?php
	}
}