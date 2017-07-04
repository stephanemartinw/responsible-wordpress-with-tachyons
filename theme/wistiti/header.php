<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wistiti
 */

 ?><!DOCTYPE html>
 <html class="no-js f5 lh-copy sans-serif" <?php language_attributes(); ?>>
 <head>
	 <meta charset="<?php bloginfo( 'charset' ); ?>">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="profile" href="http://gmpg.org/xfn/11">
	 <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	 <?php wp_head(); ?>
 </head>

<body <?php body_class(); ?>>
	<div id="page">

		<?php if (get_theme_mod( 'smew_branding_header', true )) :?>
			<a class="clip skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'smew_theme' ); ?></a>

			<header id="masthead" class="cf cmzr-site-header" role="banner">

				<div class="relative flex items-center">
					<?php get_template_part( 'components/header/site', 'branding' ); ?>

					<?php get_template_part( 'components/navigation/navigation', 'top' ); ?>
				</div>

			</header>
	<?php endif;?>

		<div id="content" class="site-content">
