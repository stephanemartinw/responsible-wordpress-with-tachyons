<?php
/**
 * The template for displaying archive pages
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
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="f1">', '</h1>' );
					the_archive_description( '<div>', '</div>' );
				?>
			</header>
			<?php

			//Use Wistiti plugin for layout!
			//Get the post
			$post_type = get_post_type();
			$post_id = get_the_ID();

			//Get the post taxonomy terms
			$key = wistiti_get_template_post_key('archive', $post_type, $post_id);
			$options = wistiti_get_template_options('archive', $post_type, $key);
			echo do_shortcode('[wistiti type="'.$post_type.'" layout="'.$options['layout'].'" display="'.$options['display'].'" mode="view"]');

			/* Start the Loop */
			//while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				//get_template_part( 'components/post/content', get_post_format() );

			//endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>

		</main>
	</div>
<?php
get_sidebar();
get_footer();
