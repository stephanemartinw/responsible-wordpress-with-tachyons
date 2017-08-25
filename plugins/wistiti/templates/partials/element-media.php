<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Customize
  global $partial_args;

  //Alternate media or card thumb position ?
  $mode = $partial_args['options']['mode'];
  if (($atts['index'] % 2 !== 0) && ($atts['alternate']===true)) {
    if ($mode=='normal') $mode="inverted"; else $mode="normal";
  }

?>

<div class="db-element-media <?php echo $partial_args['classes']['wrapper'];?>">

  <?php if ($mode=="normal"): ?>
    <div class="<?php echo $partial_args['classes']['media_image'];?>">
      <?php wistiti_post_thumbnail($partial_args);?>
    </div>
  <?php endif;?>

  <div class="<?php echo $partial_args['classes']['media_body'];?>">
    <?php if ($partial_args['options']['show']['title']) wistiti_post_title($partial_args, $firstheadinghierarchy, $partial_args['options']['has_link']);?>

    <?php if ($partial_args['options']['show']['excerpt']) wistiti_post_excerpt($partial_args, $secondheadinghierarchy);?>
    <?php if ($partial_args['options']['show']['content']) wistiti_post_content($partial_args, $secondheadinghierarchy);?>
    <?php if ($partial_args['options']['show']['action']) wistiti_post_action($partial_args);?>

    <?php if ($partial_args['options']['show']['source']) wistiti_post_source(__('Source:', "wistiti"), $partial_args);?>
    <?php if ($partial_args['options']['show']['taxonomy']) wistiti_post_taxonomies('element', 'element-type', $partial_args); ?>
    <?php if ($partial_args['options']['show']['tag']) wistiti_post_taxonomies('element', 'element-tag', $partial_args); ?>
    <?php if ($partial_args['options']['show']['social']) wistiti_post_social(__('Follow on:', "wistiti"), $partial_args);?>
  </div>

  <?php if ($mode=="inverted"): ?>
    <div class="<?php echo $partial_args['classes']['media_image'];?>">
      <?php the_post_thumbnail( 'medium_large', ['class' => $partial_args['classes']['thumbnail']]); ?>
    </div>
  <?php endif;?>

</div>
