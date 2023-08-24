<?php
/**
 * The template for displaying all pages
 */

	get_header(); 
	if( in_array('elementor/elementor.php', apply_filters( 'active_plugins', get_option('active_plugins' )))  && class_exists('Elementor\Core\Admin\Admin')) {
		if(Elementor\Plugin::instance()->db->is_built_with_elementor( get_the_id() )){
			while ( have_posts() ) : the_post();

				the_content();
				
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dronza' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text"></span>%',
					'separator'   => '<span class="screen-reader-text"></span>',
				) );

			endwhile; // End of the loop.	
		}else{ ?>
			<div class="section-full p-t80 dronza-content-area">
				<div class="container">
					<?php
					while ( have_posts() ) : the_post(); ?>
						<div class="dronza-default-content">
							<?php
							the_content();

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dronza' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text"></span>%',
								'separator'   => '<span class="screen-reader-text"></span>',
							) );
							?>
						</div>
						<?php	
						/**
						 *  Output comments wrapper if it's a post, or if comments are open,
						 * or if there's a comment number – and check for password.
						 * */
						if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
							comments_template(); 
						}
			
					endwhile; // End of the loop.
					?>
					
					<?php dronza_edit_link(get_the_ID()); ?>
					
				</div>
			</div>
			<?php
		}
	}else{ ?>
		<div class="section-full p-t80 dronza-content-area">
			<div class="container">
				<?php
				while ( have_posts() ) : the_post(); ?>
					<div class="dronza-default-content">
						<?php
						the_content();

						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'dronza' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text"></span>%',
							'separator'   => '<span class="screen-reader-text"></span>',
						) );
						?>
					</div>
					<?php	
					/**
					 *  Output comments wrapper if it's a post, or if comments are open,
					 * or if there's a comment number – and check for password.
					 * */
					if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
						comments_template(); 
					}
		
				endwhile; // End of the loop.
				?>
			</div>
		</div>
		<?php
	} ?>
	<?php get_footer(); ?>