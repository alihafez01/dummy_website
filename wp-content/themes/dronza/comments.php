<?php
/**
 * The template file for displaying the comments and comment form for the
 * Dronza theme.
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if ( post_password_required() ) {
	return;
}
if ( $comments || comments_open() || pings_open()){
	?>
	<div class="clear" id="comment-list">
		<div class="comments-area" id="comments">
			<?php
			if ( $comments ) {
				
					$comments_number = absint( get_comments_number() );
					?>
					<div class="gridvalley-post-comments">
						<h2 class="comments-title m-t0">
							<?php
							if ( ! have_comments() ) {
								echo esc_html__( 'Leave a comment', 'dronza' );
							} else if ( '1' == $comments_number ) {
								/* translators: %s: post title */
								echo esc_html__( 'One Comment', 'dronza' );
							} else {
								echo esc_attr($comments_number) . esc_html__( ' Comments', 'dronza' );
							} ?>
						</h2><!-- .comments-title -->

						<ol class="comment-list">

							<?php
							wp_list_comments(
								array(
									'walker'      => new dronza_Walker_Comment(),
									'avatar_size' => 120,
									'style'       => 'li',
								)
							);

							$comment_pagination = paginate_comments_links(
								array(
									'echo'      => false,
									'end_size'  => 0,
									'mid_size'  => 0,
									'next_text' => esc_html__( 'Newer Comments', 'dronza' ) . ' <span aria-hidden="true">&rarr;</span>',
									'prev_text' => '<span aria-hidden="true">&larr;</span> ' . esc_html__( 'Older Comments', 'dronza' ),
								)
							);

							if ( $comment_pagination ) {
								$pagination_classes = '';

								// If we're only showing the "Next" link, add a class indicating so.
								if ( false === strpos( $comment_pagination, 'prev page-numbers' ) ) {
									$pagination_classes = ' only-next';
								}
								?>

								<nav class="comments-pagination pagination<?php echo esc_attr($pagination_classes); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output ?>" aria-label="<?php echo esc_attr__( 'Comments', 'dronza' ); ?>">
									<?php echo wp_kses_post( $comment_pagination ); ?>
								</nav>

								<?php
							}
							?>

						</ol><!-- .comments-inner -->
					</div><!-- .comments-inner -->
				<?php
			}

			if ( comments_open() || pings_open() ) {

				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ($req ? " aria-required='true'" : '');
				
				$args = array(
					'id_form'				=> 'commentform',
					'id_submit'  			=> 'submit',
					'title_reply'			=> 'Leave a Comment',
					'title_reply_before'	=> '<h2 class="comments-title m-t0">',
					'title_reply_after'		=> '</h2>',
					'class_form' 			=> 'comment-form row',
					'submit_field'			=> '<p class="form-submit">%1$s %2$s</p>',
					'title_reply_to'    	=> esc_html__('Leave a Reply to %s', 'dronza'),
					'cancel_reply_link' 	=> esc_html__('Cancel Reply', 'dronza'),
					'label_submit'      	=> esc_html__('Submit', 'dronza'),
					'class_submit'        => 'site-button site-btn-effect',
					'logged_in_as'			=>	'<p class="logged-in-as">' . sprintf( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' , admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
					'comment_notes_before' 	=> '',
					'comment_notes_after' 	=> '',

					'fields' => apply_filters('comment_form_default_fields', array(
						'author' =>
							'<div class="form-group col-md-4"><input id="author" class="form-control" placeholder="' . esc_attr__('Full Name', 'dronza') . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
							'" /></div>',
						'email' => 
							'<div class="form-group col-md-4"><input id="email" class="form-control" placeholder="' . esc_attr__('Email', 'dronza') . '" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
							'"/></div>',
						'url' =>
							'<div class="form-group col-md-4"><input id="url" class="form-control"  placeholder="' . esc_attr__('Website', 'dronza') . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
							'" /></div>',
					)),
					'comment_field' =>  '<div class="form-group col-md-12">' .
						'<textarea id="comment" class="form-control" placeholder="' . esc_attr__('Your comment', 'dronza') . '" name="comment">' .
						'</textarea></div>'
					
				);
				comment_form($args,$post->ID);
			} ?>
		</div>	
	</div>	
	<?php
}