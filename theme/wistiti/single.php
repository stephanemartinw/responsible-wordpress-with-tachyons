<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wistiti
 */

 global $wistiti_args;
 //get_template_part( 'wistiti', 'customizer' );
 wistiti_get_theme_customizer('wistiti');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" role="main">

		<?php
		if ( have_posts() ) :

			//get_template_part( 'components/post/content', get_post_format() );
			//Use Wistiti plugin for layout!

      //Get the post
      $post_type = get_post_type();
      $post_id = get_the_ID();

      //Get the type (for Elements)
      $type_value = '';
      $types = wp_get_post_terms( $post_id,  'element-type');
      if (!empty($types)) $type_value=$types[0]->slug;

      //Get the post taxonomy & term
      //$key = wistiti_get_template_post_key('single', $post_type, $post_id);
      //$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
      //var_dump($term);

      //Run shortcode
      $options = wistiti_get_template_options('single', $post_type);
      echo do_shortcode('[wistiti layout="'.$options['layout'].'" display="'.$options['display'].'" tax_key="type" tax_value="'.$type_value.'" mode="view" pagination=true]');

			//Deported to plugin/elememnts
			//echo wistiti_post_navigation($wistiti_args);

			//Deported to plugin/element ???
			// If comments are open or we have at least one comment, load up the comment template.
			/*if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;*/

		endif;
		?>

		</main>
	</div>
<?php
get_sidebar();
get_footer();
