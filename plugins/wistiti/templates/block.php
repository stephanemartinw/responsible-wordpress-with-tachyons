<?php //Block

  //Query the correct jumbotron
  $element_query = $atts['query'];

  //Default skin
  //Do not add tachyons classes here ! User appropriate customizer !
  global $template_args;
  wistiti_get_customizer($atts);
  //if (!wistiti_get_template('customizers/'.$atts['type'].'-element-customizer.php', $atts))
  //  wistiti_get_template('customizers/element-customizer.php', $atts);

  global $partial_args;
  wistiti_get_customizer($atts, true);
  //if (!wistiti_get_template('partials/customizers/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'-customizer.php', $atts))
  //  wistiti_get_template('partials/customizers/'.$atts['type'].'-'.$atts['display'].'-customizer.php', $atts);
?>

<?php if ( $element_query->have_posts() ) : while ( $element_query->have_posts() ) : $element_query->the_post();?>
  <div class="db-block">
    <?php //Partial template search
    wistiti_get_partial($atts);?>
  <div>
<?php endwhile; ?>

<?php if ($atts['pagination']) : wistiti_post_navigation($template_args);endif; ?>

<?php endif; wp_reset_query();

unset($template_args);
unset($partial_args);
unset($atts);?>
