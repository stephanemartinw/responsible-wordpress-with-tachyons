<?php

  //Hierarchy
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();

  //Default skin
  //Override this template partial in your wistiti child theme to fit your needs
  $class_media_image = "fl w-100 w-50-ns tc pa2";
  $class_thumbnail = "w-100 h-auto";

  $class_media_body = "fl w-100 w-50-ns pa2";
  $class_title = "f2 f1-l lh-title";
  $class_excerpt = "fw6";

?>

<div class="cf pv3">

  <?php if ($index % 2 == 0): ?>
    <div class="<?php echo $class_media_image;?>">
      <?php the_post_thumbnail( 'medium_large', ['class' => $class_thumbnail] ); ?>
    </div>
  <?php endif;?>

  <div class="<?php echo $class_media_body;?>">
    <h<?php echo $firstheadinghierarchy;?> class="<?php echo $class_title;?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
    <h<?php echo $secondheadinghierarchy;?> class="<?php echo $class_excerpt;?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>>
    <?php echo $thecontent;?>
  </div>

  <?php if ($index % 2 !== 0): ?>
    <div class="<?php echo $class_media_image;?>">
      <?php the_post_thumbnail( 'medium_large', ['class' => $class_thumbnail]); ?>
    </div>
  <?php endif;?>

</div>
