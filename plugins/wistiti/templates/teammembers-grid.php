<?php //Team members

    //Query
    $teammembers_query = $atts['query'];

    //Layout
    if (isset($atts['col']) && $atts['col']!=0) {
      $width = 100 / $atts['col'];
      if ($atts['col']==1) $width_avatar = 25;
      else $width_avatar=50;
    }
    else {
      $width=33; //default
      $width_avatar=50;
    }

?>

<div class="cf">

<?php $index=1; if ( $teammembers_query->have_posts() ) : while ( $teammembers_query->have_posts() ) : $teammembers_query->the_post();?>

    <div class="fl w-100 w-<?php echo $width; ?>-ns">

      <?php //Set atts for template
      $atts['index']=$index;

      if (!wistiti_get_template('/partials/teammember-'.$atts['display'].'.php', $atts))
        wistiti_get_template('/partials/teammember-card.php', $atts);?>

    </div>

<?php $index++; endwhile; endif; wp_reset_query(); ?>

</div>
