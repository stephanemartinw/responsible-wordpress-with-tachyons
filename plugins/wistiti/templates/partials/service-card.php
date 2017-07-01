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

  //Default skin
  //Override this template partial in your wistiti child theme to fit your needs
  $class_thumbnail = "w-100 h-auto";
  $class_title = "f1 f2-l lh-title";
  $class_excerpt = "fw6";

 ?>

<div class="ph4 pb4 tc">
  <?php if (has_post_thumbnail()) : the_post_thumbnail( 'medium_large', ['class' => $class_thumbnail]); else :
    if (!empty($iconname)) :?>
      <!-- For now, override this template and add here : display the icon according to the font loaded by your wistiti child theme -->
      <!-- Use custom library containing only actually used icons (ie icomoon app).-->
  <?php endif; endif; ?>
  <h<?php echo $firstheadinghierarchy;?> class="<?php echo $class_title;?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <h<?php echo $secondheadinghierarchy;?> class="<?php echo $class_excerpt;?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>>
  <?php echo $thecontent;?>
</div>
