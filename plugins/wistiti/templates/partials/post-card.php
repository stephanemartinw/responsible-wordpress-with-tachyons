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
	global $partial_args;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($partial_args['classes']['wrapper']); ?>>

	<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<a class="link" href="<?php the_permalink(); ?>">
				 <figure class="<?php echo $partial_args['classes']['thumbnail_wrapper'];?>"><?php the_post_thumbnail( 'medium_large', ['alt' => '', 'class' =>  $partial_args['classes']['thumbnail']]); ?></figure>
			</a>
	<?php endif; ?>

  <header class="entry-header">

    <?php if ( 'post' === get_post_type() ) :
			wistiti_posted_on($partial_args['classes']['posted-on']);
    endif; ?>

    <?php
      if ( is_single() ) {
        the_title( '<h'.$partial_args['attributes']['firstheadinghierarchy_single'].' class="'.$partial_args['classes']['title_single'].'">', '</h'.$partial_args['attributes']['firstheadinghierarchy_single'].'>' );
      } else {
        the_title( '<h'.$partial_args['attributes']['firstheadinghierarchy']. ' class="'.$partial_args['classes']['title'].'"><a class="'.$partial_args['classes']['title_link'].'" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h'.$partial_args['attributes']['firstheadinghierarchy'].'>' );
      }?>

  </header>

	<div class="entry-content">
		<?php
		  //Note: the read more link text is overriden in functions.php
			the_excerpt();

			/*wp_link_pages( array(
				'before' => '<div>' . esc_html__( 'Pages:', 'wistiti' ),
				'after'  => '</div>',
			) );*/
		?>
	</div>

	<footer class="entry-footer">
		<?php wistiti_entry_footer($partial_args['classes']['footer']); ?>
	</footer>

</article><!-- #post-## -->
