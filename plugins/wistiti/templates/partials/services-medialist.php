<?php
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
    <h3 class="f2 f1-l lh-title"><?php the_title();?></h3>
    <?php echo $thecontent;?>
    <p class="custom-green fw6"><?php echo $theexcerpt;?></p>
  </div>

  <?php if ($index % 2 !== 0): ?>
    <div class="fl w-100 w-50-ns tc pa2">
      <?php the_post_thumbnail( 'medium_large', ['class' => 'w-100 h-auto']); ?>
    </div>
  <?php endif;?>

</div>
