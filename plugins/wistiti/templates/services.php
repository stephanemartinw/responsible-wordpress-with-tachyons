<div class="cf">

<?php //Services

  $args = array(
      'post_type' => 'service',
      'orderby'=> 'menu_order',
      'order' => 'ASC',
      'post_status' => 'publish'
    );

    $the_query = new WP_Query( $args );

  ?>

  <?php $index=0; if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();

    //Set atts for template
    $atts['index']=$index;
    $atts['total']=$inner_query->post_count;

    if (!wistiti_get_template('/partials/services-'.$atts['layout'].'.php', $atts))
      wistiti_get_template('/partials/services-medialist.php', $atts);

  $index++; endwhile; else : ?>

  <p>There are no services here.</p>

  <?php endif; ?>

  <?php wp_reset_query(); ?>
  
</div>
