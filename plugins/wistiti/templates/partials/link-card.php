<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();

  $label = get_post_meta( get_the_ID(), '_link_label', true );
  $url = get_post_meta( get_the_ID(), '_link_url', true );
  $source = get_post_meta( get_the_ID(), '_link_source', true );
  $sourceurl = get_post_meta( get_the_ID(), '_link_sourceurl', true );

  //Default skin
  //Do not add tachyons classes here ! User appropriate customizer !
  global $partial_args;
  wistiti_get_template('/partials/customizers/link-card-customizer.php', $atts);
 ?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">
  <figure class="<?php echo $partial_args['classes']['thumbnail_wrapper'];?>"><?php if (has_post_thumbnail()) : the_post_thumbnail( 'medium_large', [ 'alt' => '', 'class' =>  $partial_args['classes']['thumbnail']]);endif; ?></figure>
  <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <h<?php echo $secondheadinghierarchy;?> class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>>
  <?php echo $thecontent;?>
  <span class="<?php echo $partial_args['classes']['label'];?>"><a class="<?php echo $partial_args['classes']['label_link'];?>" href="<?php echo $url;?>"><?php echo $label;?></a></span>
  <span><?php _e('Source:', "wistiti");?></span>
  <span class="<?php echo $partial_args['classes']['source'];?>"><a class="<?php echo $partial_args['classes']['source_link'];?>" href="<?php echo $sourceurl;?>"><?php echo $source;?></a></span>
</div>
