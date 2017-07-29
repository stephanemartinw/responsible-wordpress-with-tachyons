<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Customize
  global $partial_args;
 ?>

<div class="db-element-card <?php echo $partial_args['classes']['wrapper'];?>">
  <?php wistiti_post_thumbnail($partial_args);?>

  <?php if ($partial_args['options']['show']['title']) wistiti_post_title($partial_args, $firstheadinghierarchy);?>

  <?php if ($partial_args['options']['show']['excerpt']) wistiti_post_excerpt($partial_args, $secondheadinghierarchy);?>
  <?php if ($partial_args['options']['show']['content']) wistiti_post_content($partial_args, $secondheadinghierarchy);?>
  <?php if ($partial_args['options']['show']['action']) wistiti_post_action($partial_args);?>

  <?php if ($partial_args['options']['show']['source']) wistiti_post_source(__('Source:', "wistiti"), $partial_args);?>
  <?php if ($partial_args['options']['show']['taxonomy']) wistiti_post_taxonomies('element', 'element-type', $partial_args); ?>
  <?php if ($partial_args['options']['show']['tag']) wistiti_post_taxonomies('element', 'element-tag', $partial_args); ?>
  <?php if ($partial_args['options']['show']['social'])  wistiti_post_social(__('Follow on:', "wistiti"), $partial_args);?>
</div>
