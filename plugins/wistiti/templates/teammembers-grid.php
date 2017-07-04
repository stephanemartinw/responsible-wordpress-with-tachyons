<?php //Team members

    //Query
    $teammembers_query = $atts['query'];

    //Default Layout
    global $grid_col_width;
    if (isset($atts['col']) && $atts['col']!=0)
      $grid_col_width = floor(100 / $atts['col']);
    else
      $grid_col_width=33; //default %
?>

<div class="cf">

<?php $index=1; if ( $teammembers_query->have_posts() ) : while ( $teammembers_query->have_posts() ) : $teammembers_query->the_post();?>

    <div class="fl w-100 w-<?php echo $grid_col_width; ?>-ns">

      <?php //Set atts for template
      $atts['index']=$index;

      if (!wistiti_get_template('/partials/teammember-'.$atts['display'].'.php', $atts))
        wistiti_get_template('/partials/teammember-card.php', $atts);?>

    </div>

<?php $index++; endwhile; endif; wp_reset_query(); ?>

</div>
