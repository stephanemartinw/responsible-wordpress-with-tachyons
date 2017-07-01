<?php

  //Hierarchy
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();

  $iconname = get_post_meta( get_the_ID(), '_service_iconname', '' );
  $iconsize = get_post_meta( get_the_ID(), '_service_iconsize', '5' );
  $iconcolor = get_post_meta( get_the_ID(), '_service_iconcolor', 'black' );

 ?>

<div class="ph4 pb4 tc">
  <?php if (has_post_thumbnail()) : the_post_thumbnail( 'medium_large', ['class' => 'w-100 h-auto']); else :
    if (!empty($iconname)) :?>
      <!-- For now, override this template and add here : display the icon according to the font loaded by your wistiti child theme -->
      <!-- Use custom library containing only actually used icons (ie icomoon app).-->
  <?php endif; endif; ?>
  <h<?php echo $firstheadinghierarchy;?> class="f1 f2-l lh-title"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <h<?php echo $secondheadinghierarchy;?> class="fw6"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>>
  <?php echo $thecontent;?>
</div>
