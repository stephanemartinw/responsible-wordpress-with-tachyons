<?php

  //Inline styles
  $base_url = get_bloginfo('url');
  if (isset($atts['background']))
    $style="background:url('".$base_url . $atts['background']. "')  no-repeat center ; background-size:cover";

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierarchy = $firstheadinghierarchy+1;

  //Default skin
  global $partial_args;
?>

<div class="db-element-unique <?php echo $partial_args['classes']['wrapper'];?>" style="<?php echo $style;?>">
    <?php if ($partial_args['options']['show']['title']) wistiti_post_title($partial_args, $firstheadinghierarchy, false);?>
    <?php if ($partial_args['options']['show']['excerpt']) wistiti_post_excerpt($partial_args, $secondheadinghierarchy);?>
    <?php if ($partial_args['options']['show']['content']) wistiti_post_content($partial_args, $secondheadinghierarchy);?>
    <?php if ($partial_args['options']['show']['action']) wistiti_post_action($partial_args);?>
    <?php if ($partial_args['options']['show']['source']) wistiti_post_source(__('Source:', "wistiti"), $partial_args);?>
    <?php if ($partial_args['options']['show']['taxonomy']) wistiti_post_taxonomies('element', 'element-type', $partial_args); ?>
    <?php if ($partial_args['options']['show']['tag']) wistiti_post_taxonomies('element', 'element-tag', $partial_args); ?>
    <?php if ($partial_args['options']['show']['social']) wistiti_post_social(__('Follow on:', "wistiti"), $partial_args);?>
    <?php wistiti_post_comments_link($partial_args['classes']);?>
</div>
