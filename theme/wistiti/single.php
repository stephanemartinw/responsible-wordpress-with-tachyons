<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Wistiti
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			//get_template_part( 'components/post/content', get_post_format() );
			//Use Wistiti plugin for layout!
			echo do_shortcode('[wistiti type="post" layout="element" id="'.get_the_ID().'"]');

			//To do : override with tachyons ! Disabled for now....
			//wistiti_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main>
	</div>
<?php
get_sidebar();
get_footer();
