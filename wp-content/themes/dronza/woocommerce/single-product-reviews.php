<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div class="clear" id="comment-list">
	<div id="reviews" class="woocommerce-Reviews comments-area">
		<div id="comments">
			<h3 class="comment-reply-title">
				<?php
				$count = $product->get_review_count();
				if ( $count && wc_review_ratings_enabled() ) {
					/* translators: 1: reviews count 2: product name */
					$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'dronza' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
					echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
				} else {
					echo esc_html__( 'Reviews', 'dronza' );
				}
				?>
			</h3>

			<?php if ( have_comments() ) : ?>
				<ol class="commentlist">
					<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
				</ol>

				<?php
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
					echo '<nav class="woocommerce-pagination">';
					paginate_comments_links(
						apply_filters(
							'woocommerce_comment_pagination_args',
							array(
								'prev_text' => '&larr;',
								'next_text' => '&rarr;',
								'type'      => 'list',
							)
						)
					);
					echo '</nav>';
				endif;
				?>
			<?php else : ?>
				<p class="woocommerce-noreviews"><?php echo esc_html__( 'There are no reviews yet.', 'dronza' ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
			<div id="review_form_wrapper">
				<div id="review_form">
					<?php
					$commenter    = wp_get_current_commenter();
					$comment_form = array(
						/* translators: %s is product title */
						'title_reply'         => have_comments() ? esc_attr__( 'Add a review', 'dronza' ) : sprintf( esc_attr__( 'Be the first to review &ldquo;%s&rdquo;', 'dronza' ), get_the_title() ),
						/* translators: %s is product title */
						'title_reply_to'      => esc_attr__( 'Leave a Reply to %s', 'dronza' ),
						'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title">',
						'title_reply_after'   => '</h3>',
						'class_form' 			=> 'comment-form comment-form-outer',
						'comment_notes_after' => '',
						'label_submit'        => esc_attr__( 'Submit', 'dronza' ),
						'class_submit'        => 'site-button site-btn-effect',
						'id_submit'        => 'form_submit',
						'logged_in_as'			=>	'<p class="logged-in-as p5">' . sprintf( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' , admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
						'comment_field'       => '',
					);

					$name_email_required = (bool) get_option( 'require_name_email', 1 );
					$fields              = array(
						
						'author' => array(
							'label'    => esc_attr__( 'Name', 'dronza' ),
							'type'     => 'text',
							'value'    => $commenter['comment_author'],
							'required' => $name_email_required,
						),
						'email'  => array(
							'label'    => esc_attr__( 'Email', 'dronza' ),
							'type'     => 'email',
							'value'    => $commenter['comment_author_email'],
							'required' => $name_email_required,
						),
					);

					$comment_form['fields'] = array();

					foreach ( $fields as $key => $field ) {
						$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';
						
						$field_html .= '<input class="form-control" id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" placeholder="' . esc_html( $field['label'] ).'" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

						$comment_form['fields'][ $key ] = $field_html;
					}

					$account_page_url = wc_get_page_permalink( 'myaccount' );
					if ( $account_page_url ) {
						/* translators: %s opening and closing link tags respectively */
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_attr__( 'You must be %1$slogged in%2$s to post a review.', 'dronza' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
					}

					if ( wc_review_ratings_enabled() ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'dronza' ) . '</label><select name="rating" id="rating" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'dronza' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'dronza' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'dronza' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'dronza' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'dronza' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'dronza' ) . '</option>
						</select></div>';
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" class="form-control" required placeholder="' . esc_attr__( 'Your review', 'dronza' ) . '"></textarea></p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					?>
				</div>
			</div>
		<?php else : ?>
			<p class="woocommerce-verification-required"><?php echo esc_html__( 'Only logged in customers who have purchased this product may leave a review.', 'dronza' ); ?></p>
		<?php endif; ?>

		<div class="clear"></div>
	</div>
</div>
