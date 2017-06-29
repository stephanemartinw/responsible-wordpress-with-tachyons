<?php
$theexcerpt = '';
if(has_excerpt()) $theexcerpt = get_the_excerpt();
$thecontent = get_the_content();
$metaaction = get_post_meta( get_the_ID(), '_jumbotron_action_url', true );
if (isset($atts['style'])) $style=$atts['style'];
?>

<div class="pv4" style="<?php echo $style;?>">
    <h1 class="f2"><?php echo get_the_title();?></h1>

    <?php if (!empty($theexcerpt)):?><h2 class="f4 fw2 dark-gray"><?php echo get_the_excerpt();?></h2><?php endif; ?>

    <?php if (!empty($thecontent) || !empty($metaaction)):?><hr><?php endif;?>
    <?php if (!empty($thecontent)):?><div class="mv3"><?php echo get_the_content();?></div><?php endif;?>
    <?php if (!empty($metaaction)):?><a href="<?php echo get_post_meta( get_the_ID(), '_jumbotron_action_url', true );?>" target="_blank"><?php echo get_post_meta( get_the_ID(), '_jumbotron_action_label', true );?></a><?php endif;?>

    <div class="mt5"><?php echo do_shortcode('[wistiti_contact_form]'); ?></div>
</div>
