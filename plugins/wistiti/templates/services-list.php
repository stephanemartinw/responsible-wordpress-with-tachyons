<?php //Services
    $services_query = $atts['query'];
?>

<?php $index=0; if ( $services_query->have_posts() ) : while ( $services_query->have_posts() ) : $services_query->the_post();

    //Set atts for template
    $atts['index']=$index;
  
    if (!wistiti_get_template('/partials/service-'.$atts['display'].'.php', $atts))
      wistiti_get_template('/partials/service-media.php', $atts);

$index++; endwhile; endif;

wp_reset_query(); ?>
