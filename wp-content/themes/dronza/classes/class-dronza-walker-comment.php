<?php
/**
 * Custom comment walker for this theme.
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

if ( ! class_exists( 'dronza_Walker_Comment' ) ) {
	/**
	 * CUSTOM COMMENT WALKER
	 * A custom walker for comments, based on the walker in Twenty Nineteen.
	 */
	class dronza_Walker_Comment extends Walker_Comment {

		/**
		 * Outputs a comment in the HTML5 format.
		 *
		 * @see wp_list_comments()
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author_url/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_author/
		 * @see https://developer.wordpress.org/reference/functions/get_avatar/
		 * @see https://developer.wordpress.org/reference/functions/get_comment_reply_link/
		 * @see https://developer.wordpress.org/reference/functions/get_edit_comment_link/
		 *
		 * @param WP_Comment $comment Comment to display.
		 * @param int        $depth   Depth of the current comment.
		 * @param array      $args    An array of arguments.
		 */
		protected function html5_comment( $comment, $depth, $args ) {
			global $dronza_allowed_html;
			$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';

			?>
			<<?php echo esc_attr($tag); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
				<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
					
					<div class="comment-author vcard">
						<?php
						$comment_author_url = get_comment_author_url( $comment );
						$comment_author     = get_comment_author( $comment );
						$avatar             = get_avatar( $comment, $args['avatar_size'] );
						if ( 0 !== $args['avatar_size'] ) {
							if ( empty( $comment_author_url ) ) {
								echo wp_kses_post( $avatar );
							} else {
								printf( '<a href="%s" rel="external nofollow" class="url">', $comment_author_url ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped --Escaped in https://developer.wordpress.org/reference/functions/get_comment_author_url/
								echo wp_kses_post( $avatar );
							}
						}

						if ( ! empty( $comment_author_url ) ) {
							echo '</a>';
						}
						?>
					</div><!-- .comment-author -->
					
					<div class="comment-meta-n-description">
						<?php
						printf(
							'<h4 class="media-heading">%1$s</h4><span class="screen-reader-text says">%2$s</span>',
							esc_html( $comment_author ),
							__( 'says:', 'dronza' )
						);
						?>
						<div class="dronza-comment-meta">
							<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
								<?php
								/* Translators: 1 = comment date, 2 = comment time */
								$comment_timestamp = sprintf( esc_attr__( '%1$s at %2$s', 'dronza' ), get_comment_date( '', $comment ), get_comment_time() );
								?>
								<time datetime="<?php comment_time( 'c' ); ?>" title="<?php echo esc_attr( $comment_timestamp ); ?>">
									<?php echo esc_html( $comment_timestamp ); ?>
								</time>
							</a>
							<?php
							if ( get_edit_comment_link() ) {
								echo ' <span aria-hidden="true">&bull;</span> <a class="comment-edit-link" href="' . esc_url( get_edit_comment_link() ) . '">' . esc_html__( 'Edit', 'dronza' ) . '</a>';
							}
							?>
						</div>
						<div class="comment-content entry-content">
							<?php
							comment_text();

							if ( '0' === $comment->comment_approved ) {
								?>
								<p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'dronza' ); ?></p>
								<?php
							}
							?>
						</div><!-- .comment-content -->
						<?php

						$comment_reply_link = get_comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<div class="reply">',
									'after'     => '</div>',
								)
							)
						);

						$by_post_author = dronza_is_comment_by_post_author( $comment );

						if ( $comment_reply_link || $by_post_author ) {
							?>
							<?php
							if ( $comment_reply_link ) {
								echo wp_kses($comment_reply_link,$dronza_allowed_html); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped --Link is escaped in https://developer.wordpress.org/reference/functions/get_comment_reply_link/
							}
							if ( $by_post_author ) {
								echo '<span class="by-post-author">' . esc_html__( 'By Post Author', 'dronza' ) . '</span>';
							}
							?>
							<?php
						}
						?>
					</div><!-- .comment-metadata -->
					
				</div><!-- .comment-body -->

			<?php
		}
	}
}