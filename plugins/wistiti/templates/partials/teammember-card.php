<?php

  //Hierarchy
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Default skin
  //Override this template partial in your wistiti child theme to fit your needs
  if (isset($atts['col']) && $atts['col']!=0) {
    if ($atts['col']==1) $width_avatar = 25;
    else $width_avatar=50;
  }
  else {
    $width_avatar=50;
  }
  $class_thumbnail = 'w-'.$width_avatar.' h-auto br-100';
 ?>

<div class="ph4 pb4 tc">
  <?php the_post_thumbnail( 'medium_large', ['class' => $class_thumbnail]); ?>
  <h<?php echo $firstheadinghierarchy;?>><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <h<?php echo $secondheadinghierarchy;?>><?php echo get_post_meta( get_the_ID(), '_teammember_function', true );?></h<?php echo $secondheadinghierarchy;?>>
  <?php the_content();?>
</div>
