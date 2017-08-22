<?php

  //Inline styles
  $base_url = get_bloginfo('url');
  $style='';
  if (isset($atts['background_image'])) {
    $style.="background-image:url('".$base_url . $atts['background_image']. "')  no-repeat center ; background-size:cover";
    if (isset($atts['background_fallback_color']))
      $style.="background-color:".$atts['background_fallback_color'];
  }

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Default skin
  global $partial_args;
?>

<div class="db-element-calltoaction <?php echo $partial_args['classes']['wrapper'];?>" style="<?php echo $style;?>">

    <?php wistiti_post_title($partial_args, $firstheadinghierarchy, false);?>
    <?php wistiti_post_excerpt($partial_args, $secondheadinghierarchy);?>
    <?php if (!empty(get_the_content())):?><hr class="<?php echo $partial_args['classes']['hr'];?>"><?php endif;?>
    <?php wistiti_post_content($partial_args, $secondheadinghierarchy);?>
    <?php wistiti_post_action($partial_args);?>
</div>
