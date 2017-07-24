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

echo "<script>
  var navwrapper= document.querySelector('.post-navigation');
  if (navwrapper!=null) {
    navwrapper.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['wrapper']).");
  }
  var navlinks= document.querySelector('.post-navigation .js-nav-links');
  if (navlinks!=null) {
    navlinks.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['links']).");
  }
  var navprevious = document.querySelector('.post-navigation .nav-previous');
  if (navprevious!=null) {
    navprevious.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['wrapper_previous']).");
    var prev_link = navprevious.querySelector('a');
    if (prev_link!=null) prev_link.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['previous_link']).");
  }
  var navnext = document.querySelector('.post-navigation .nav-next');
  if (navnext!=null) {
    navnext.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['wrapper_next']).");
    var next_link = navnext.querySelector('a');
    if (next_link!=null) next_link.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['next_link']).");
  }
</script>";
?>

<?php endif; wp_reset_query(); ?>
