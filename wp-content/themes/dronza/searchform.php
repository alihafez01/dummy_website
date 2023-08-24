<?php
/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label if
 * one was passed to get_search_form() in the args array.
 */
$unique_id = dronza_unique_id( 'search-form-' );

$aria_label = ! empty( $args['label'] ) ? 'aria-label="' . esc_attr( $args['label'] ) . '"' : '';
?>
<form role="search" <?php echo esc_attr($aria_label); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped above. ?> method="get" class="search-form radius-xl" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field form-control" placeholder="<?php echo esc_attr__( 'Type to search', 'dronza' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<span class="input-group-append">
			<input type="submit" class="search-submit search-btn" /><i class="fa fa-search"></i>
		</span>
	</div> 
</form>
