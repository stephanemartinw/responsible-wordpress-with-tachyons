<?php //Element

  //Query the correct jumbotron
  $element_query = $atts['query'];

  //Default skin
  //Do not add tachyons classes here ! User appropriate customizer !
  global $template_args;
  if (!wistiti_get_template('/customizers/'.$atts['type'].'-element-customizer.php', $atts))
    wistiti_get_template('/customizers/element-customizer.php', $atts);

  global $partial_args;
  if (!wistiti_get_template('/partials/customizers/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'-customizer.php', $atts))
    wistiti_get_template('/partials/customizers/'.$atts['type'].'-'.$atts['display'].'-customizer.php', $atts);
?>

<?php if ( $element_query->have_posts() ) : while ( $element_query->have_posts() ) : $element_query->the_post();

    //Partial template search
    //1  = partials/type-taxonomy-display.php
    //2  = partials/type-display.php
    //3  = partials/type-classic.php (default display)
    if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'.php', $atts)) {
      if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['display'].'.php', $atts))
        wistiti_get_template('/partials/'.$atts['type'].'-default.php', $atts);
    }

endwhile; ?>

<?php
echo wistiti_post_navigation($template_args);
?>

<?php endif; wp_reset_query(); ?>
