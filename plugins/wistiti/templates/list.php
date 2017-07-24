<?php //List

    $list_type = 'u'; //unordered list by default
    if (!empty($atts['layout_variant']) )
      $list_type = $atts['layout_variant'];

    $list_query = $atts['query'];

    //Default skin
    //Do not add tachyons classes here ! User appropriate customizer !
    global $template_args;
    if (!wistiti_get_template('/customizers/'.$atts['type'].'-list-customizer.php', $atts))
      wistiti_get_template('/customizers/list-customizer.php', $atts);

    global $partial_args;
    if (!wistiti_get_template('/partials/customizers/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'-customizer.php', $atts))
      wistiti_get_template('/partials/customizers/'.$atts['type'].'-'.$atts['display'].'-customizer.php', $atts);

    //Alternate media or card mode ?
    $atts['alternate'] = $template_args['options']['alternate'];
?>

<<?php echo $list_type;?>l class="<?php echo $template_args['classes']['wrapper'];?>">

  <?php $index=0; if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();

      //Set atts for template
      $atts['index']=$index;

        //Partial template search
        //1  = partials/type-taxonomy-display.php
        //2  = partials/type-display.php
        //3  = partials/type-classic.php (default display)
        if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'.php', $atts)) {
          if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['display'].'.php', $atts))
            wistiti_get_template('/partials/'.$atts['type'].'-media.php', $atts);
        }

  $index++; endwhile;?>

  <?php if ($atts['pagination']) : ?>
    <nav class="js-posts-navigation <?php echo $template_args['post_navigation']['wrapper'];?>">
      <?php echo wistiti_get_previous_posts_link(__('Previous'), array('classes' => $template_args['classes']['pagination_prev_link'])); ?>
      <?php echo wistiti_get_next_posts_link(__('Next'), $grid_query->max_num_pages, array('classes' => $template_args['classes']['pagination_next_link'])); ?>
    </nav>
    <?php echo "<script>
    var navwrapper= document.querySelector('.js-posts-navigation');
    if (navwrapper!=null) {
      navwrapper.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['wrapper']).");
      var prev_link = navwrapper.querySelector('.js-posts-navigation-previous');
      if (prev_link!=null) prev_link.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['previous_link']).");
      var next_link = navwrapper.querySelector('.js-posts-navigation-next');
      if (next_link!=null) next_link.classList.add(".wistiti_split_string_instrings($template_args['post_navigation']['next_link']).");
    }
    </script>";
    ?>
  <?php endif;?>

  <?php endif; wp_reset_query();

  unset($template_args);
  unset($partial_args);
  ?>

</<?php echo $list_type;?>l>
