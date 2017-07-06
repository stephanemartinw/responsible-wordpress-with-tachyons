<?php //Services
    $list_query = $atts['query'];

    //Default skin
    //Do not add tachyons classes here ! User appropriate customizer !
    global $template_args;
    if (!wistiti_get_template('/customizers/'.$atts['type'].'-list-customizer.php', $atts))
      wistiti_get_template('/customizers/list-customizer.php', $atts)
?>

<div class="<?php echo $template_args['classes']['wrapper'];?>" role="<?php echo $template_args['classes']['role'];?>">

  <?php $index=0; if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();

      //Set atts for template
      $atts['index']=$index;

      if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['display'].'.php', $atts))
        wistiti_get_template('/partials/'.$atts['type'].'-media.php', $atts);

  $index++; endwhile; endif;

  wp_reset_query(); ?>

</div>
