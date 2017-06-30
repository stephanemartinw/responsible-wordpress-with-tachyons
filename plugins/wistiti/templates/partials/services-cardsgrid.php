<?php
  $iconname = get_post_meta( get_the_ID(), '_service_iconname', '' );
  $iconsize = get_post_meta( get_the_ID(), '_service_iconsize', '5' );
  $iconcolor = get_post_meta( get_the_ID(), '_service_iconcolor', 'black' );

  if (isset($atts['col']) && $atts['col']!=0) {
    $width = 100 / $atts['col'];
  }
  else {
    $width=33; //default
  }
 ?>

<div class="fl w-<?php echo $width; ?> ph4 pb4 tc">
  <?php if (has_post_thumbnail()) : the_post_thumbnail( 'medium_large', ['class' => 'w-100 h-auto']); else :
    if (!empty($iconname)) :?>
      <!--to do : Display icon -->
  <?php endif; endif; ?>
  <h3><?php the_title();?></h3>
  <?php the_content();?>
</div>
