<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Shop_Products extends Widget_Base {

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
		return 'shop-products';
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
		return __( 'Shop Products', 'gridvalley-core' );
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
			'shop_products',
			[
				'label' => __( 'Shop Products', 'gridvalley-core' ),
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
				],
			]
		);
		
		$this->add_control(
			'layout_theme',
			[
				'label' => __( 'Select Style', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'light_style',
				'options' => [
					'light_style' => __( 'Light Style', 'gridvalley-core' ),
					'dark_style' => __( 'Dark Style', 'gridvalley-core' ),
				],
				'condition' => [
					'select_style' => 'style1',
				]
			]
		);
		$post_categories = get_terms( array(
			'taxonomy' => 'product_cat',
			'hide_empty' => false
		) );
		$options = [];
		foreach ( $post_categories as $category ) {
			$options[ $category->term_id ] = $category->name;
		}

		$this->add_control(
			'post_categories',
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
			'section_title',
			[
				'label' => __( 'Section Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => 'style1',
				]
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'Element Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => ['style1','style2','style4'],
				]
			]
		);
		$this->add_control(
			'caption',
			[
				'label' => __( 'Caption', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => ['style1','style2','style4'],
				]
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
				'condition' => [
					'select_style' => 'style1',
				]
			]
		);
		
		$this->add_control(
			'bg_image',
			[
				'label' => __( 'Background Image', 'gridvalley-core' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'select_style' => [ 'style1'],
				]
			]
		);
		
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => ['style4'],
				]
			]
		);
		
		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button Url', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'gridvalley-core' ),
				'show_external' => false,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'select_style' => ['style4'],
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
		
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

		$args = array(
			'post_type' => 'product',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'post_id',
					'terms'    => $settings['post_categories'],
				),
			)
		);
		
		$the_query = new \WP_Query($args);
		
		if($settings['select_style'] == 'style1'){
			$custom_css ='.section-full.overlay-wraper.products-section{background-image:url('.esc_url($settings['bg_image']['url']).');}';

			wp_enqueue_style('industroz-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
			wp_add_inline_style( 'industroz-inline-style', $custom_css);
			
			if($settings['layout_theme'] == 'dark_style'){
				$bg_theme = 'bg-black';
				$title_colors = 'text-white';
				$site_text = 'site-text-primary';
			}else{
				$bg_theme = 'bg-white';
				$title_colors = '';
				$site_text = 'site-text-secondry';
			}
			?>
			
			<div class="section-full overlay-wraper products-section p-t80 p-b50 bg-white bg-cover bg-no-repeat">
				<div class="overlay-main <?php echo esc_attr($bg_theme); ?> opacity-09"></div>                   
				<div class="container">
					<!-- TITLE START-->
					<div class="section-head center wt-small-separator-outer text-center <?php echo esc_attr($title_colors); ?>">
						<div class="wt-small-separator site-text-primary">
							<div  class="sep-leaf-left"></div>
							<div><?php echo esc_attr($settings['caption']); ?></div>
							<div  class="sep-leaf-right"></div>
						</div>
						<h2 data-title="<?php echo esc_attr($settings['section_title']); ?>"><?php echo esc_attr($settings['title']); ?></h2>
					</div>
					<!-- TITLE END--> 
				</div>
				<div class="section-content"> 
					<div class="product-one-slider p-b80 woocommerce">
						<div class="owl-carousel product-show-slider owl-btn-vertical-center">
							<?php
							$current_size = 1;
							while($the_query->have_posts()){ 
								$the_query->the_post();
								global $post,$product;
								$product = wc_get_product($post->ID);
								
								$custom_field_text = get_field('custom_field_text', $post->ID);
								$custom_field_value = get_field('custom_field_value', $post->ID);
								
								?>
								<div class="item">
									<div class="product-showcase">
										<div class="product-show-media">
											<?php echo get_the_post_thumbnail($post->ID,'full'); ?>
										</div>
										<div class="product-show-block">
											<div class="product-show-info shadow">
												<div class="p-price"><?php echo wp_kses($product->get_price_html(),$dronza_allowed_html); ?></div>
												<div class="p-title"><h4 class="wt-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h4></div>
												<div class="p-specification">
													<ul>
														<li><span class="p-specification-title"> <?php echo esc_attr($custom_field_text); ?></span><?php echo esc_attr($custom_field_value); ?></li>
													</ul>
												</div>
												<div class="p-control">
													<ul>
														<li><a href="#"><i class="flaticon-heart"></i></a></li>
														<li>
														<?php
														echo apply_filters(
															'woocommerce_loop_add_to_cart_link',
															sprintf(
																'<a href="%s" rel="nofollow" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button %s %s product_type_%s"><i class="flaticon-shopping-cart"></i></a>',
																apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) ),
																esc_attr( isset( $quantity ) ? $quantity : 1 ),
																esc_attr( $product->get_id() ),
																esc_attr( $product->get_sku() ),
																$product->is_purchasable() ? 'add_to_cart_button' : '',
																$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
																esc_attr( $product->get_type() ),
																esc_html( $product->add_to_cart_text() )
															),
															$product
														);  ?>
														</li>
													</ul>
												</div>                                            
											</div>
										</div>                                    
									</div>
								</div>                                                                                                                
								<?php
							} ?>
						</div>
					</div>	
					<div class="container">
						<div class="counter-outer">
							<div class="row justify-content-center">
								<?php 
								foreach($settings['project_facts'] as $facts){ ?>	
									<div class="col-lg-3 col-md-6 m-b30 ">
										<div class="counter-box <?php echo esc_attr($title_colors); ?>">
											<h2 class="counter"><?php echo esc_attr($facts['value']); ?></h2>
											<span class="<?php echo esc_attr($site_text); ?> title-style-2"><?php echo esc_attr($facts['title']); ?></span>
										</div>
									</div>
									<?php
								} ?>  
							</div>
						</div> 
					</div>
				</div>
            </div>
			<?php
		}else if($settings['select_style'] == 'style2'){ ?>
			<div class="section-full products-section p-t80 p-b80">
				<div class="container">
					<!-- TITLE START-->
					<div class="section-head center wt-small-separator-outer text-center">
						<div class="wt-small-separator site-text-primary">
							<div  class="sep-leaf-left"></div>
							<div><?php echo esc_attr($settings['caption']); ?></div>
							<div  class="sep-leaf-right"></div>
						</div>
						<h2><?php echo esc_attr($settings['title']); ?></h2>
					</div>
					<!-- TITLE END--> 
				</div>
				<div class="product-one-slider2 woocommerce p-b50">
					<div class="owl-carousel product-show-slider2 dark-dotts-line center">
						<?php
						$current_size = 1;
						while($the_query->have_posts()){ 
							$the_query->the_post();
							global $post,$product;
							$product = wc_get_product($post->ID);
							
							$custom_field_text = get_field('custom_field_text', $query->ID);
							$custom_field_value = get_field('custom_field_value', $query->ID);
							?>
							<div class="item">
								<div class="product-showcase2">
									<div class="product-show-media2">
										<?php echo get_the_post_thumbnail($post->ID,'full'); ?>
									</div>
									<div class="product-show-block2">
										<div class="product-show-info2 shadow">
											<div class="p-price2"><?php echo wp_kses($product->get_price_html(),$dronza_allowed_html); ?></div>
											<div class="p-title2"><h4 class="wt-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h4></div>
											<div class="p-specification2">
												<ul>
													<li><span class="p-specification-title2"> <?php echo esc_attr($custom_field_text); ?></span><?php echo esc_attr($custom_field_value); ?></li>
												</ul>
											</div>
											<div class="p-control2">
												<ul>
													<li><a href="#"><i class="flaticon-heart"></i></a></li>
													<li>
													<?php
														echo apply_filters(
															'woocommerce_loop_add_to_cart_link',
															sprintf(
																'<a href="%s" rel="nofollow" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button %s %s product_type_%s"><i class="flaticon-shopping-cart"></i></a>',
																apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) ),
																esc_attr( isset( $quantity ) ? $quantity : 1 ),
																esc_attr( $product->get_id() ),
																esc_attr( $product->get_sku() ),
																$product->is_purchasable() ? 'add_to_cart_button' : '',
																$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
																esc_attr( $product->get_type() ),
																esc_html( $product->add_to_cart_text() )
															),
															$product
														);  ?>
													</li>
												</ul>
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
			<?php
		}else if($settings['select_style'] == 'style3'){ ?>
			
			<div class="shop-grid-style3 woocommerce">
				<div class="row">
					<?php
					$current_size = 1;
					while($the_query->have_posts()){ 
						$the_query->the_post();
						global $post,$product;
						$product = wc_get_product($post->ID);
						
						$custom_field_text = get_field('custom_field_text', $post->ID);
						$custom_field_value = get_field('custom_field_value', $post->ID);
						$custom_field_2_text = get_field('custom_field_2_text', $post->ID);
						$custom_field_2_value = get_field('custom_field_2_value', $post->ID);
						?>
						<div class="col-lg-6 col-md-6 m-b30">
							<div class="wt-box wt-product-box   overflow-hide">
								<div class="wt-thum-bx wt-img-overlay1">
									<?php echo get_the_post_thumbnail($post->ID,'full'); ?>
									<div class="overlay-bx">
										<div class="overlay-icon">
											<?php
											echo apply_filters(
												'woocommerce_loop_add_to_cart_link',
												sprintf(
													'<a href="%s" rel="nofollow" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button %s %s product_type_%s"><i class="fa fa-cart-plus wt-icon-box-xs"></i></a>',
													apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) ),
													esc_attr( isset( $quantity ) ? $quantity : 1 ),
													esc_attr( $product->get_id() ),
													esc_attr( $product->get_sku() ),
													$product->is_purchasable() ? 'add_to_cart_button' : '',
													$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
													esc_attr( $product->get_type() ),
													esc_html( $product->add_to_cart_text() )
												),
												$product
											);  ?>
											<a class="mfp-link" href="javascript:void(0);">
												<i class="fa fa-heart wt-icon-box-xs"></i>
											</a>
										</div>
									</div>
								</div>
								<div class="wt-info">
									 <div class="p-a20 bg-white">
										<h4 class="wt-title">
											<a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
										</h4>
										<div class="product-features-item"><span><?php echo esc_attr($custom_field_text); ?> | </span><?php echo esc_attr($custom_field_value); ?></div>  
										<div class="product-features-item"><span><?php echo esc_attr($custom_field_2_text); ?> | </span><?php echo esc_attr($custom_field_2_value); ?></div>                                                     
										<span class="price">                                                
											<ins>
												<span><?php echo wp_kses($product->get_price_html(),$dronza_allowed_html); ?></span>
											</ins>
										</span>
									 </div>
								</div>
							</div>
						</div>
						<?php
					} ?>
				</div> 
			</div> 
			<?php
		}else if($settings['select_style'] == 'style4'){ ?>
			<div class="section-full p-t80 p-b50">
				<div class="section-content">
					<div class="wt-separator-two-part">
						<div class="row wt-separator-two-part-row">
							<div class="col-lg-8 col-md-6 wt-separator-two-part-left">
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
							<div class="col-lg-4 col-md-6 wt-separator-two-part-right text-right">
								<a href="<?php echo esc_url($settings['button_url']['url']); ?>" class="site-button site-btn-effect"><?php echo esc_attr($settings['button_text']); ?></a>
							</div>
						</div>
					</div>
					<div class="owl-carousel featured-products woocommerce owl-btn-vertical-center">
						<?php
						$current_size = 1;
						while($the_query->have_posts()){ 
							$the_query->the_post();
							global $post,$product;
							$product = wc_get_product($post->ID);
							
							$custom_field_text = get_field('custom_field_text', $post->ID);
							$custom_field_value = get_field('custom_field_value', $post->ID);
							$custom_field_2_text = get_field('custom_field_2_text', $post->ID);
							$custom_field_2_value = get_field('custom_field_2_value', $post->ID);
							?>
							<!-- COLUMNS 1 -->
							<div class="item">
								<div class="wt-box wt-product-box overflow-hide">
									<div class="wt-thum-bx wt-img-overlay1">
										<?php echo get_the_post_thumbnail($post->ID,'full'); ?>
										<div class="overlay-bx">
											<div class="overlay-icon">
												<?php
												echo apply_filters(
													'woocommerce_loop_add_to_cart_link',
													sprintf(
														'<a href="%s" rel="nofollow" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button %s %s product_type_%s"><i class="fa fa-cart-plus wt-icon-box-xs"></i></a>',
														apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) ),
														esc_attr( isset( $quantity ) ? $quantity : 1 ),
														esc_attr( $product->get_id() ),
														esc_attr( $product->get_sku() ),
														$product->is_purchasable() ? 'add_to_cart_button' : '',
														$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
														esc_attr( $product->get_type() ),
														esc_html( $product->add_to_cart_text() )
													),
													$product
												);  ?>
												<a class="mfp-link" href="javascript:void(0);">
													<i class="fa fa-heart wt-icon-box-xs"></i>
												</a>
										  </div>
										</div>
									</div>
									<div class="wt-info">
										<div class="p-a20 bg-white">
											<h4 class="wt-title">
												<a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
											</h4>
											<div class="product-features-item"><span><?php echo esc_attr($custom_field_text); ?> | </span><?php echo esc_attr($custom_field_value); ?></div>  
											<div class="product-features-item"><span><?php echo esc_attr($custom_field_2_text); ?> | </span><?php echo esc_attr($custom_field_2_value); ?></div> 
											<span class="price">
												<ins>
													<span><?php echo wp_kses($product->get_price_html(),$dronza_allowed_html); ?></span>
												</ins>
											</span>
										</div>
									</div>
								</div>
							</div>
							<?php
						}	?>
					</div>
				</div>
            </div>
			
			<?php
		}
		wp_reset_postdata();
	}
}