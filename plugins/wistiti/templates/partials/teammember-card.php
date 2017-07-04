<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Default skin
  //Do not add tachyons classes here ! User appropriate customizer !
  global $partial_args;
  wistiti_get_template('/partials/customizers/teammember-card-customizer.php', $atts);
?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">
  <?php the_post_thumbnail( 'medium_large', ['class' => $partial_args['classes']['thumbnail']]); ?>
  <h<?php echo $firstheadinghierarchy;?>><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <h<?php echo $secondheadinghierarchy;?>><?php echo get_post_meta( get_the_ID(), '_teammember_function', true );?></h<?php echo $secondheadinghierarchy;?>>
  <?php the_content();?>
</div>
