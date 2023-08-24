<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product,$dronza_allowed_html;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( '', $product ); ?>>
	<div class="wt-box wt-product-box  overflow-hide">
		<div class="wt-thum-bx wt-img-overlay1">
			<?php echo get_the_post_thumbnail($product->get_id(),'dronza-projects-medium'); ?>
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
		<div class="wt-info  text-center">
			<div class="p-a20 bg-white">
				<h3 class="wt-title">
					<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>"><?php echo esc_attr(get_the_title($product->get_id())); ?></a>
				</h3>
				<span class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?> price"><?php echo wp_kses($product->get_price_html(),$dronza_allowed_html); ?></span>
			</div>
		</div>
	</div>
</li>
