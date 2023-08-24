<?php
/**
 * Header file for the Dronza WordPress default theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Dronza
 * @since 1.0.0
 */

?><!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
		<div class="page-wraper">
			<?php
			wp_body_open();
			get_template_part( 'template-parts/entry-header'); ?>
				<div class="page-content">
					<?php
					get_template_part( 'template-parts/sub-header');
					