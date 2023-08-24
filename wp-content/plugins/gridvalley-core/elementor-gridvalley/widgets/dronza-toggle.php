<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Dronza_Toggle extends Widget_Base {

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
		return 'dronza-toggle';
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
		return __( 'Dronza Toggle', 'gridvalley-core' );
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
			'dronza_toggle',
			[
				'label' => __( 'Dronza Toggle', 'gridvalley-core' ),
			]
		);
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' => __( 'Enter Title', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'description', [
				'label' => __( 'Enter Description', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Description' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'toggles',
			[
				'label' => __( 'Toggles', 'gridvalley-core' ),
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
		<div class="section-full p-t50 p-b50">
			<div class="section-content">
				<!-- Accordian -->
				<div class="wt-accordion acc-bdr faq-accorfion" id="accordion5">
					<?php
					$custom_counter = 0;
					foreach($settings['toggles'] as $accordion){ ?>	
						<div class="panel wt-panel">
							<div class="acod-head <?php echo esc_attr($custom_counter == 0 ? 'acc-actives' : ''); ?>">
								<h4 class="acod-title">
									<a data-toggle="collapse" class="<?php echo esc_attr($custom_counter == 0 ? '' : 'collapsed'); ?>" href="#collapse-<?php echo esc_attr($custom_counter); ?>" data-parent="#accordion5" > 
										<?php echo esc_attr($accordion['title']); ?>
										<span class="indicator"><i class="fa fa-plus"></i></span>
									</a>
								</h4>
							</div>
							<div id="collapse-<?php echo esc_attr($custom_counter); ?>" class="acod-body <?php echo esc_attr($custom_counter == 0 ? '' : 'collapse'); ?>">
								<div class="acod-content">
									<p><?php echo wp_kses($accordion['description'],$dronza_allowed_html); ?></p>
								</div>
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