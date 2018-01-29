<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wistiti
 */

 //Attributes
 $firstheadinghierarchy = $atts['firstheadinghierarchy'];
 $secondheadinghierarchy = $firstheadinghierarchy+1;

	//Customize
	//Do not use tachyons classes heren, use the appropriate customizer !
	global $partial_args;

?>

<article class="db-post-card <?php echo $partial_args['classes']['wrapper'];?>">

	<?php wistiti_post_thumbnail($partial_args);?>

  <header>
		<?php wistiti_posted_on($partial_args['classes']['posted-on']);?>
  	<?php wistiti_post_title($partial_args, $firstheadinghierarchy);?>
  </header>

	<div>
			 <?php
			 //Note: the read more link text is overriden in functions.php
			 wistiti_post_excerpt($partial_args, $secondheadinghierarchy);?>
	</div>

	<footer>
		  <?php wistiti_post_taxonomies('post', 'category', $partial_args['classes']); ?>
		  <?php wistiti_post_taxonomies('post', 'post_tag', $partial_args['classes']); ?>
	</footer>

</article>
