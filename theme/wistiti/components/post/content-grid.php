<?php
/**
 * Template part for displaying posts as a grid.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wistiti
 */
  global $content_args;
  get_template_part( 'components/post/customizers/content-grid', 'customizer' );

  global $post_args;
  get_template_part( 'components/post/partials/customizers/post-'.$content_args['display'], 'customizer' );

?>

<div class="cf">

  <?php $width = floor(100 / $content_args['cols']); while ( have_posts() ) : the_post();?>

      <div class="fl w-<?php echo $width;?> ph3">

        <?php /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part( 'components/post/partials/post', $content_args['display']);?>

     </div>

  <?php endwhile;

  unset($content_args);
  unset($post_args);
  ?>

</div>
