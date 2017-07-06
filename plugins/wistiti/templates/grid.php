<?php //Links

      //Type of data
      if ((!isset($atts['type'])) || empty($atts['col']) ) return;

      //Query
      $grid_query = $atts['query'];

      //Layout
      if ((!isset($atts['col'])) || $atts['col']==0 ) $col=2;
      $width = floor(100 / $col);

      //Default skin
      //Do not add tachyons classes here ! User appropriate customizer !
      global $template_args;
      if (!wistiti_get_template('/customizers/'.$atts['type'].'-grid-customizer.php', $atts))
        wistiti_get_template('/customizers/grid-customizer.php', $atts)
?>

<div class="<?php echo $template_args['classes']['wrapper'];?>" role="<?php echo $template_args['classes']['role'];?>">

  <?php $index=0; if ( $grid_query->have_posts() ) : while ( $grid_query->have_posts() ) : $grid_query->the_post();

      if ($index % $col == 0) :
        if ($index>0) : ?></div><?php endif; ?>
        <div class="cf <?php if ($index>0): echo $template_args['classes']['row']; endif;?>">
      <?php endif; ?>

      <div class="fl w-100 w-<?php echo $width; ?>-ns" >

        <?php //Set atts for template

        $atts['index']=$index;

        if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['display'].'.php', $atts))
          wistiti_get_template('/partials/'.atts['type'].'-media.php', $atts);?>

      </div>

    <?php $index++; endwhile; endif;

    wp_reset_query(); ?>

</div>
