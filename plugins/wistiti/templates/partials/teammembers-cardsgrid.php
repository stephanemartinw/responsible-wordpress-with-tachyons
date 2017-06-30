<?php
  if (isset($atts['col']) && $atts['col']!=0) {
    $width = 100 / $atts['col'];
    if ($atts['col']==1) $width_avatar = 25;
    else $width_avatar=50;
  }
  else {
    $width=33; //default
    $width_avatar=50;
  }
 ?>

<div class="fl w-<?php echo $width; ?> ph4 pb4 tc">
  <?php the_post_thumbnail( 'medium_large', ['class' => 'w-'.$width_avatar.' h-auto br-100']); ?>
  <h4><?php the_title();?></h4>
  <h5><?php echo get_post_meta( get_the_ID(), '_teammember_function', true );?></h5>
  <?php the_content();?>
</div>
