<?php

  //Inline styles
  $base_url = get_bloginfo('url');
  if (isset($atts['background']))
    $style="background:url('".$base_url . $atts['background']. "')  no-repeat center ; background-size:cover";

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Default skin
  global $partial_args;
?>

<div class="db-post-default <?php echo $partial_args['classes']['wrapper'];?>" style="<?php echo $style;?>">
    <?php wistiti_post_title($partial_args, $firstheadinghierarchy, false);?>
    <?php wistiti_post_excerpt($partial_args, $secondheadinghierarchy);?>
    <?php wistiti_post_content($partial_args, $secondheadinghierarchy);?>
    <?php wistiti_post_comments_link($partial_args['classes']);?>
</div>
