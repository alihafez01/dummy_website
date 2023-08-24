<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class News_Section extends Widget_Base {

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
		return 'news-section';
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
		return __( 'News Section', 'gridvalley-core' );
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
			'news_section',
			[
				'label' => __( 'News Section', 'gridvalley-core' ),
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
		
		$post_categories = get_terms( array(
			'taxonomy' => 'category',
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
			'title_characters',
			[
				'label' => __( 'Title Characters to Fetch', 'gridvalley-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50,
			]
		);
		
		$this->add_control(
			'description_characters',
			[
				'label' => __( 'Description Characters to Fetch', 'gridvalley-core' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 50,
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
					'select_style' => ['style1','style2','style4'],
				]
			]
		);
		
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'gridvalley-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '', 'gridvalley-core' ),
				'condition' => [
					'select_style' => [ 'style1' ,'style2','style3'],
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
					'select_style' => [ 'style1','style2','style3'],
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
					'select_style' => [ 'style1','style3'],
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
			'post_type' => 'post',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'post_id',
					'terms'    => $settings['post_categories'],
				),
			)
		);
		
		$the_query = new \WP_Query($args);
		if($settings['select_style'] == 'style1'){ ?>
			<div class="section-full  p-t80 p-b50">
				<?php
				if($settings['title'] <> ''){ ?>
					<div class="wt-separator-two-part">
						<div class="row wt-separator-two-part-row">
							<div class="col-lg-5 col-md-6 wt-separator-two-part-left">
								<!-- TITLE START-->
								<div class="section-head left wt-small-separator-outer">
									<div class="wt-small-separator site-text-primary">
										<div  class="sep-leaf-left"></div>
										<div><?php echo esc_attr($settings['caption']); ?></div>
										<div  class="sep-leaf-right"></div>
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
					<?php
				} ?>
				<div class="section-content">
					<div class="row d-flex justify-content-center blog-post-1-outer">
						<?php
						$current_size = 1;
						while($the_query->have_posts()){ 
							$the_query->the_post();
							global $post;
							$comment_count = wp_count_comments( $post->ID );
							$comment_count = $comment_count->total_comments;
							if($comment_count == 1){
								$dronza_comment_format = esc_attr__('Comment','gridvalley-core');
							}else{
								$dronza_comment_format = esc_attr__('Comments','gridvalley-core');
							}
							$post_categories = wp_get_post_categories( $post->ID );
							
							?>
							<div class="col-lg-4 col-md-6 col-sm-12">
								<!--Block one-->
								<div class="blog-post date-style-2">
									<div class="wt-post-info bg-white">
										<div class="wt-post-meta ">
											<ul>
												<li class="post-date"><?php echo esc_attr(get_the_date(get_option('date_format'))); ?></li>
											</ul>
										</div>                                 
										<div class="wt-post-title ">
											<h4 class="post-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_attr(substr(get_the_title($post->ID),0,$settings['title_characters'])); ?></a></h4>
										</div>
										<div class="wt-post-text ">
											<p><?php echo esc_attr(strip_tags(get_the_excerpt($post->ID))); ?></p>
										</div>                                           
										<div class="wt-post-readmore ">
											<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="site-button-link black"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
										</div>                                        
								   </div>                                
								</div>
							</div>
							<?php
						} ?>
					</div>
					<?php 
					if($settings['pagination'] == 'yes'){
						echo dronza_pagination($the_query);
					} ?>
				</div>
			</div>
			<?php
		}else if($settings['select_style'] == 'style2'){ ?>
			<!-- OUR BLOG START -->
            <div class="section-full  p-t80 p-b50">
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

				<div class="section-content">
					<div class="row d-flex justify-content-center">
						<?php
						$current_size = 1;
						while($the_query->have_posts()){ 
							$the_query->the_post();
							global $post;
							$comment_count = wp_count_comments( $post->ID );
							$comment_count = $comment_count->total_comments;
							if($comment_count == 1){
								$dronza_comment_format = esc_attr__('Comment','gridvalley-core');
							}else{
								$dronza_comment_format = esc_attr__('Comments','gridvalley-core');
							}
							$img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
							$custom_css ='.blog-style-large .wt-post-media{background-image:url('.esc_url($img_src[0]).');}';

							wp_enqueue_style('industroz-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
							wp_add_inline_style( 'industroz-inline-style', $custom_css);
							?>
							<div class="col-lg-5 col-md-12">
								<!--Block one-->
								<div class="blog-post blog-style-large">
									<div class="wt-post-media" ></div>                                    
									<div class="wt-post-info bg-white p-a30">
										<div class="wt-post-meta ">
											<ul>
												<li class="post-date"><?php echo esc_attr(get_the_date(get_option('date_format'))); ?></li>
											</ul>
										</div>                                 
										<div class="wt-post-title ">
											<h4 class="post-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_attr(substr(get_the_title($post->ID),0,$settings['title_characters'])); ?></a></h4>
										</div>
								   </div>                                
								</div>
							</div>
							<?php
							break;
						} ?>
						<div class="col-lg-7 col-md-12">
							<div class="row blog-block-style">
								<?php
								$current_size = 1;
								while($the_query->have_posts()){ 
									$the_query->the_post();
									global $post;
									$comment_count = wp_count_comments( $post->ID );
									$comment_count = $comment_count->total_comments;
									if($comment_count == 1){
										$dronza_comment_format = esc_attr__('Comment','gridvalley-core');
									}else{
										$dronza_comment_format = esc_attr__('Comments','gridvalley-core');
									}
									
									?>
									<div class="col-lg-6 col-md-6">
										<!--Block two-->
										<div class="blog-post blog-style-3 shadow p-l20 p-r20">
											<div class="wt-post-info">
												<div class="wt-post-meta ">
													<ul>
														<li class="post-date"><?php echo esc_attr(get_the_date(get_option('date_format'))); ?></li>                                    
													</ul>
												</div>                                  
												<div class="wt-post-title ">
													<h4 class="post-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_attr(substr(get_the_title($post->ID),0,$settings['title_characters'])); ?></a></h4>
												</div>
												<div class="wt-post-text ">
													<p><?php echo esc_attr(strip_tags(get_the_excerpt($post->ID))); ?></p>
												</div>                                           
												<div class="wt-post-readmore ">
													<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="site-button-link black"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
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
			<?php
		}else if($settings['select_style'] == 'style3'){ ?>
			<div class="section-full  p-t80">
				<div class="wt-separator-two-part">
					<div class="row wt-separator-two-part-row">
						<div class="col-lg-5 col-md-6 wt-separator-two-part-left">
							<!-- TITLE START-->
							<div class="section-head left wt-small-separator-outer">
								<div class="wt-small-separator site-text-primary">
									<div  class="sep-leaf-left"></div>
									<div><?php echo esc_attr($settings['caption']); ?></div>
									<div  class="sep-leaf-right"></div>
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
				<div class="section-content">
					<div class="row d-flex justify-content-center">
						<?php
						$current_size = 1;
						while($the_query->have_posts()){ 
							$the_query->the_post();
							global $post;
							$comment_count = wp_count_comments( $post->ID );
							$comment_count = $comment_count->total_comments;
							if($comment_count == 1){
								$dronza_comment_format = esc_attr__('Comment','gridvalley-core');
							}else{
								$dronza_comment_format = esc_attr__('Comments','gridvalley-core');
							}
							
							?>
							<div class="col-lg-4 col-md-6 col-sm-12 m-b30">
								<!--Block one-->
								<div class="blog-post blog-style-1 shadow">
									<div class="wt-post-media wt-img-effect zoom-slow">
										<a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
											<?php echo get_the_post_thumbnail($post->ID,'dronza-post-medium'); ?>
										</a>
									</div>                                    
									<div class="wt-post-info bg-white">
										<div class="wt-post-meta ">
											<ul>
												<li class="post-date"><?php echo esc_attr(get_the_date(get_option('date_format'))); ?></li>
											</ul>
										</div>                                 
										<div class="wt-post-title ">
											<h4 class="post-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_attr(substr(get_the_title($post->ID),0,$settings['title_characters'])); ?></a></h4>
										</div>
										<div class="wt-post-text ">
											<p><?php echo esc_attr(strip_tags(get_the_excerpt($post->ID))); ?></p>
										</div>                                           
										<div class="wt-post-readmore ">
											<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="site-button-link black"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
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
		}else if($settings['select_style'] == 'style4'){ ?>
			<div class="section-content">
				<div class="blog-list-style-outer">
					<?php
					$current_size = 1;
					while($the_query->have_posts()){ 
						$the_query->the_post();
						global $post;
						$comment_count = wp_count_comments( $post->ID );
						$comment_count = $comment_count->total_comments;
						if($comment_count == 1){
							$dronza_comment_format = esc_attr__('Comment','gridvalley-core');
						}else{
							$dronza_comment_format = esc_attr__('Comments','gridvalley-core');
						}
						
						?>
						
						<div class="blog-post blog-style-1 blog-list-style shadow">
							<div class="wt-post-media wt-img-effect clear zoom-slow">
								<a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
									<?php echo get_the_post_thumbnail($post->ID,'full'); ?>
								</a>
							</div>                                    
							<div class="wt-post-info clear">
								<div class="wt-post-meta ">
									<ul>
										<li class="post-date"><?php echo esc_attr(get_the_date(get_option('date_format'))); ?></li>
									</ul>
								</div>                                 
								<div class="wt-post-title ">
									<h3 class="post-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_attr(substr(get_the_title($post->ID),0,$settings['title_characters'])); ?></a></h3>
								</div>
								<div class="wt-post-text ">
									<p><?php echo esc_attr(substr(strip_tags(get_the_content($post->ID)),0,$settings['description_characters'])); ?></p>
								</div>                                           
								<div class="wt-post-readmore ">
									<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" class="site-button-link black"><?php echo esc_attr__('Read More','gridvalley-core'); ?></a>
								</div>                                        
						   </div>                                
						</div>
						<?php
					} ?>
				</div>
				<?php 
				if($settings['pagination'] == 'yes'){
					echo dronza_pagination($the_query);
				} ?>
			</div>
			<?php
		}
		
		wp_reset_postdata();
	}
}