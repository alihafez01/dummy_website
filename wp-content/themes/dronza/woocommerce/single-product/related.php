<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $dronza_allowed_html;

if ( $related_products ) : ?>

	<div class="section-full p-t80 p-b80 bg-gray">
		<div class="container">
			<div class="section-content">
				<?php
				$heading = apply_filters( 'woocommerce_product_related_products_heading', esc_attr__( 'Related products', 'dronza' ) );

				if ( $heading ) :
					?>
					<div class="wt-separator-two-part">
						<div class="row wt-separator-two-part-row">
							<div class="col-lg-12 col-md-12 wt-separator-two-part-left">
								<div class="section-head left wt-small-separator-outer">
									<h2><?php echo esc_html( $heading ); ?></h2>
								</div>
							</div>
						</div>
					</div>
					
				<?php endif; ?>
				
				<div class="owl-carousel featured-products owl-btn-vertical-center">

					<?php foreach ( $related_products as $related_product ) : ?>

							<?php
							$post_object = get_post( $related_product->get_id() );

							setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
							global $post,$product;
							?>
							<div class="item">
                                <div class="wt-box wt-product-box   overflow-hide">
                                    <div class="wt-thum-bx wt-img-overlay1">
                                        <?php echo get_the_post_thumbnail($post->ID , 'full'); ?>
                                        <div class="overlay-bx">
                                            <div class="overlay-icon">
                                                <?php
												echo apply_filters(
													'woocommerce_loop_add_to_cart_link',
													sprintf(
														'<a href="%s" rel="nofollow" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="button add2cart %s %s product_type_%s"><i class="fa fa-cart-plus wt-icon-box-xs"></i></a>',
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
                                    <div class="wt-info ">
                                         <div class="p-a20 bg-white">
                                            <h3 class="wt-title">
                                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                            </h3>
											<span class=" <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?>"><?php echo wp_kses($product->get_price_html(),$dronza_allowed_html); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
					<?php endforeach; ?>

				</div>

			</div>
		</div>
	</div>
	<?php
endif;
wp_reset_postdata();