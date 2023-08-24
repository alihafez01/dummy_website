<?php
/**
 * Displays the menus and widgets at the end of the main element.
 * Visually, this output is presented as part of the footer element.
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

if( is_active_sidebar( 'sidebar-footer' )) { ?>
	<!-- FOOTER BLOCKES START -->  
	<div class="footer-top">
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar('Footer'); ?>                              	
			</div>
		</div>
	</div>
	<?php
}