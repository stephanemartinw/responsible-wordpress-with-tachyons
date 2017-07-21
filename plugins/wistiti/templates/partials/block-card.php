<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = wpautop(get_the_content());

  //Customize
  global $partial_args;
 ?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">
  <?php if (has_post_thumbnail()) : ?>
    <a class="link" href="<?php the_permalink(); ?>">
      <figure class="<?php echo $partial_args['classes']['thumbnail_wrapper'];?>"><?php the_post_thumbnail( 'medium_large', ['alt' => '', 'class' =>  $partial_args['classes']['thumbnail']]); ?></figure>
    </a>
  <?php endif; ?>
  <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><a class="link" href="<?php the_permalink(); ?>"><?php the_title();?></a></h<?php echo $firstheadinghierarchy;?>>
  <?php if (!empty($theexcerpt)):?><h<?php echo $secondheadinghierarchy;?> class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>><?php endif;?>
  <?php if (!empty($thecontent)):?><div class="<?php echo $partial_args['classes']['content'];?>"><p><?php echo $thecontent;?></p></div><?php endif;?>
</div>
