<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();

  $label = get_post_meta( get_the_ID(), '_news_label', true );
  $url = get_post_meta( get_the_ID(), '_news_url', true );
  $source = get_post_meta( get_the_ID(), '_news_source', true );
  $sourceurl = get_post_meta( get_the_ID(), '_news_sourceurl', true );

  //Customize
  //Do not add tachyons classes here ! User appropriate customizer !
  global $partial_args;
 ?>

<div class="<?php echo $partial_args['classes']['wrapper'];?>">
  <?php if (has_post_thumbnail()):?>><figure class="<?php echo $partial_args['classes']['thumbnail_wrapper'];?>"><?php the_post_thumbnail( 'medium_large', [ 'alt' => '', 'class' =>  $partial_args['classes']['thumbnail']]); ?></figure><?php endif;?>
  <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
  <?php if (!empty($theexcerpt)):?><h<?php echo $secondheadinghierarchy;?> class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></h<?php echo $secondheadinghierarchy;?>><?php endif;?>
  <?php if (!empty($thecontent)):?><div class="<?php echo $partial_args['classes']['content'];?>"><p><?php echo $thecontent;?><p></div><?php endif;?>
  <?php if (!empty($label) && !empty($url)) :?>
    <div class="<?php echo $partial_args['classes']['label'];?>"><a class="<?php echo $partial_args['classes']['label_link'];?>" href="<?php echo $url;?>"><?php echo $label;?></a></div>
  <?php endif;?>
  <?php if (!empty($source) && !empty($sourceurl)) :?>
    <div class="<?php echo $partial_args['classes']['source'];?>">
    <span><?php _e('Source:', "wistiti");?></span>
    <span><a class="<?php echo $partial_args['classes']['source_link'];?>" href="<?php echo $sourceurl;?>"><?php echo $source;?></a></span>
    </div>
  <?php endif;?>
  <?php wistiti_element_footer('news', 'news-tag', $partial_args['classes']['footer']); ?>
</div>
