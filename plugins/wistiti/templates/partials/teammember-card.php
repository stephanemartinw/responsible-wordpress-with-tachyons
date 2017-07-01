<?php

  //Hierarchy
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

 ?>

<div class="ph4 pb4 tc">
  <?php the_post_thumbnail( 'medium_large', ['class' => 'w-'.$width_avatar.' h-auto br-100']); ?>
  <h<?php echo $firstheadinghierarchy;?>><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <h<?php echo $secondheadinghierarchy;?>><?php echo get_post_meta( get_the_ID(), '_teammember_function', true );?></h<?php echo $secondheadinghierarchy;?>>
  <?php the_content();?>
</div>
