<?php //Team members

  $args = array(
      'post_type' => 'teammember',
      'orderby'=> 'menu_order',
      'order' => 'ASC',
      'post_status' => 'publish'
    );

    $inner_query = new WP_Query( $args );
  ?>

  <?php $index=1; if ( $inner_query->have_posts() ) : while ( $inner_query->have_posts() ) : $inner_query->the_post();

      //Set atts for template
      $atts['index']=$index;
      $atts['total']=$inner_query->post_count;

      if (!wistiti_get_template('/partials/teammembers-'.$atts['layout'].'.php', $atts))
        wistiti_get_template('/partials/teammembers-cardsgrid.php', $atts);

  $index++; endwhile; else : ?>

  <p>There are no team members here.</p>

  <?php endif; ?>

  <?php wp_reset_query(); ?>
