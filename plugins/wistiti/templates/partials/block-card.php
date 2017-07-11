<?php

  //Inline styles
  $base_url = get_bloginfo('url');
  if (isset($atts['background']))
    $style="background:url('".$base_url . $atts['background']. "')  no-repeat center ; background-size:cover";

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();
  $theaction = get_post_meta( get_the_ID(), '_block_action_url', true );

  //Default skin
  global $partial_args;
?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>" style="<?php echo $style;?>">

    <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><?php echo get_the_title();?></h<?php echo $firstheadinghierarchy;?>>

    <?php if (!empty($theexcerpt)):?><h<?php echo $secondheadinghierachy;?> class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierachy;?>><?php endif; ?>

    <?php if (!empty($thecontent)):?><hr class="<?php echo $partial_args['classes']['hr'];?>"><?php endif;?>
    <?php if (!empty($thecontent)):?><div class="<?php echo $partial_args['classes']['content'];?>"><?php echo $thecontent;?></div><?php endif;?>
    <?php if (!empty($theaction)):?><a class="<?php echo $partial_args['classes']['action'];?>" href="<?php echo get_post_meta( get_the_ID(), '_block_action_url', true );?>" target="_blank" role="button" tabindex="0"><?php echo get_post_meta( get_the_ID(), '_jumbotron_action_label', true );?></a><?php endif;?>

</div>
