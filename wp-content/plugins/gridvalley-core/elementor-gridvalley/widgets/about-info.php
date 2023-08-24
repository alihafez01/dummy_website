<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class About_Info extends Widget_Base {

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
		return 'about-info';
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
		return __( 'About Info', 'gridvalley-core' );
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
			'about_info',
			[
				'label' => __( 'About Info', 'gridvalley-core' ),
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
					'style2'  => __( 'Style 2', 'gridvalley-core' ),
					'style3'  => __( 'Style 3', 'gridvalley-core' ),
				],
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
		
		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '', 'gridvalley-core' ),
			]
		);
		
		$this->add_control(
			'drone_image',
			[
				'label' => __('About Image', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'select_style' => ['style1','style2','style3'],
				]
			]
		);
		
		$this->add_control(
			'image_title',
			[
				'label' => __( 'Image Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => ['style1','style2','style3'],
				]
			]
		);
		
		$this->add_control(
			'image_title2',
			[
				'label' => __('Image Title 2', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => ['style1','style2','style3'],
				]
			]
		);
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Title' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'icon_class', [
				'label' => __( 'Icon Class', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Icon Class' , 'gridvalley-core' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'info_repeater',
			[
				'label' => __( 'About Info', 'gridvalley-core' ),
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
		
		$this->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style1','style2','style3'],
				]
			]
		);
		
		$this->add_control(
			'button_url',
			[
				'label' => __('Button Url', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gridvalley-core' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'condition' => [
					'select_style' => [ 'style1','style2','style3'],
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
		global $dronza_allowed_html;
		
		if($settings['select_style'] == 'style1'){ ?>
			
			<div class="section-full p-t80 p-b50">
            	<div class="about-section-one">
					<div class="section-content">                 
						<div class="row justify-content-center d-flex">
							<div class="col-lg-6 col-md-12 m-b30">
								<div class="about-drone-one">
									<div class="about-drone-one-media">
										<img src="<?php echo esc_url($settings['drone_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>"  class="slide-top">
									</div>
									<div class="about-drone-one-info">
										<span class="outline-title"><?php echo esc_attr($settings['image_title']); ?></span>
										<strong><?php echo esc_attr($settings['image_title2']); ?></strong>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12 m-b30">
								<div class="about-section-one-right">
								<!-- TITLE START-->
								<div class="left wt-small-separator-outer">
									<div class="wt-small-separator site-text-primary">
										<div  class="sep-leaf-left"></div>
										<div><?php echo esc_attr($settings['caption']); ?></div>
										<div  class="sep-leaf-right"></div>
									</div>
									<h2><?php echo esc_attr($settings['title']); ?></h2>
									<p><?php echo esc_attr($settings['description']); ?></p>
								</div>
								<!-- TITLE END-->  
								<ul class="site-list-style-one icon-style">
									<?php 
									foreach($settings['info_repeater'] as $info){ ?>
										<li><i class="<?php echo esc_attr($info['icon_class']); ?>"></i><?php echo esc_attr($info['title']); ?></li>
										<?php
									} ?>
								</ul>
								<a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="site-button site-btn-effect"><?php echo esc_attr($settings['button_text']); ?></a> 
								</div>                                                                
							</div>
						</div>
					</div> 
                </div>
            </div>
			<?php
		}else if($settings['select_style'] == 'style2'){
			?>
			<div class="section-full p-t80 p-b20">
            	<div class="about-section-two">
					<div class="section-content">               
						<div class="row justify-content-center d-flex">
							<div class="col-lg-6 col-md-12 m-b30">
								<div class="about-drone-three">
									<div class="about-drone-three-media"><img src="<?php echo esc_url($settings['drone_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>"></div>
									<div class="about-drone-three-info">
										<span><?php echo esc_attr($settings['image_title']); ?></span>
										<strong><?php echo esc_attr($settings['image_title2']); ?></strong>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12 m-b30">
								<div class="about-section-one-right">
								<!-- TITLE START-->
								<div class="left wt-small-separator-outer">
									<div class="wt-small-separator site-text-primary">
										<div  class="sep-leaf-left"></div>
										<div><?php echo esc_attr($settings['caption']); ?></div>
										<div  class="sep-leaf-right"></div>
									</div>
									<h2><?php echo esc_attr($settings['title']); ?></h2>
									<p><?php echo esc_attr($settings['description']); ?></p>
								</div>
								<!-- TITLE END-->  
								<ul class="site-list-style-one icon-style">
									<?php 
									foreach($settings['info_repeater'] as $info){ ?>
										<li><i class="<?php echo esc_attr($info['icon_class']); ?>"></i><?php echo esc_attr($info['title']); ?></li>
										<?php
									} ?>
								</ul>
								<a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="site-button site-btn-effect"><?php echo esc_attr($settings['button_text']); ?></a> 
								</div>                                                                
							</div>
						</div>
					</div> 
                </div>
            </div> 
			<?php
		}else if($settings['select_style'] == 'style3'){
			?>
			<div class="section-full p-t80 p-b20">
            	<div class="about-section-two">
					<div class="section-content">                 
						<div class="row justify-content-center d-flex">
							<div class="col-lg-6 col-md-12 m-b30">
								<div class="about-drone-two">
									<div class="about-drone-two-media">
										<img src="<?php echo esc_url($settings['drone_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>">
									</div>
									<div class="about-drone-two-info">
										<span class="outline-title2"><?php echo esc_attr($settings['image_title']); ?></span>
										<strong><?php echo esc_attr($settings['image_title2']); ?></strong>
									</div>
								</div>
							</div>  
							<div class="col-lg-6 col-md-12 m-b30">
								<div class="about-section-one-right">
								<!-- TITLE START-->
								<div class="left wt-small-separator-outer">
									<div class="wt-small-separator site-text-primary">
										<div  class="sep-leaf-left"></div>
										<div><?php echo esc_attr($settings['caption']); ?></div>
										<div  class="sep-leaf-right"></div>
									</div>
									<h2><?php echo esc_attr($settings['title']); ?></h2>
									<p><?php echo esc_attr($settings['description']); ?></p>
								</div>
								<!-- TITLE END-->  
								<ul class="site-list-style-one icon-style">
									<?php 
									foreach($settings['info_repeater'] as $info){ ?>
										<li><i class="<?php echo esc_attr($info['icon_class']); ?>"></i><?php echo esc_attr($info['title']); ?></li>
										<?php
									} ?>
								</ul>
								<a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="site-button site-btn-effect"><?php echo esc_attr($settings['button_text']); ?></a>
								</div>                                                                
							</div>
						</div>
					</div>
                </div>
            </div> 
			<?php
		}else if($settings['select_style'] == 'style4'){
			?>
			
			<?php
		}
	}

}