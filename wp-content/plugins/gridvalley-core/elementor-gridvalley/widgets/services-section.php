<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Services_Section extends Widget_Base {

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
		return 'services-section';
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
		return __( 'Services Section', 'gridvalley-core' );
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
			'services_section',
			[
				'label' => __( 'Services Section', 'gridvalley-core' ),
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
					'style3' => __( 'Style 3', 'gridvalley-core' ),
					'style4' => __( 'Style 4', 'gridvalley-core' ),
					'style5' => __( 'Style 5', 'gridvalley-core' ),
					'style6' => __( 'Style 6', 'gridvalley-core' ),
					'style7' => __( 'Style 7', 'gridvalley-core' ),
					
				],
			]
		);
		
		$service_categories = get_terms( array(
			'taxonomy' => 'services_category',
			'hide_empty' => false
		) );
		$options = [];
		foreach ( $service_categories as $category ) {
			$options[ $category->term_id ] = $category->name;
		}

		$this->add_control(
			'service_categories',
			[
				'label' => __( 'Categories', 'gridvalley-core' ),
				'type' => Controls_Manager::SELECT2,
				'options' => $options,
				'default' => [],
				'label_block' => true,
				'multiple' => true,
			]
		);
		
		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'gridvalley-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);
		$this->add_control(
			'description_characters',
			[
				'label' => __( 'Descriptions Characters to Fetch', 'gridvalley-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => __( '70', 'gridvalley-core' ),
			]
		);
		$this->add_control(
			'orderby',
			[
				'label' => __( 'Order By', 'gridvalley-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'name',
				'options' => [
					'title' => __( 'Title', 'gridvalley-core' ),
					'name' => __( 'Name', 'gridvalley-core' ),
					'date' => __( 'Date', 'gridvalley-core' ),
					'comment_count' => __( 'Comment Count', 'gridvalley-core' ),
				],
			]
		);
		
		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'gridvalley-core' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => __( 'ASC', 'gridvalley-core' ),
					'desc' => __( 'DESC', 'gridvalley-core' ),
				],
			]
		);
		
		$this->add_control(
			'pagination',
			[
				'label' => __( 'Show Pagination', 'gridvalley-core' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_off' => __( 'Off', 'gridvalley-core' ),
				'label_on' => __( 'On', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style9'],
				]
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
				'condition' => [
					'select_style' => [ 'style1','style5','style7'],
				]
			]
		);
		
		$this->add_control(
			'drone_image',
			[
				'label' => __( 'Drone Image', 'gridvalley-core' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'select_style' => [ 'style1','style3','style4'],
				]
			]
		);
		
		$this->add_control(
			'image_caption',
			[
				'label' => __( 'Image Caption Text', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => ['style1'],
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
					'select_style' => ['style2'],
				]
			]
		);
		
		$this->add_control(
			'video_caption',
			[
				'label' => __( 'Video Caption Text', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => ['style2'],
				]
			]
		);
		
		$this->add_control(
			'section_image',
			[
				'label' => __( 'Section Image', 'gridvalley-core' ),
				'type' => Controls_Manager::MEDIA,
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
		
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$args = array(
			'post_type' => 'services',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => 'services_category',
					'field'    => 'post_id',
					'terms'    => $settings['service_categories'],
				),
			)
		);
		
		$the_query = get_posts( $args );
		
		if($settings['select_style'] == 'style1' ){ ?>
			
			<div class="section-full welcome-section-outer">
            	<div class="how-it-work-section-one p-t80 p-b50">
					<div class="row">
						<div class="col-lg-6">
						<!-- TITLE START-->
						<div class="section-head left wt-small-separator-outer">
							<div class="wt-small-separator site-text-primary">
								<div  class="sep-leaf-left"></div>
								<div><?php echo esc_attr($settings['caption']); ?></div>
								<div  class="sep-leaf-right"></div>
							</div>
							<h2><?php echo esc_attr($settings['title']); ?></h2>
							<p><?php echo esc_attr($settings['description']); ?></p>
						</div>
						<!-- TITLE END-->
						</div> 
					</div>
					<div class="section-content"> 
						<div class="row justify-content-center d-flex">
							<div class="col-lg-8 col-md-12 m-b30 how-it-drone-outer">
								<div class="how-it-drone">
									<div class="how-it-drone-media"><img src="<?php echo esc_url($settings['drone_image']['url']); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>" class="wave-effects"></div>
									<div class="how-it-drone-info"><span><?php echo esc_attr($settings['image_caption']); ?></span></div>
								</div>
							</div>  
						   <?php
							$current_size = 1;
							foreach($the_query as $query){
								$icon_class = get_field('service_icon', $query->ID);
								$icon_img = get_field('service_icon_image', $query->ID);
								?>                   
								<div class="col-lg-4 col-md-6 m-b30">
									<div class="wt-box d-icon-box-one bg-white shadow card1">
										<div class="wt-icon-box-wraper m-b40">
											<div class="icon-xl inline-icon">
												<?php 
												if($icon_img <> ''){ ?>
													<img src="<?php echo esc_url($icon_img); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>">
													<?php
												}else{ ?>
													<span class="icon-cell site-text-primary"><i class="<?php echo esc_attr($icon_class); ?>"></i></span>
													<?php
												} ?>
											</div>
										</div> 
										<div class="d-icon-box-title title-style-2 site-text-secondry">
											<h4  class="s-title-one"><?php echo esc_attr($query->post_title); ?></h4>
										</div>
										<div class="d-icon-box-content">
											<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,109)); ?></p>
											<a href="<?php echo esc_url(get_permalink($query->ID)); ?>" class="site-button-link site-text-primary"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
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
		}else if($settings['select_style'] == 'style2'){
			
			$custom_css ='.section-full.overlay-wraper.bg-top-center.bg-center{background-image:url('.esc_url($settings['section_image']['url']).');}';

			wp_enqueue_style('industroz-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
			wp_add_inline_style( 'industroz-inline-style', $custom_css);
			?>
			<div class="section-full p-t80 overlay-wraper bg-top-center bg-center">
            	<div class="overlay-main bg-black opacity-08"></div>
                <div class="container">
                    <!-- TITLE START-->
                    <div class="section-head center wt-small-separator-outer text-center text-white">
                        <div class="wt-small-separator site-text-white">
                            <div  class="sep-leaf-left"></div>
                            <div><?php echo esc_attr($settings['caption']); ?></div>
                            <div  class="sep-leaf-right"></div>
                        </div>
                        <h2><?php echo esc_attr($settings['title']); ?></h2>
                    </div>
                    <!-- TITLE END-->
                </div>  
                <div class="section-content quality-section-outer bg-white">
                    <div class="container">
                        <div class="quality-section-content">
                            <div class="row justify-content-center">
                                <?php
								$current_size = 1;
								foreach($the_query as $query){
									$icon_class = get_field('service_icon', $query->ID);
									$icon_img = get_field('service_icon_image', $query->ID);
									?>                       
									<div class="col-lg-4 col-md-6 m-b30">
										<div class="corner-line text-center">
											<div class="wt-box d-icon-box-one bg-white shadow ">
												<div class="wt-icon-box-wraper m-b40">
													<div class="icon-xl inline-icon">
														<?php 
														if($icon_img <> ''){ ?>
															<img src="<?php echo esc_url($icon_img); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>">
															<?php
														}else{ ?>
															<span class="icon-cell site-text-primary"><i class="<?php echo esc_attr($icon_class); ?>"></i></span>
															<?php
														} ?>
													</div>
												</div> 	
												<div class="d-icon-box-title title-style-2 site-text-secondry">
													<h4 class="s-title-one"><?php echo esc_attr($query->post_title); ?></h4>
												</div>
												<div class="d-icon-box-content">
													<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,109)); ?></p>
													<a href="<?php echo esc_url(get_permalink($query->ID)); ?>" class="site-button-link site-text-primary"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
												</div>
											</div>
										</div>
									</div>
									<?php
								} ?>
                            </div>
                        </div>
                        <div class="quality-video-section">
                            <span><?php echo esc_attr($settings['video_caption']); ?></span>
                            <div class="quality-video">
                                 <a href="<?php echo esc_url($settings['video_url']['url']); ?>" class="mfp-video play-now">
                                    <i class="icon fa fa-play"></i>
                                    <span class="ripple"></span>
                                </a>                                  
                            </div>
                        </div>
                    </div>
                </div>      
            </div> 
			<?php
		}else if($settings['select_style'] == 'style3'){ ?>
			<!-- HOW IT WORK SECTION START -->
            <div class="section-full p-t80 p-b50">
				<!-- TITLE START-->
				<div class="section-head center wt-small-separator-outer">
					<div class="wt-small-separator site-text-primary">
						<div  class="sep-leaf-left"></div>
						<div><?php echo esc_attr($settings['caption']); ?></div>
						<div  class="sep-leaf-right"></div>
					</div>
					<h2><?php echo esc_attr($settings['title']); ?></h2>
					
				</div>
				<!-- TITLE END-->

				<div class="section-content"> 
					<div class="row justify-content-center d-flex how-it-drone3">
						<div class="col-lg-4 col-md-12 m-b30 how-it-drone3-left">
							<?php
							$current_size = 1;
							$posts_mid = count($the_query) / 2 ;
							
							foreach($the_query as $query){
								$icon_class = get_field('service_icon', $query->ID);
								$icon_img = get_field('service_icon_image', $query->ID);
								?> 
								<div class="wt-box d-icon-box-two m-b40">
									<div class="wt-icon-box-wraper right ">
										
										<div class="icon-md inline-icon">
											<span class="icon-cell site-text-secondry">
												<i class="number-style">0<?php echo esc_attr($current_size); ?></i>
											</span>
										</div>
										<div class="icon-content">
											<div class="d-icon-box-title title-style-2 site-text-secondry">
												<h4  class="s-title-one"><?php echo esc_attr($query->post_title); ?></h4>
											</div>
											
											<div class="d-icon-box-content">
												<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,70)); ?></p>
											</div>                                        
										</div>
										
									</div> 
								</div>
								<?php
								if($current_size == $posts_mid){break;}
								$current_size++;
							} ?>
						</div>
						<div class="col-lg-4 col-md-12 m-b30 how-it-drone2-outer">
							<div class="how-it-drone2-border">
								<div class="how-it-drone2">
									<div class="how-it-drone-media2">
										<img src="<?php echo esc_url($settings['drone_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>" class="wave-effects">
									</div>
								</div>
							</div>
						</div> 
						<div class="col-lg-4 col-md-12 m-b30 how-it-drone3-right">
							<?php
							$current_size = 1;
							
							foreach($the_query as $query){
								$icon_class = get_field('service_icon', $query->ID);
								$icon_img = get_field('service_icon_image', $query->ID);
								
								if( $current_size > $posts_mid){
									?>
									<div class="wt-box d-icon-box-two m-b40">
										<div class="wt-icon-box-wraper left">
											<div class="icon-md inline-icon">
												<span class="icon-cell site-text-secondry"><i class="number-style">0<?php echo esc_attr($current_size); ?></i></span>
											</div>
											<div class="icon-content">
												<div class="d-icon-box-title title-style-2 site-text-secondry">
													<h4  class="s-title-one"><?php echo esc_attr($query->post_title); ?></h4>
												</div>                                          
												<div class="d-icon-box-content">
													<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,70)); ?></p>
												</div>
											</div>
										</div> 
									</div>
									<?php 
								}
								$current_size++;
							} ?>
						</div>

					</div>
				</div>
            </div>  
			<?php
		}else if($settings['select_style'] == 'style4'){
			?>
			<!-- HOW IT WORK SECTION START -->
            <div class="section-full p-tb80">
				<!-- TITLE START-->
				<div class="section-head center wt-small-separator-outer">
					<div class="wt-small-separator site-text-primary">
						<div  class="sep-leaf-left"></div>
						<div><?php echo esc_attr($settings['caption']); ?></div>
						<div  class="sep-leaf-right"></div>
					</div>
					<h2><?php echo esc_attr($settings['title']); ?></h2>
				</div>
				<div class="row justify-content-center d-flex">
					<div class="col-lg-4 col-md-12 m-b30 how-it-drone2-left">
						<?php
						$current_size = 1;
						$posts_mid = count($the_query) / 2 ;
						
						foreach($the_query as $query){
							$icon_class = get_field('service_icon', $query->ID);
							$icon_img = get_field('service_icon_image', $query->ID);
							?>
							<div class="wt-box d-icon-box-two m-b40">
								<div class="wt-icon-box-wraper right ">
									<div class="icon-md inline-icon">
										<?php 
										if($icon_img <> ''){ ?>
											<img src="<?php echo esc_url($icon_img); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>">
											<?php
										}else{ ?>
											<span class="icon-cell site-text-secondry"><i class="<?php echo esc_attr($icon_class); ?>"></i></span>
											<?php
										} ?>
									</div>
									<div class="icon-content">
										<div class="d-icon-box-title title-style-2 site-text-secondry">
											<h4  class="s-title-one"><?php echo esc_attr($query->post_title); ?></h4>
										</div>
										<div class="d-icon-box-content">
											<?php
											if(has_excerpt($query->ID)){
												echo '<p>' . get_the_excerpt($query->ID) . '</p>';
											}else{ ?>
												<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,$settings['description_characters'])); ?></p>
												<?php
											} ?>
										</div>                                        
									</div>
								</div> 
							</div>
							<?php
							if($current_size == $posts_mid){break;}
							$current_size++;
						} ?>
					</div> 
					<div class="col-lg-4 col-md-12 m-b30 how-it-drone2-outer">
						<div class="how-it-drone2-border">
							<div class="how-it-drone2">
								<div class="how-it-drone-media2">
									<img src="<?php echo esc_url($settings['drone_image']['url']); ?>" alt="<?php echo esc_attr__('img','dronza'); ?>" class="wave-effects">
								</div>
							</div>
						</div>
					</div> 
					<div class="col-lg-4 col-md-12 m-b30 how-it-drone2-right">
						<?php
						$current_size = 1;
						
						foreach($the_query as $query){
							$icon_class = get_field('service_icon', $query->ID);
							$icon_img = get_field('service_icon_image', $query->ID);
							
							if( $current_size > $posts_mid){ ?>
								<div class="wt-box d-icon-box-two m-b40">
									<div class="wt-icon-box-wraper left">
										<div class="icon-md inline-icon">
											<?php 
											if($icon_img <> ''){ ?>
												<img src="<?php echo esc_url($icon_img); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>">
												<?php
											}else{ ?>
												<span class="icon-cell site-text-secondry"><i class="<?php echo esc_attr($icon_class); ?>"></i></span>
												<?php
											} ?>
										</div>
										<div class="icon-content">
											<div class="d-icon-box-title title-style-2 site-text-secondry">
												<h4  class="s-title-one"><?php echo esc_attr($query->post_title); ?></h4>
											</div>                                          
											<div class="d-icon-box-content">
												<?php
												if(has_excerpt($query->ID)){
													echo '<p>' . get_the_excerpt($query->ID) . '</p>';
												}else{ ?>
													<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,$settings['description_characters'])); ?></p>
													<?php
												} ?>
											</div>  
										</div>
									</div> 
								</div>
								<?php
							}
							$current_size++;
						} ?>
					</div>
				</div>
            </div> 
			<?php
		}else if($settings['select_style'] == 'style5'){ ?>
			<div class="section-full p-t80 p-b50">
				<div class="wt-separator-two-part">
					<div class="row wt-separator-two-part-row">
						<div class="col-lg-5 col-md-6 wt-separator-two-part-left">
							<!-- TITLE START-->
							<div class="section-head left wt-small-separator-outer">
								<div class="wt-small-separator site-text-primary">
									<div class="sep-leaf-left"></div>
									<div><?php echo esc_attr($settings['caption']); ?></div>
									<div class="sep-leaf-right"></div>
								</div>
								<h2><?php echo esc_attr($settings['title']); ?></h2>
							</div>
						</div>
						<div class="col-lg-7 col-md-6 wt-separator-two-part-right text-left">
							<p><?php echo esc_attr($settings['description']); ?></p>
						</div>  
					</div>
				</div>
				<div class="section-content"> 
					<div class="row justify-content-center d-flex">
						<?php
						$current_size = 1;
						$posts_mid = count($the_query) / 2 ;
						
						foreach($the_query as $query){
							$icon_class = get_field('service_icon', $query->ID);
							$icon_img = get_field('service_icon_image', $query->ID);
							?>
							<div class="col-lg-4 col-md-6 m-b30">
								<div class="imghvr-zoom-out-down">
									<?php echo get_the_post_thumbnail($query->ID,'full'); ?>
									<div class="imghvr-content">
										<div class="imghvr-mid">
											<h4 class="wt-title"><?php echo esc_attr($query->post_title); ?></h4>
											<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,100)); ?></p>
											<a href="<?php echo esc_url(get_permalink($query->ID)); ?>" class="site-button-link site-text-primary"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
										</div>
									</div>
									
								</div>
							</div>
							<?php
						} ?>
					</div>
				</div>
            </div>
			<?php
		}else if($settings['select_style'] == 'style6'){ ?>
			<!-- ALL SERVICES START -->
            <div class="section-full p-t80 p-b40 bg-no-repeat bg-bottom-right bg-cover">
				<div class="section-head left wt-small-separator-outer">
					<div class="wt-small-separator site-text-primary">
						<div class="sep-leaf-left"></div>
						<div><?php echo esc_attr($settings['caption']); ?></div>
						<div class="sep-leaf-right"></div>
					</div>
					<h2><?php echo esc_attr($settings['title']); ?></h2>
				</div>
				<div class="section-content"> 
					<div class="row justify-content-center d-flex">
						<?php
						$current_size = 1;
						$posts_mid = count($the_query) / 2 ;
						
						foreach($the_query as $query){
							$icon_class = get_field('service_icon', $query->ID);
							$icon_img = get_field('service_icon_image', $query->ID);
							?>
							<div class="col-lg-4 col-md-6 m-b30">
								<div class="wt-box d-icon-box-one bg-white shadow card1">
									<div class="wt-icon-box-wraper m-b40">
										<div class="icon-xl inline-icon">
											<?php 
											if($icon_img <> ''){ ?>
												<img src="<?php echo esc_url($icon_img); ?>" alt="<?php echo esc_attr__('img','gridvalley-core'); ?>">
												<?php
											}else{ ?>
												<span class="icon-cell site-text-primary"><i class="<?php echo esc_attr($icon_class); ?>"></i></span>
												<?php
											} ?>
										</div>
									</div> 	
									<div class="d-icon-box-title title-style-2 site-text-secondry">
										<h4  class="s-title-one"><?php echo esc_attr($query->post_title); ?></h4>
									</div>
									<div class="d-icon-box-content">
										<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,109)); ?></p>
										<a href="<?php echo esc_url(get_permalink($query->ID)); ?>" class="site-button-link site-text-primary"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
									</div>
								</div>
							</div>
							<?php
						} ?>
					</div>
				</div>
            </div>
			<?php
		}else if($settings['select_style'] == 'style7'){ ?>
			<div class="section-full p-t80 p-b80">
				<div class="wt-separator-two-part">
					<div class="row wt-separator-two-part-row">
						<div class="col-lg-5 col-md-6 wt-separator-two-part-left">
							<!-- TITLE START-->
							<div class="section-head left wt-small-separator-outer">
								<div class="wt-small-separator site-text-primary">
									<div class="sep-leaf-left"></div>
									<div><?php echo esc_attr($settings['caption']); ?></div>
									<div class="sep-leaf-right"></div>
								</div>
								<h2><?php echo esc_attr($settings['title']); ?></h2>
							</div>
							<!-- TITLE END-->
						</div>
						<div class="col-lg-7 col-md-6 wt-separator-two-part-right text-left">
							<p><?php echo esc_attr($settings['description']); ?></p>
						</div>
					</div>
				</div> 
				<!-- TITLE END-->
				<div class="section-content"> 
					<div class="services-style-two">
						<?php
						$current_size = 1;
						$posts_mid = count($the_query) / 2 ;
						
						foreach($the_query as $query){
							$icon_class = get_field('service_icon', $query->ID);
							$icon_img = get_field('service_icon_image', $query->ID);
							?>
							<div class="row no-gutters">
								<div class="col-lg-6 col-md-12">
									<div class="wt-media our-story-pic">
										<?php echo get_the_post_thumbnail($query->ID,'full'); ?>
									</div>
								</div>
								<div class="col-lg-6 col-md-12">
									<div class="service-style2-detail">
										<h4 class="wt-title"><?php echo esc_attr($query->post_title); ?></h4>
										<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,$settings['description_characters'])); ?> </p>
										<a href="<?php echo esc_url(get_permalink($query->ID)); ?>" class="site-button-link site-text-primary"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
									</div>
								</div>
							</div>  
							<?php
						} ?>
					</div>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}
}