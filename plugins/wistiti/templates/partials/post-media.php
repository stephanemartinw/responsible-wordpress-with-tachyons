<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Customize
  global $partial_args;
  //Alternate media or card thumb position ?
  $mode = $partial_args['options']['mode'];
  if (($atts['index'] % 2 !== 0) && ($atts['alternate'])) {
    if ($mode=='normal') $mode="inverted"; else $mode="normal";
  }
?>

<article class="db-post-media <?php echo $partial_args['classes']['wrapper'];?>">

  <?php if ($mode=="normal"): ?>
    <div class="<?php echo $partial_args['classes']['media_image'];?>">
      <?php wistiti_post_thumbnail($partial_args);?>
    </div>
  <?php endif;?>

  <div class="<?php echo $partial_args['classes']['media_body'];?>">
    <header>
      <?php wistiti_posted_on($partial_args['classes']['posted-on']);?>
      <?php wistiti_post_title($partial_args, $firstheadinghierarchy);?>
    </header>
    <?php wistiti_post_excerpt($partial_args, $secondheadinghierarchy);?>
    <?php wistiti_post_content($partial_args, $secondheadinghierarchy);?>
    <footer>
      <?php wistiti_post_taxonomies('post', 'category', $partial_args['classes']); ?>
      <?php wistiti_post_taxonomies('post', 'post_tag', $partial_args); ?>
    </footer>
  </div>

<?php if ($mode=="inverted"): ?>
    <div class="<?php echo $partial_args['classes']['media_image'];?>">
      <?php the_post_thumbnail( 'medium_large', ['class' => $partial_args['classes']['thumbnail']]); ?>
    </div>
  <?php endif;?>

</article>
