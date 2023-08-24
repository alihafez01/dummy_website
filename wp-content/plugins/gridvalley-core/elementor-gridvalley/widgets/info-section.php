<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Info_Section extends Widget_Base {

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
		return 'info-section';
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
		return __( 'Info Section', 'gridvalley-core' );
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
			'info_section',
			[
				'label' => __( 'Info Section', 'gridvalley-core' ),
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
			'description',
			[
				'label' => __('Info Description', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style1'],
				]
			]
		);
		
		$this->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style1'],
				]
			]
		);
		
		$this->add_control(
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
				'condition' => [
					'select_style' => [ 'style1'],
				]
			]
		);
		
		$this->add_control(
			'video_poster_image',
			[
				'label' => __('Video Poster Image', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'select_style' => ['style1','style2'],
				]
			]
		);
		
		$this->add_control(
			'video_url',
			[
				'label' => __( 'Video Url', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gridvalley-core' ),
				'show_external' => false,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'select_style' => ['style1','style2'],
				]
			]
		);
		
		$this->add_control(
			'bg_image',
			[
				'label' => __('Background Image', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'select_style' => ['style2'],
				]
			]
		);
		
		$this->add_control(
			'icon_class',
			[
				'label' => __('Icon Class', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style2'],
				]
			]
		);
		
		$this->add_control(
			'info_title',
			[
				'label' => __('Info Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style2'],
				]
			]
		);
		
		$this->add_control(
			'info_description',
			[
				'label' => __('Info Description', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style2'],
				]
			]
		);
		
		$this->add_control(
			'info_button_text',
			[
				'label' => __('Info Button Text', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style2'],
				]
			]
		);
		
		$this->add_control(
			'info_button_url',
			[
				'label' => __( 'Info Button Url', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gridvalley-core' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
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

		if($settings['select_style'] == 'style1'){ ?>
			
			<div class="section-full p-t80 p-b50">
				<div class="section-content">
					<div class="row justify-content-center align-items-center video-style2-outer">
						<div class="col-lg-6 col-md-12  m-b30">
							<div class="video-style2-left">
								<div class="video-style2-circle-outer">
									<div class="video-style2-ring-outer  rotate-center">
										<div class="dot-circle one"></div>
										<div class="dot-circle two"></div>
										<div class="dot-circle three"></div>
									</div>
									<div class="video-style2-media">
										<img src="<?php echo esc_url($settings['video_poster_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>">
										<a href="<?php echo esc_url($settings['video_url']['url']); ?>" class="mfp-video play-now">
											<i class="icon fa fa-play"></i>
											<span class="ripple"></span>
										</a>                                                
									</div>                                            
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 ">
							<div class="video-style2-right">
								<!-- TITLE START-->
								<div class="left wt-small-separator-outer text-white">
									<div class="wt-small-separator text-white">
										<div  class="sep-leaf-left"></div>
										<div><?php echo esc_attr($settings['element_caption']); ?></div>
										<div  class="sep-leaf-right"></div>
									</div>
									<h2><?php echo esc_attr($settings['element_title']); ?></h2>
									<p><?php echo esc_attr($settings['description']); ?></p>
								</div>
								<!-- TITLE END-->
								<a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="site-button site-btn-effect"><?php echo esc_attr($settings['button_text']); ?></a> 
							</div>       
						</div>
					</div>
				</div> 
            </div>
			<?php
		}else if($settings['select_style'] == 'style2'){
			$custom_css ='.section-full.bg-no-repeat.bg-half-right{background-image:url('.esc_url($settings['bg_image']['url']).');}';

			wp_enqueue_style('industroz-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
			wp_add_inline_style( 'industroz-inline-style', $custom_css);
			?>
			<div class="section-full p-t80 bg-white bg-no-repeat bg-half-right">
				<div class="container">
                	<div class="wt-separator-two-part">
                    	<div class="row wt-separator-two-part-row">
                        	<div class="col-lg-5 col-md-6 wt-separator-two-part-left">
                                <!-- TITLE START-->
                                <div class="section-head left wt-small-separator-outer">
                                    <div class="wt-small-separator site-text-primary">
                                        <div  class="sep-leaf-left"></div>
                                        <div><?php echo esc_attr($settings['element_caption']); ?></div>
                                        <div  class="sep-leaf-right"></div>
                                    </div>
                                    <h2><?php echo esc_attr($settings['element_title']); ?></h2>
                                </div>
                                <!-- TITLE END-->
                            </div>
                    	</div>
                    </div>
     			 </div>
                <div class="section-content">
                    <div class="container">
                        <div class="quality-video-section2">
                            <div class="quality-video2">
                            	<div class="quality-video-media">
									<img src="<?php echo esc_url($settings['video_poster_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>">
									<a href="<?php echo esc_url($settings['video_url']['url']); ?>" class="mfp-video play-now-video">
                                        <i class="icon fa fa-play"></i>
                                        <span class="ripple"></span>
                                    </a>
                                </div>
                                <div class="quality-video-info">
                                 <div class="wt-box d-icon-box-one bg-white shadow hover-line-effect-one">
                                	<div class="wt-icon-box-wraper m-b40">
                                        <div class="icon-xl inline-icon">
                                            <span class="icon-cell site-text-primary">
												<i class="<?php echo esc_attr($settings['icon_class']); ?>"></i>
											</span>
                                        </div>
                                    </div>     
                                    <div class="d-icon-box-title title-style-2 site-text-secondry">
                                        <h4 class="s-title-one"><?php echo esc_attr($settings['info_title']); ?></h4>
                                    </div>
                                    <div class="d-icon-box-content">
                                        <p><?php echo esc_attr($settings['info_description']); ?></p>
                                        <a href="<?php echo esc_url($settings['info_button_url']['url']); ?>" class="site-button-link site-text-primary"><?php echo esc_attr($settings['info_button_text']); ?></a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
			<?php
		}
	}
}