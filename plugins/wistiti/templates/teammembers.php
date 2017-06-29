<?php //Team members
  $args = array(
      'post_type' => 'teammember',
      'orderby'=> 'menu_order',
      'order' => 'ASC',
      'post_status' => 'publish'
    );

    $inner_query = new WP_Query( $args );
  ?>

  <?php $index=1; if ( $inner_query->have_posts() ) : while ( $inner_query->have_posts() ) : $inner_query->the_post();?>

  <?php if ($index==1): ?>
    <div class="w-50 center tc">
  <?php endif; ?>
      <?php the_post_thumbnail( 'medium_large', ['class' => 'w-33 h-auto br-100']); ?>
      <h4><?php the_title();?></h4>
      <h5><?php echo get_post_meta( get_the_ID(), '_teammember_function', true );?></h5>
      <?php the_content();?>
  </div>

  <?php $index++; endwhile; else : ?>

  <p>There are no team members here.</p>

  <?php endif; ?>

  <?php wp_reset_query(); ?>
