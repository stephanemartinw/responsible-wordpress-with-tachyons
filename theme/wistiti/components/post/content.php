<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wistiti
 */

 global $content_args;
 get_template_part( 'components/post/customizers/content', 'customizer' );

 global $post_args;
 get_template_part( 'components/post/partials/customizers/post-'.$content_args['display'], 'customizer' );

/*
   * Include the Post-Format-specific template for the content.
   * If you want to override this in a child theme, then include a file
   * called content-___.php (where ___ is the Post Format name) and that will be used instead.
   */

 	get_template_part( 'components/post/partials/post', $content_args['display'] );

  unset($content_args);
  unset($post_args);

  ?>
