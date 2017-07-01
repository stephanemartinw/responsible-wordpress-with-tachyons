<?php

  //Inline styles
  $base_url = get_bloginfo('url');
  if (isset($atts['background']))
    $style="background:url('".$base_url . $atts['background']. "')  no-repeat center ; background-size:cover";

  //Hierarchy
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();
  $theaction = get_post_meta( get_the_ID(), '_jumbotron_action_url', true );

  //Default skin
  //Override this template partial in your wistiti child theme to fit your needs
  $class_title = "f2 f1-m f-subheadline-ns ma0";
  $class_excerpt = "f3 f2-m f1-ns";
  $class_content = "f4 f3-m f2-ns";
  $class_hr='';
  $class_action = "dib bg-".get_theme_mod( 'smew_colors_brand', 'blue' )." white pa3 mv3 link";

  //Extend or override here the default skin, according to $id if necessary
  /*switch ($atts['id']) {
    case '<id>':
      $class_title = / += ...
    break;

    default:
    break;
  }*/
?>

<div style="<?php echo $style;?>">

    <h<?php echo $firstheadinghierarchy;?> class="<?php echo $class_title;?>"><?php echo get_the_title();?></h<?php echo $firstheadinghierarchy;?>>

    <?php if (!empty($theexcerpt)):?><h<?php echo $secondheadinghierachy;?> class="<?php echo $class_excerpt;?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierachy ?>><?php endif; ?>

    <?php if (!empty($thecontent)):?><hr class="<?php echo $class_hr;?>"><?php endif;?>
    <?php if (!empty($thecontent)):?><div class="<?php echo $class_content;?>"><?php echo $thecontent;?></div><?php endif;?>
    <?php if (!empty($theaction)):?><a class="<?php echo $class_action;?>" href="<?php echo get_post_meta( get_the_ID(), '_jumbotron_action_url', true );?>" target="_blank"><?php echo get_post_meta( get_the_ID(), '_jumbotron_action_label', true );?></a><?php endif;?>

</div>
