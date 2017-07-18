<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = wpautop(get_the_content());

  //Customize
  //Do not add tachyons classes here ! User appropriate customizer !
  global $partial_args;
  if (isset($partial_args['options']['mode']) && (!empty($partial_args['options']['mode'])))
    $mode = $partial_args['options']['mode'];
  else $mode='normal';
?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">

  <?php if ($mode=="normal"): ?>
    <div class="<?php echo $partial_args['classes']['media_image'];?>">
      <?php the_post_thumbnail( 'medium_large', ['alt' => '', 'class' => $partial_args['classes']['thumbnail']] ); ?>
    </div>
  <?php endif;?>

  <div class="<?php echo $partial_args['classes']['media_body'];?>">
    <?php if ( 'post' === get_post_type() ) :
      wistiti_posted_on($partial_args['classes']['posted-on']);
    endif; ?>
    <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>">
      <a class="<?php echo $partial_args['classes']['title_link'];?>" href="<?php echo esc_url( get_permalink() );?>" rel="bookmark"><?php the_title();?></a>
    </h<?php echo $firstheadinghierarchy;?>>
    <h<?php echo $secondheadinghierarchy;?> class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>>
    <p class="<?php echo $partial_args['classes']['content'];?>"><?php echo $thecontent;?></p>
    <?php wistiti_entry_footer($partial_args['classes']['footer']); ?>
  </div>

<?php if ($mode=="inverted"): ?>
    <div class="<?php echo $partial_args['classes']['media_image'];?>">
      <?php the_post_thumbnail( 'medium_large', ['class' => $partial_args['classes']['thumbnail']]); ?>
    </div>
  <?php endif;?>

</div>
