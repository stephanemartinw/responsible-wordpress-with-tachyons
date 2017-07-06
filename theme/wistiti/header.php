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

global $wistiti_args;
get_template_part( 'wistiti', 'customizer' );

 ?><!DOCTYPE html>
 <html class="<?php echo $wistiti_args['classes']['progressive'];?> <?php echo $wistiti_args['classes']['html'];?>" <?php language_attributes(); ?>>
 <head>
	 <meta charset="<?php bloginfo( 'charset' ); ?>">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="profile" href="http://gmpg.org/xfn/11">
	 <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	 <?php wp_head(); ?>
 </head>

<body <?php body_class(); ?>>
	<div id="page">

	  <?php get_template_part( 'components/header/site', 'header' ); ?>

		<div id="content" class="site-content">
