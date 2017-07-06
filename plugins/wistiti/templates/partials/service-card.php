<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();

  $iconname = get_post_meta( get_the_ID(), '_service_iconname', true );
  $iconsize = get_post_meta( get_the_ID(), '_service_iconsize', true );
  $iconcolor = get_post_meta( get_the_ID(), '_service_iconcolor', true );

  //Default skin
  //Do not add tachyons classes here ! User appropriate customizer !
  global $partial_args;
  wistiti_get_template('/partials/customizers/service-card-customizer.php', $atts);
 ?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">
  <?php if (has_post_thumbnail()) : ?>
    <figure class="<?php echo $partial_args['classes']['thumbnail_wrapper'];?>"><?php the_post_thumbnail( 'medium_large', ['alt' => '', 'class' =>  $partial_args['classes']['thumbnail']]); ?></figure>
    <?php else :
    if (!empty($iconname)) :
      if (empty($iconsize)) $iconsize= 5;
      if (empty($iconcolor)) $iconcolor = "black";
    ?>
      <!-- For now, override this template and add here : display the icon according to the SVGs inlined in your wistiti child theme -->
      <!-- Forx example : http://geomicons.com/. Embed only used icons.-->
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="<?php echo $iconcolor; ?> w<?php echo $iconsize;?> h<?php echo $iconsize; ?>">
        <use xlink:href="#<?php echo $iconname;?>"></use>
      </svg>
  <?php endif; endif; ?>
  <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <h<?php echo $secondheadinghierarchy;?> class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>>
  <?php echo $thecontent;?>
</div>
