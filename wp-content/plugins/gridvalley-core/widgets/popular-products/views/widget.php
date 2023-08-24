<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_title
 * @var string $after_title
 * @var string $before_widget
 * @var string $after_widget
 */
	global $dronza_allowed_html;

	echo wp_kses($before_widget,$dronza_allowed_html);

	if($query->have_posts()){ ?>   
			<?php
			if( !empty($title) ){ 
				echo wp_kses($args['before_title'],$dronza_allowed_html) . esc_attr($title) . $args['after_title']; 
			}
			?>                               
			<div class="section-content">
				<div class="product-widget">
					<?php
					$current_size = 1;
					while($query->have_posts()){ 
						$query->the_post();
						global $post,$product;
						?>
						<div class="product-widget-box clearfix">
							<div class="product-widget-media">
								<?php echo get_the_post_thumbnail($post->ID,'full'); ?>
							</div>
							<div class="product-widget-info">
								<div class="product-widget-header">
									<a href="<?php echo esc_url(get_permalink()); ?>" class="product-widget-title"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
								</div>
								<span class="price">
									<ins>
										<span><?php echo wp_kses($product->get_price_html(),$dronza_allowed_html); ?></span>
									</ins>
								</span>                                                                                                                
							</div>
						</div>
						<?php
					} ?>
				</div>
			</div>
		<?php
	}
	wp_reset_postdata();
	echo wp_kses($after_widget,$dronza_allowed_html); ?>