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

global $wistiti_args;
//get_template_part( 'wistiti', 'customizer' );
wistiti_get_theme_customizer('wistiti');

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

			//Get the post
			$post_type = get_post_type();
			$post_id = get_the_ID();
			//Get the post taxonomy terms
			$key = ''; //wistiti_get_template_post_key('index', $post_type, $post_id);

			//Run shortcode
			$options = wistiti_get_template_options('index', $post_type, $key);
			echo do_shortcode('[wistiti type="'.$post_type.'" layout="'.$options['layout'].'" display="'.$options['display'].'" mode="view" orderby="post_date" order="ASC" pagination=true]');

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

		</main>
	</div>
<?php
get_sidebar();
get_footer();
