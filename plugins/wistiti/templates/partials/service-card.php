<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();

  $iconname = get_post_meta( get_the_ID(), '_service_iconname', true );

  //Customize
  global $partial_args;
 ?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">
  <?php if (has_post_thumbnail()) : ?>
    <figure class="<?php echo $partial_args['classes']['thumbnail_wrapper'];?>"><?php the_post_thumbnail( 'medium_large', ['alt' => '', 'class' =>  $partial_args['classes']['thumbnail']]); ?></figure>
    <?php else :
    if (!empty($iconname)) :
    ?>
      <!-- For now, override this template and add here : display the icon according to the SVGs inlined in your wistiti child theme -->
      <!-- Forx example : http://geomicons.com/. Embed only used icons.-->
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="<?php echo $partial_args['classes']['icon_color']; ?> w-<?php echo $partial_args['classes']['icon_size'];?>">
        <use xlink:href="#<?php echo $iconname;?>"></use>
      </svg>
  <?php endif; endif; ?>
  <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <?php if (!empty($theexcerpt)):?><h<?php echo $secondheadinghierarchy;?> class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>><?php endif;?>
  <?php if (!empty($thecontent)):?><div class="<?php echo $partial_args['classes']['content'];?>"><p><?php echo $thecontent;?></p></div><?php endif;?>
</div>
