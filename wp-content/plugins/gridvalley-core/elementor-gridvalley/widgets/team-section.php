<?php
namespace ElementorGridValley\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Team_Section extends Widget_Base {

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
		return 'team-section';
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
		return __( 'Team Section', 'gridvalley-core' );
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
			'team_section',
			[
				'label' => __( 'Team Section', 'gridvalley-core' ),
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
		
		$team_categories = get_terms( array(
			'taxonomy' => 'team_category',
			'hide_empty' => false
		) );
		$options = [];
		foreach ( $team_categories as $category ) {
			$options[ $category->term_id ] = $category->name;
		}

		$this->add_control(
			'team_categories',
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
			'post_type' => 'team',
			'posts_per_page' => $settings['posts_per_page'],
			'orderby' => $settings['orderby'],
			'order' => $settings['order'],
			'paged' => $paged,
			'tax_query' => array(
				array(
					'taxonomy' => 'team_category',
					'field'    => 'post_id',
					'terms'    => $settings['team_categories'],
				),
			)
		);
		
		$the_query = get_posts( $args );
		
		if($settings['select_style'] == 'style1'){ ?>
			<div class="section-full p-t80 p-b50">
				<!-- TITLE START-->
				<div class="section-head center wt-small-separator-outer text-center">
					<div class="wt-small-separator site-text-primary">
						<div  class="sep-leaf-left"></div>
						<div><?php echo esc_attr($settings['caption']); ?></div>
						<div  class="sep-leaf-right"></div>
					</div>
					<h2><?php echo esc_attr($settings['title']); ?></h2>
				</div>
				<div class="section-content">
					<div class="row justify-content-center">
						<?php
						$current_size = 1;
						foreach($the_query as $query){
							$designation = get_field('designation', $query->ID);
							$facebook_url = get_field('facebook_url', $query->ID);
							$twitter_url = get_field('twitter_url', $query->ID);
							$instagram_url = get_field('instagram_url', $query->ID);
							$linkedin = get_field('linkedin', $query->ID);
							
							?>
							<div class="col-lg-4 col-md-6 col-sm-12 m-b30">
								<div class="wt-team-1">
									<div class="wt-media">
										<?php echo get_the_post_thumbnail($query->ID,'full'); ?>
									</div>  
									<div class="wt-info">
										<div class="team-detail p-t30">
											<span class="title-style-2 team-position site-text-primary"><?php echo esc_attr($designation); ?></span>                                        
											<h4 class="m-t0 team-name"><?php echo esc_attr(get_the_title($query->ID)); ?></h4>
										</div>
										<div class="team-social-center">
											<ul class="team-social-bar">
												<?php
												if($facebook_url <> ''){ ?>
													<li><a href="<?php echo esc_url($facebook_url); ?>"><?php echo esc_attr__('Facebook','dronza'); ?></a></li>
													<?php
												} 
												if($twitter_url <> ''){ ?>
													<li><a href="<?php echo esc_url($twitter_url); ?>"><?php echo esc_attr__('Twitter','dronza'); ?></a></li>
												<?php
												} 
												if($instagram_url <> ''){ ?>
													<li><a href="<?php echo esc_url($instagram_url); ?>"><?php echo esc_attr__('Instagram','dronza'); ?></a></li>
												<?php
												} 
												if($linkedin <> ''){ ?>
													<li><a href="<?php echo esc_url($linkedin); ?>"><?php echo esc_attr__('Linkedin','dronza'); ?></a></li>
												<?php
												} ?>
											</ul>
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
		}else if($settings['select_style'] == 'style2'){ ?>
			<div class="section-full p-t80 p-b50">
				<!-- TITLE START-->
				<div class="section-head center wt-small-separator-outer text-center">
					<div class="wt-small-separator site-text-primary">
						<div  class="sep-leaf-left"></div>
						<div><?php echo esc_attr($settings['caption']); ?></div>
						<div  class="sep-leaf-right"></div>
					</div>
					<h2><?php echo esc_attr($settings['title']); ?></h2>
				</div>
				<div class="section-content">
					<div class="row justify-content-center">
						<?php
						$current_size = 1;
						foreach($the_query as $query){
							$designation = get_field('designation', $query->ID);
							$facebook_url = get_field('facebook_url', $query->ID);
							$twitter_url = get_field('twitter_url', $query->ID);
							$instagram_url = get_field('instagram_url', $query->ID);
							$linkedin = get_field('linkedin', $query->ID);
							
							?>
							<div class="col-lg-4 col-md-6 col-sm-12 m-b30">
								<div class="wt-team-2">
									<div class="wt-media">
										<?php echo get_the_post_thumbnail($query->ID,'full'); ?>
									</div> 
									<div class="wt-info">
										<div class="team-detail">
											<span class="title-style-2 team-position site-text-primary"><?php echo esc_attr($designation); ?></span>                                        
											<h4 class="m-t0 team-name"><?php echo esc_attr(get_the_title($query->ID)); ?></h4>
										</div>
										<div class="team-social-center">
											<ul class="team-social-bar">
												<?php
												if($facebook_url <> ''){ ?>
													<li><a href="<?php echo esc_url($facebook_url); ?>"><?php echo esc_attr__('Facebook','dronza'); ?></a></li>
													<?php
												} 
												if($twitter_url <> ''){ ?>
													<li><a href="<?php echo esc_url($twitter_url); ?>"><?php echo esc_attr__('Twitter','dronza'); ?></a></li>
												<?php
												} 
												if($instagram_url <> ''){ ?>
													<li><a href="<?php echo esc_url($instagram_url); ?>"><?php echo esc_attr__('Instagram','dronza'); ?></a></li>
												<?php
												} 
												if($linkedin <> ''){ ?>
													<li><a href="<?php echo esc_url($linkedin); ?>"><?php echo esc_attr__('Linkedin','dronza'); ?></a></li>
												<?php
												} ?>
											</ul>
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
		}
		wp_reset_postdata();
	}
}