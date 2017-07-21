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
 get_customizer('wistiti');

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			//get_template_part( 'components/post/content', get_post_format() );
			//Use Wistiti plugin for layout!
			echo do_shortcode('[wistiti type="post" layout="element" id="'.get_the_ID().'"]');

			//Deported to plugin/elememnts
			//echo wistiti_post_navigation($wistiti_args);

			//Deported to plugin/element ???
			// If comments are open or we have at least one comment, load up the comment template.
			/*if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;*/

		endwhile; // End of the loop.
		?>

		</main>
	</div>
<?php
get_sidebar();
get_footer();
