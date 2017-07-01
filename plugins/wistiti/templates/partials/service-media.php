<?php

  //Hierarchy
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();
?>

<div class="cf pv3">

  <?php if ($index % 2 == 0): ?>
    <div class="fl w-100 w-50-ns tc pa2">
      <?php the_post_thumbnail( 'medium_large', ['class' => 'w-100 h-auto'] ); ?>
    </div>
  <?php endif;?>

  <div class="fl w-100 w-50-ns pa2">
    <h<?php echo $firstheadinghierarchy;?> class="f2 f1-l lh-title"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
    <h<?php echo $secondheadinghierarchy;?> class="fw6"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>>
    <?php echo $thecontent;?>
  </div>

  <?php if ($index % 2 !== 0): ?>
    <div class="fl w-100 w-50-ns tc pa2">
      <?php the_post_thumbnail( 'medium_large', ['class' => 'w-100 h-auto']); ?>
    </div>
  <?php endif;?>

</div>
