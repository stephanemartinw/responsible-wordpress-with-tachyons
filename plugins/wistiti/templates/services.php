
<?php //Services
$args = array(
    'post_type' => 'service',
    'orderby'=> 'menu_order',
    'order' => 'ASC',
    'post_status' => 'publish'
  );

  $the_query = new WP_Query( $args );

?>

  <?php $index=0; if ( have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();?>

      <div class="cf pv3">

        <?php if ($index % 2 == 0): ?>
          <div class="fl w-100 w-50-ns tc pa2">
            <?php the_post_thumbnail( 'medium_large', ['class' => 'w-100 h-auto'] ); ?>
          </div>
        <?php endif;?>

        <div class="fl w-100 w-50-ns pa2">
          <h3 class="f2 f1-l lh-title"><?php the_title();?></h3>
          <?php the_content();?>
          <p class="custom-green fw6"><?php echo get_the_excerpt();?></p>
        </div>

        <?php if ($index % 2 !== 0): ?>
          <div class="fl w-100 w-50-ns tc pa2">
            <?php the_post_thumbnail( 'medium_large', ['class' => 'w-100 h-auto']); ?>
          </div>
        <?php endif;?>

      </div>

  <?php $index++; endwhile; else : ?>

  <p>There are no services here.</p>

  <?php endif; ?>
