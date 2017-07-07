<?php //Card

  $card_query = $atts['query'];

?>

<?php $index=0; if ( $card_query->have_posts() ) : while ( $card_query->have_posts() ) : $card_query->the_post();

    if (!wistiti_get_template('/partials/card-'.$atts['display'].'.php', $atts))
      wistiti_get_template('/partials/card-classic.php', $atts);

$index++; endwhile; endif;
wp_reset_query();
?>
