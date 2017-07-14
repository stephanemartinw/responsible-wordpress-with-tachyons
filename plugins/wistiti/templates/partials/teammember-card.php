<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $thecontent = wpautop(get_the_content());

  //Default skin
  //Do not add tachyons classes here ! User appropriate customizer !
  global $partial_args;
?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">
  <?php the_post_thumbnail( 'medium_large', ['class' => $partial_args['classes']['thumbnail']]); ?>
  <h<?php echo $firstheadinghierarchy;?>><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <h<?php echo $secondheadinghierarchy;?>><?php echo get_post_meta( get_the_ID(), '_teammember_function', true );?></h<?php echo $secondheadinghierarchy;?>>
  <?php if (!empty($thecontent)):?><p><?php echo $thecontent;?></p><?php endif;?>
</div>
