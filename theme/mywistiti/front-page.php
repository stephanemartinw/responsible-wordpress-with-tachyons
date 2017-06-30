<?php  /* Template Name: Front Page */
/**
 * The template for displaying the front page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wistiti
 */

get_header(); ?>

	<div id="primary">
		<main id="main" class="relative" role="main">

			<?php get_template_part( 'components/page/content', 'front' );?>

			<section class="mw8 center">
				<?php	// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template('/includes/comments.php');
				endif;?>
			</section>


		</main>
	</div>

<?php
get_sidebar();
get_footer();
