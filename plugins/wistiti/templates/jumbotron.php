<?php

  $base_url = get_bloginfo('url');

  //Jumbotron id
  if (isset($atts['id'])) $id = $atts['id'];
  else $id='main'; //default

  //Background image ?
  if (isset($atts['background']))
    $atts['style']="background:url('".$base_url . $atts['background']. "')  no-repeat center ; background-size:cover";

  //Query the correct jumbotron
  $args = array(
      'post_type' => 'jumbotron',
      'name' => $id
    );

    $the_query = new WP_Query( $args );

  ?>

  <?php $index=0; if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

    if (!wistiti_get_template('/partials/jumbotron-'.$atts['id'].'.php', $atts))
      wistiti_get_template('/partials/jumbotron-main.php', $atts);

    $index++; endwhile; else : ?>

  <p>There are no jumbotron here.</p>

  <?php endif; ?>
