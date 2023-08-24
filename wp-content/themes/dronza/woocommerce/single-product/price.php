<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product,$dronza_allowed_html;

?>
<div class="product-single-price">
	<span class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo wp_kses($product->get_price_html(),$dronza_allowed_html); ?></span>
</div>
<div class="product-single-availability">
	<?php echo esc_html__('Availability:','dronza'); ?> 
	<span>
	<?php if($product->is_in_stock()){
		echo 'In Stock';
	}else{
		echo 'Out Of Stock';
	} ?>
	</span>
</div>
<?php
if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>
<div class="product-single-rating">
	<span class="rating-bx">
			<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
			<?php if ( comments_open() ) : ?>
				<?php //phpcs:disable ?>
				<a href="#reviews" class="font-weight-600 text-black woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'dronza' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a>
				<?php // phpcs:enable ?>
			<?php endif ?>
	</span>
</div>
<?php endif; ?>