<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

get_header();

	if (class_exists('ACF')) {
		$sidebar_status = get_field('sidebar_status',get_the_ID());
		if(isset($sidebar_status)){
			if($sidebar_status == 'true'){
				$sidebar_position = get_field('sidebar_position',get_the_ID());
				
				$content_col = 'col-lg-8 col-md-12';
				if($sidebar_position == 'pull-left'){
					$custom_css ='.section-content .row{flex-direction: row-reverse;}';
					
					wp_enqueue_style('dronza-inline-style',get_template_directory_uri() . '/assets/css/inline-style.css');
					wp_add_inline_style( 'dronza-inline-style', $custom_css);
				}else{
					
				}
			}else if($sidebar_status == 'false'){
				$content_col = 'col-lg-12 col-md-12';
			}
		}else{
			if(is_active_sidebar('default-sidebar')){
				$content_col = 'col-lg-8 col-md-12';
			}else{
				$content_col = 'col-lg-12 col-md-12';
			}
		}
		
	}else{
		if(is_active_sidebar('default-sidebar')){
			$content_col = 'col-lg-8 col-md-12';
		}else{
			$content_col = 'col-lg-12 col-md-12';
		}
	}

?>

<div class="section-full  p-t80 p-b30">
	<div class="container">
		<!-- BLOG SECTION START -->
		<div class="section-content">
			<div class="row justify-content-center">
				<div class="<?php echo esc_attr($content_col); ?>">
					<?php
					if ( have_posts() ) {
						
						/* Start the Loop */
						while ( have_posts() ) { the_post();
							get_template_part('template-parts/content');	
						}
						the_posts_pagination(
							array(
							'prev_text' => '<i class="fa fa-angle-double-left"></i>',
							 'next_text' => '<i class="fa fa-angle-double-right"></i>'
							)
						);
					}else if(is_search()){ ?>
						
						<div class="no-search-holder">
							<div class="wt-post-title ">
								<h2 class="post-title"><?php echo esc_html__('Nothing exists here','dronza'); ?></h2>
								<p><?php echo esc_html__("We couldn't find any results for your search. Try again with some different query.",'dronza'); ?></p>
							</div>
							<div class="no-search-results-form">

								<?php
								get_search_form(
									array(
										'label' => esc_attr__( 'search again', 'dronza' ),
									)
								);
								?>

							</div><!-- .no-search-results -->
						</div>
						<?php
					} ?>
				</div>
				<?php
				if (class_exists('ACF')) {
					$sidebar_status = get_field('sidebar_status',get_the_ID());
					if($sidebar_status == 'true'){ ?>
						<div class="col-lg-4 col-md-12 rightSidebar m-b30">
							<aside class="side-bar">
							<?php dynamic_sidebar('Blog Sidebar'); ?>
							</aside>
						</div>
						<?php
					}else if($sidebar_status == 'false'){
						
					}else{
						if(is_active_sidebar('default-sidebar')){
							?>
							<div class="col-lg-4 col-md-12 rightSidebar">
								<aside class="side-bar">
								<?php dynamic_sidebar('Blog Sidebar'); ?>
								</aside>
							</div>
							<?php
						}
					}
				}else if(is_active_sidebar('default-sidebar')){ ?>
					<div class="col-lg-4 col-md-12 rightSidebar">
						<aside class="side-bar">
						<?php dynamic_sidebar('Blog Sidebar'); ?>
						</aside>
					</div>
					<?php
				} ?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
