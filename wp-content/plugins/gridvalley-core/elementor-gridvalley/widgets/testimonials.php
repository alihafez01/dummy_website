<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Testimonials extends Widget_Base {

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
		return 'testimonials';
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
		return __( 'Testimonials', 'gridvalley-core' );
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
			'testimonials',
			[
				'label' => __( 'Testimonials', 'gridvalley-core' ),
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
					'style2' => __( 'Style 2', 'gridvalley-core' ),
				],
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
		
		$this->add_control(
			'drone_image',
			[
				'label' => __('Drone Image', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'select_style' => [ 'style1','style2'],
				]
			]
		);
		
		$this->add_control(
			'section_bg_image',
			[
				'label' => __('Section Background Image', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'select_style' => [ 'style1','style2'],
				]
			]
		);
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'name', [
				'label' => __( 'Name', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Name' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'designation', [
				'label' => __( 'Designation', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Designation' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'quote',[
				'label' => __( 'Quote', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		
		$repeater->add_control(
			'testimonial_image',[
				'label' => __('Testimonial Image', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'testimonials_repeater',
			[
				'label' => __( 'Testimonials', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Enter Name', 'gridvalley-core' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);
		
		$this->add_control(
			'section_title',
			[
				'label' => __( 'Section Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style2'],
				]
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

		if($settings['select_style'] == 'style1'){
			
			$custom_css ='.section-full.testimonial-1-outer{background-image:url('.esc_url($settings['section_bg_image']['url']).');}';

			wp_enqueue_style('industroz-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
			wp_add_inline_style( 'industroz-inline-style', $custom_css);
			?>
			<div class="section-full  p-t80 p-b50 testimonial-1-outer bg-cover bg-center bg-image-moving">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-12">
                            <!-- TITLE START-->
                            <div class="left wt-small-separator-outer text-white">
                                <div class="wt-small-separator">
                                    <div  class="sep-leaf-left"></div>
                                    <div><?php echo esc_attr($settings['element_caption']); ?></div>
                                    <div  class="sep-leaf-right"></div>
                                </div>
                                <h2><?php echo esc_attr($settings['element_title']); ?></h2>
                            </div>
                            <!-- TITLE END-->                        
                        </div>
					</div>
					<div class="section-content"> 
                        <div class="row testimonial-1-content-outer">
                            <div class="col-lg-6 col-md-12">
                                <div class="animated-left-drone">
                                    <div class="animated-left-drone-media">
										<img src="<?php echo esc_url($settings['drone_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>" class="slide-top">
									</div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="testimonial-block-position-outer">
                                    <div class="testimonial-block-position">
                                        <div class="testimonial-1-content owl-carousel arrow-position-bottom  light-dotts-line center">
											<?php
											foreach($settings['testimonials_repeater'] as $index => $testimonial_item){
												?>	
												<div class="item">
													<div class="testimonial-1 bg-white">
														<div class="testimonial-content">
															<div class="testimonial-text">
																<i class="fa fa-quote-left"></i>
																<p><?php echo esc_attr($testimonial_item['quote']); ?></p>
															</div>
															<div class="testimonial-detail clearfix site-bg-primary">
																<div class="testimonial-pic-block"> 
																	<div class="testimonial-pic">
																		<img src="<?php echo esc_url($testimonial_item['testimonial_image']['url']); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>">
																	</div>
																</div>                                          
																<div class="testimonial-info text-white">
																	<span class="testimonial-name  title-style-2"><?php echo esc_attr($testimonial_item['name']); ?></span>
																	<span class="testimonial-position title-style-2"><?php echo esc_attr($testimonial_item['designation']); ?></span>
																</div>
															</div>
														</div>
													</div>
												</div>
												<?php
											}	?>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div> 
				</div>                
            </div>
			<?php
		}else if($settings['select_style'] == 'style2'){
			$custom_css ='.section-full.testimonial-2-outer{background-image:url('.esc_url($settings['section_bg_image']['url']).');}';

			wp_enqueue_style('industroz-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
			wp_add_inline_style( 'industroz-inline-style', $custom_css);
			?>
			<div class="section-full  p-t80 p-b80 testimonial-2-outer bg-cover bg-center bg-image-moving overflow-hidden">
                <div class="animated-right-drone">
                    <div class="animated-right-drone-media">
						<img src="<?php echo esc_url($settings['drone_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>" class="slide-top">
					</div>
                </div>            
                <div class="container bg-right-half-block-outer">
                	<div class="bg-right-half-block"></div>
					<div class="row testimonial-2-content-outer">
                        <div class="col-lg-5 col-md-12">
                            <!-- TITLE START-->
                            <div class="left wt-small-separator-outer text-white">
                                <div class="wt-small-separator">
                                    <div  class="sep-leaf-left"></div>
                                    <div><?php echo esc_attr($settings['element_caption']); ?></div>
                                    <div  class="sep-leaf-right"></div>
                                </div>
                                <h2><?php echo esc_attr($settings['element_title']); ?></h2>
                            </div>
                            <!-- TITLE END-->                            

                        </div>
                        <div class="col-lg-7 col-md-12">
                        	<div class="testimonial2-block-position-outer">
                            	<div class="testimonial2-block-position">
                                    <div class="testimonial-2-content owl-carousel arrow-dark-position-bottom dark-dotts-line center">
										<?php
										foreach($settings['testimonials_repeater'] as $index => $testimonial_item){
											?>	
											<div class="item">
												<div class="testimonial-2 bg-white">
													<div class="testimonial-content">
														<div class="testimonial-text">
															<i class="fa fa-quote-left"></i>
															<p><?php echo esc_attr($testimonial_item['quote']); ?></p>
														</div>  
														<div class="testimonial-detail clearfix">
															<div class="testimonial-pic-block"> 
																<div class="testimonial-pic">
																	<img src="<?php echo esc_url($testimonial_item['testimonial_image']['url']); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>">
																</div>
															</div>                                          
															<div class="testimonial-info">
																<span class="testimonial-name  title-style-2 site-text-primary"><?php echo esc_attr($testimonial_item['name']); ?></span>
																<span class="testimonial-position title-style-2"><?php echo esc_attr($testimonial_item['designation']); ?></span>
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php
										} ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                     

				</div>  
                <div class="testimonial-outline-text">
                	<span class="title-style-2"><?php echo esc_attr($settings['section_title']); ?></span>
                </div>              
            </div>
			<?php
		}else if($settings['select_style'] == 'style3'){ ?>
			
			<?php
		}
	}
}