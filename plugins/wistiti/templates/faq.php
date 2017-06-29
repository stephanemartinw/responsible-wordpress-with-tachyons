<?php

$args = array(
    'post_type' => 'faq',
    'orderby'=> 'menu_order',
    'order' => 'ASC',
    'post_status' => 'publish'
  );

  $inner_query = new WP_Query( $args );

?>

<section class="smw8 center" role="tablist" aria-live="polite">

  <?php $index=0; if ( $inner_query->have_posts() ) : while ( $inner_query->have_posts() ) : $inner_query->the_post();?>
    <div class="w-75 center tc">
      <article class="js-accordion pv2">
          <div class="js-tab-title db bg-custom-green white ma0 pa1 pointer" id="tab<?php echo $index;?>" tabindex="<?php echo $index;?>" aria-controls="panel<?php echo $index;?>" role="tab">
            <h3 class="white"><?php the_title();?></h3>
          </div>
          <div class="js-tab-collapsing dn-js" id="panel<?php echo $index;?>" aria-labelledby="tab<?php echo $index;?>" role="tabpanel">
            <?php the_content();?>
          </div>
      </article>
    </div>
    <?php $index++; endwhile; else : ?>

    <p>There are no faqs here.</p>

    <?php endif; ?>

</section>
