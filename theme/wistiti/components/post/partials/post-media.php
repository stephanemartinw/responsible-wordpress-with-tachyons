<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wistiti
 */

	//Customize
	//Do not use tachyons classes heren, use the appropriate customizer !
  global $post_args;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_args['classes']['wrapper']); ?>>

	<header class="entry-header">

		<?php if ( 'post' === get_post_type() ) :
			wistiti_posted_on($post_args['classes']['posted-on']);
		endif; ?>

		<?php
      if ( is_single() ) {
        the_title( '<h'.$post_args['attributes']['firstheadinghierarchy_single'].' class="'.$post_args['classes']['title_single'].'">', '</h'.$post_args['attributes']['firstheadinghierarchy_single'].'>' );
      } else {
        the_title( '<h'.$post_args['attributes']['firstheadinghierarchy']. ' class="'.$post_args['classes']['title'].'"><a class="'.$post_args['classes']['title_link'].'" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h'.$post_args['attributes']['firstheadinghierarchy'].'>' );
      }?>

	</header>

	<?php if ( '' != get_the_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a class="link" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium_large', ['alt' => '', 'class' => $post_args['classes']['thumbnail']] ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		  //Note: the read more link text is overriden in functions.php
			the_content();

			wp_link_pages( array(
				'before' => '<div>' . esc_html__( 'Pages:', 'wistiti' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<footer class="entry-footer">
		<?php wistiti_entry_footer($post_args['classes']['footer']); ?>
	</footer>

</article>
