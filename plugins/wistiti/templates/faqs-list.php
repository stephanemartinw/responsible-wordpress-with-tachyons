<?php
  //Query
  $faqs_query = $atts['query'];
?>

<div class="w-75 center tc" role="tablist" aria-live="polite">

  <?php $index=0; if ( $faqs_query->have_posts() ) : while ( $faqs_query->have_posts() ) : $faqs_query->the_post();?>

        <?php $atts['index']=$index;

        if (!wistiti_get_template('/partials/faq-'.$atts['display'].'.php', $atts))
          wistiti_get_template('/partials/faq-accordion.php', $atts);?>

  <?php $index++; endwhile; endif; ?>

  <?php wp_reset_query(); ?>

</div>
