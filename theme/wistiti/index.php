<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wistiti
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="clip f1 screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif;

			//Layout
			//To do : add theme options !
			//For now, override index template.
			//$layout = "grid";
			//get_template_part( 'components/post/content', $layout );

			//Use Wistiti plugin for layout!
			echo do_shortcode('[wistiti type="post" mode="view" display="media" orderby="post_date" order="ASC"]');

			// To customize !
			//wisiti_posts_navigation();

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

		</main>
	</div>
<?php
get_sidebar();
get_footer();
