<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();

  //Default skin
  //Do not add tachyons classes here ! User appropriate customizer !
  global $partial_args;
  wistiti_get_template('/partials/customizers/service-media-customizer.php', $atts);
?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">

  <?php if ($index % 2 == 0): ?>
    <div class="<?php echo $partial_args['classes']['media_image'];?>">
      <?php the_post_thumbnail( 'medium_large', ['class' => $partial_args['classes']['thumbnail']] ); ?>
    </div>
  <?php endif;?>

  <div class="<?php echo $partial_args['classes']['media_body'];?>">
    <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
    <h<?php echo $secondheadinghierarchy;?> class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>>
    <?php echo $thecontent;?>
  </div>

  <?php if ($index % 2 !== 0): ?>
    <div class="<?php echo $partial_args['classes']['media_image'];?>">
      <?php the_post_thumbnail( 'medium_large', ['class' => $partial_args['classes']['thumbnail']]); ?>
    </div>
  <?php endif;?>

</div>
