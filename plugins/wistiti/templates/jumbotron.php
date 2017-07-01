<?php //Jumbotron

  //Query the correct jumbotron
  $jumbotron_query = $atts['query'];

?>

<?php $index=0; if ( $jumbotron_query->have_posts() ) : while ( $jumbotron_query->have_posts() ) : $jumbotron_query->the_post();

    if (!wistiti_get_template('/partials/jumbotron-'.$atts['display'].'.php', $atts))
      wistiti_get_template('/partials/jumbotron-classic.php', $atts);

$index++; endwhile; endif; wp_reset_query(); ?>
