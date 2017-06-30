<?php
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = get_the_content();
  $metaaction = get_post_meta( get_the_ID(), '_jumbotron_action_url', true );
  if (isset($atts['style'])) $style=$atts['style'];
?>

<div style="<?php echo $style;?>">

    <h1 class="f2 f1-m f-subheadline-ns ma0"><?php echo get_the_title();?></h1>

    <?php if (!empty($theexcerpt)):?><h2 class="f1"><?php echo $theexcerpt;?></h2><?php endif; ?>

    <?php if (!empty($thecontent) || !empty($metaaction)):?><hr><?php endif;?>
    <?php if (!empty($thecontent)):?><div class="f2"><?php echo $thecontent;?></div><?php endif;?>
    <?php if (!empty($metaaction)):?><a class="dib bg-<?php echo get_theme_mod( 'smew_colors_brand', 'blue' ); ?> white pa2 mv3 link" href="<?php echo get_post_meta( get_the_ID(), '_jumbotron_action_url', true );?>" target="_blank"><?php echo get_post_meta( get_the_ID(), '_jumbotron_action_label', true );?></a><?php endif;?>

</div>
