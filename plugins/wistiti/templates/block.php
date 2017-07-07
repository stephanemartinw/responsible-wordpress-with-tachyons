<?php //Block

  $block_query = $atts['query'];

?>

<?php $index=0; if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();

    if (!wistiti_get_template('/partials/block-'.$atts['display'].'.php', $atts))
      wistiti_get_template('/partials/block-card.php', $atts);

$index++; endwhile; endif;
wp_reset_query();
?>
