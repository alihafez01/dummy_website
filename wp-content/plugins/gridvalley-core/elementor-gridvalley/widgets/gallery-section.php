<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Gallery_Section extends Widget_Base {

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
		return 'gallery-section';
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
		return __( 'Gallery Section', 'gridvalley-core' );
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
			'gallery_section',
			[
				'label' => __( 'Gallery Section', 'gridvalley-core' ),
			]
		);
		
		$this->add_control(
			'select_style',
			[
				'label' => __( 'Select Style', 'gridvalley-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => __( 'Style 1(Slider)', 'gridvalley-core' ),
					'style2' => __( 'Style 2(Slider)', 'gridvalley-core' ),
					'style3' => __( 'Style 3', 'gridvalley-core' ),
					'style4' => __( 'Style 4', 'gridvalley-core' ),
					
				],
			]
		);
		
		$gallery_categories = get_terms( array(
			'taxonomy' => 'gallery_category',
			'hide_empty' => false
		) );
		$options = [];
		foreach ( $gallery_categories as $category ) {
			$options[ $category->term_id ] = $category->name;
		}

		$this->add_control(
			'gallery_categories',
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
			'element_title',
			[
				'label' => __( 'Element Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style1','style2'],
				]
			]
		);
		$this->add_control(
			'element_caption',
			[
				'label' => __( 'Element Caption', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style1','style2'],
				]
			]
		);
		
		$this->add_control(
			'description',
			[
				'label' => __( 'Description', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style1','style2'],
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
			'post_type' => 'gallery',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => 'gallery_category',
					'field'    => 'post_id',
					'terms'    => $settings['gallery_categories'],
				),
			)
		);
		
		$the_query = get_posts( $args );
		
		if($settings['select_style'] == 'style1'){ ?>
			
			<div class="section-full  p-t80 p-b80 site-bg-primary">
				<div class="container">
                	<div class="wt-separator-two-part">
                    	<div class="row wt-separator-two-part-row text-white">
                        	<div class="col-lg-5 col-md-6 wt-separator-two-part-left">
                                <!-- TITLE START-->
                                <div class="section-head left wt-small-separator-outer">
                                    <div class="wt-small-separator text-white">
                                        <div  class="sep-leaf-left"></div>
                                        <div><?php echo esc_attr($settings['element_caption']); ?></div>
                                        <div  class="sep-leaf-right"></div>
                                    </div>
                                    <h2><?php echo esc_attr($settings['element_title']); ?></h2>
                                </div>
                                <!-- TITLE END-->
                            </div>
                            <div class="col-lg-7 col-md-6 wt-separator-two-part-right text-left">
                                <p><?php echo esc_attr($settings['description']); ?></p>
                            </div>  
                    	</div>
                    </div>
     			</div>
				<div class="section-content"> 
					<div class="video-gallery-block-outer">
						<div class="container-fluid">
							<div class="video-gallery-style1">
								<div class="owl-carousel video-gallery-one light-dotts-line left ">
									<?php
									foreach($the_query as $query){
										$video_link = get_field('video_link', $query->ID);
										
										?>
										<div class="item">
											<div class="video-gallery-block">
												<div class="video-media">
													<?php echo get_the_post_thumbnail($query->ID,'full'); ?>
												</div>
												<div class="video-media-info">
													 <a href="<?php echo esc_url($video_link); ?>" class="mfp-gallery site-bg-primary">
														<i class="fa fa-play"></i>
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
				</div>
			</div>
			<?php
		}else if($settings['select_style'] == 'style2'){
			?>
			<div class="section-full  p-t80 p-b80">
				<div class="wt-separator-two-part">
					<div class="row wt-separator-two-part-row text-white">
						<div class="col-lg-5 col-md-6 wt-separator-two-part-left">
							<!-- TITLE START-->
							<div class="section-head left wt-small-separator-outer">
								<div class="wt-small-separator text-white">
									<div  class="sep-leaf-left"></div>
									<div><?php echo esc_attr($settings['element_caption']); ?></div>
									<div  class="sep-leaf-right"></div>
								</div>
								<h2><?php echo esc_attr($settings['element_title']); ?></h2>
							</div>
							<!-- TITLE END-->
						</div>
						<div class="col-lg-7 col-md-6 wt-separator-two-part-right text-left">
							<p><?php echo esc_attr($settings['description']); ?></p>
						</div>
					</div>
				</div>
                <div class="section-content">  
					<div class="gallery-large-block-outer">
						<div class="mfp-gallery slider-for">
							<?php
							foreach($the_query as $query){
								$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($query->ID),'full');
								?>
								<!--block 1-->
								<div>
									<div class="gallery-large">
										<div class="gallery-large-media">
											<?php echo get_the_post_thumbnail($query->ID,'full'); ?>
										</div>
										<div class="gallery-large-info">
											<div class="gallery-large-control text-white">
												<ul>
													<li><a href="<?php echo esc_url($img_src[0]); ?>" class="mfp-link"><i class="fa fa-search-plus"></i></a></li>
													<li><a href="<?php echo esc_url(get_permalink($query->ID)); ?>"><i class="flaticon-chain-links"></i></a></li>
												</ul>
											</div>
											<h4 class="g-title site-text-white"><?php echo esc_attr(get_the_title($query->ID)); ?></h4>
										</div>
									</div>
								</div>
								<?php
							} ?>
						</div>
						<div  class="gallery-large-thumb slider-nav">
							<?php
							foreach($the_query as $query){
								?>	
								<div>
									<div class="gallery-thumb">
										<div class="gallery-thumb-media">
											<?php echo get_the_post_thumbnail($query->ID,'full'); ?>
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
		}else if($settings['select_style'] == 'style3'){
			
			$cat_count = count($settings['gallery_categories']);
			?>
			<!-- GALLERY SECTION START -->
            <div class="section-full p-t80 p-b50">
				<!-- PAGINATION START -->
				<div class="filter-wrap work-grid p-b30 text-center">
					<ul class="masonry-filter">
						<li class="active"><a data-filter="*" href="#"><?php echo esc_attr__('All','gridvalley-core'); ?></a></li>
						<?php
						for($i=0; $i<$cat_count; $i++){
							$c = get_term($settings['gallery_categories'][$i]);
							$icon_class = get_field('icon_class', $c);
							$term_name = get_term( $settings['gallery_categories'][$i] )->name;
							?>
							<li><a data-filter=".cat-<?php echo esc_attr($settings['gallery_categories'][$i]); ?>" href="#"><?php echo esc_attr($term_name); ?></a></li>
							<?php
						} ?>
					</ul>
				</div>
				<div class="masonry-wrap mfp-gallery row clearfix d-flex justify-content-center flex-wrap">
					<!-- COLUMNS 1 -->
					<?php
					$current_size = 1;
					foreach($the_query as $query){
						$cat_ids = '';
						$gallery_name = get_field('gallery_name', $query->ID);
						
						$gallery_terms = get_the_terms( $query->ID, 'gallery_category' );
						$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($query->ID),'full');
						foreach($gallery_terms as $gallery_term){
							$cat_ids .=  'cat-' . $gallery_term->term_id . ' ';
						}
						
						?>
						<div class="masonry-item <?php echo esc_attr($cat_ids); ?> col-xl-3 col-lg-4 col-md-6 m-b30">
							<div class="galleryhvr-zoom-out-down">
								<?php echo get_the_post_thumbnail($query->ID,'dronza-gallery-medium'); ?>
								<div class="galleryhvr-content">
									<div class="galleryhvr-mid">
										<h4 class="wt-title"><?php echo esc_attr(get_the_title($query->ID)); ?></h4>
										<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,104)); ?></p>
										<a href="<?php echo esc_url(get_permalink($query->ID)); ?>"><i class="flaticon-chain-links"></i></a>
										<a href="<?php echo esc_url($img_src[0]); ?>" class="mfp-link"><i class="fa fa-search-plus"></i></a>
									</div>
								</div>
							</div>   
						</div>
						<?php
					} ?>
				</div>
            </div>   
			<?php
		}else if($settings['select_style'] == 'style4'){
			$cat_count = count($settings['gallery_categories']);
			?>
			<div class="section-full p-t80 p-b50">
				<!-- PAGINATION START -->
				<div class="filter-wrap work-grid p-b30 text-center">
					<ul class="masonry-filter">
						<li class="active"><a data-filter="*" href="#"><?php echo esc_attr__('All','gridvalley-core'); ?></a></li>
						<?php
						for($i=0; $i<$cat_count; $i++){
							$c = get_term($settings['gallery_categories'][$i]);
							$icon_class = get_field('icon_class', $c);
							$term_name = get_term( $settings['gallery_categories'][$i] )->name;
							?>
							<li><a data-filter=".cat-<?php echo esc_attr($settings['gallery_categories'][$i]); ?>" href="#"><?php echo esc_attr($term_name); ?></a></li>
							<?php
						} ?>
					</ul>
				</div>
				<div class="masonry-wrap mfp-gallery  row clearfix d-flex justify-content-center flex-wrap">
					<?php
					$current_size = 1;
					
					foreach($the_query as $query){
						$cat_ids = '';
						$gallery_name = get_field('gallery_name', $query->ID);
						$gallery_terms = get_the_terms( $query->ID, 'gallery_category' );
						$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($query->ID),'full');
						foreach($gallery_terms as $gallery_term){
							$cat_ids .=  'cat-' . $gallery_term->term_id . ' ';
						} ?>
						
						<div class="masonry-item <?php echo esc_attr($cat_ids); ?> col-xl-4 col-lg-4 col-md-6 m-b30">
							<div class="galleryhvr-zoom-out-down">
								<?php echo get_the_post_thumbnail($query->ID,'dronza-gallery-medium'); ?>
								<div class="galleryhvr-content">
									<div class="galleryhvr-mid">
										<h4 class="wt-title"><?php echo esc_attr(get_the_title($query->ID)); ?></h4>
										<p><?php echo esc_attr(substr(strip_tags($query->post_content),0,49)); ?></p>
										<a href="<?php echo esc_url(get_permalink($query->ID)); ?>"><i class="flaticon-chain-links"></i></a>
										<a href="<?php echo esc_url($img_src[0]); ?>" class="mfp-link"><i class="fa fa-search-plus"></i></a>
									</div>
								</div>
							</div>     
						</div>                     
						<?php
					} ?>
				</div>
            </div>
			<?php
		}  
		wp_reset_postdata();
	}
}