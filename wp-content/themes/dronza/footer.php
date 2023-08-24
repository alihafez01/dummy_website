<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */
	if( is_404() ){
		
	}else{ ?>
		</div>
			<?php 
			global $dronza_allowed_html;
			if(class_exists('ACF')){
				$select_footer_style = get_field('select_footer_style','option');
				$copyright_text = get_field('copyright_text','option');
				$footer_logo = get_field('footer_logo','option');
				
				$facebook_social = get_field('facebook_social', 'option');
				$google_social = get_field('google_social', 'option');
				$linkedin_social = get_field('linkedin_social', 'option');
				$twitter_social = get_field('twitter_social', 'option');
				$instagram_social = get_field('instagram_social', 'option');
				$youtube_social = get_field('youtube_social', 'option');
		
			}
			if(isset($select_footer_style) && $select_footer_style == 'footer-1'){ ?>
				<!-- FOOTER START -->
				<footer class="site-footer footer-large footer-dark text-white default-footer footer-style1" >
					<!-- FOOTER BLOCKES START -->  
					<div class="footer-top">
						<div class="container">
							<div class="row">
								<?php
								if( is_active_sidebar( 'sidebar-footer' )){ ?>
									<?php dynamic_sidebar('Footer'); ?>                              
									<?php
								} ?>	
							</div>
						</div>
					</div>
					<!-- FOOTER COPYRIGHT -->
							
					<div class="footer-middle">
						<div class="container">
							<div class="footer-middle-content">
								<div class="logo-footer">
									<a href="<?php echo esc_url(get_home_url()); ?>"><img src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr__('home image','dronza'); ?>" ></a>
								</div>
								<?php
								// navigation
								if( has_nav_menu('footer_menu') ){
									$args = array(
										'menu'=>'',
										'menu_class'=> 'copyrights-nav',
										'menu_id'=> '',
										'container'=> 'ul',
										'container_class'=> '',
										'container_id'=> '',
										'fallback_cb'=> '',
										'before'=> '',
										'after'=> '',
										'link_before'=> '',
										'link_after'=> '',
										'echo'=> 'true',
										'depth'=> '0',
										'theme_location'=>'footer_menu', 
										'items_wrap'=>'<ul id="%1$s" class="%2$s">%3$s</ul>', 	
										'item_spacing'=>'preserve'	 
									);
									wp_nav_menu( $args);
								} ?>
								<ul class="social-icons  wt-social-links footer-social-icon">
									<?php
									if($google_social <> ''){ ?>
										<li><a href="<?php echo esc_url($google_social); ?>" class="fa fa-google"></a></li>
										<?php
									}
									
									if($linkedin_social <> ''){ ?>
										<li><a href="<?php echo esc_url($linkedin_social); ?>" class="fa fa-linkedin"></a></li>
										<?php
									}
									if($twitter_social <> ''){ ?>
										<li><a href="<?php echo esc_url($twitter_social); ?>" class="fa fa-twitter"></a></li>
										<?php
									}
									if($facebook_social <> ''){ ?>
										<li><a href="<?php echo esc_url($facebook_social); ?>" class="fa fa-facebook"></a></li>
										<?php
									}
									if($youtube_social <> ''){ ?>
										<li><a href="<?php echo esc_url($youtube_social); ?>" class="fa fa-youtube"></a></li>
										<?php
									}
									if($instagram_social <> ''){ ?>
										<li><a href="<?php echo esc_url($instagram_social); ?>" class="fa fa-instagram"></a></li>
										<?php
									} ?>
								</ul>                     
							</div>
						</div>
					</div>                    
					<div class="footer-bottom">
						<div class="container">
							<div class="wt-footer-bot-left d-flex justify-content-center">
								<span class="copyrights-text"><?php echo wp_kses($copyright_text,$dronza_allowed_html); ?></span>
							</div>
						</div>   
					</div>  
				</footer>
				<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>
				<?php
			}else if(isset($select_footer_style) && $select_footer_style == 'footer-2'){ ?>
				
				<?php
			}else{ ?>
				<!-- FOOTER START -->
				<footer class="site-footer footer-large footer-dark text-white footer-style1 default-footer" >				
					<?php  get_template_part( 'template-parts/footer-widgets'); ?>
					<div class="footer-bottom">
						<div class="container">
							<div class="wt-footer-bot-left d-flex justify-content-center">
								<span class="copyrights-text"><?php echo esc_html__('Copyright © 2023','dronza');?> <span><?php echo esc_html__('GridValley','dronza');?></span></span>
							</div>
						</div>   
					</div>  
				</footer>
				<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>
				<?php
			} ?>
		</div>
		<?php
	} ?>
	<?php wp_footer(); ?>
	</body>
</html>