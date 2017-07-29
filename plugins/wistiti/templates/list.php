<?php //List

    $list_type = 'u'; //unordered list by default
    if (!empty($atts['layout_variant']) )
      $list_type = $atts['layout_variant'];

    $list_query = $atts['query'];

    //Default skin
    //Do not add tachyons classes here ! User appropriate customizer !
    global $template_args;
    wistiti_get_customizer($atts);
    //if (!wistiti_get_template('customizers/'.$atts['type'].'-list-customizer.php', $atts))
    //  wistiti_get_template('customizers/list-customizer.php', $atts);

    global $partial_args;
    wistiti_get_customizer($atts, true);
    //if (!wistiti_get_template('partials/customizers/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'-customizer.php', $atts))
    //  wistiti_get_template('partials/customizers/'.$atts['type'].'-'.$atts['display'].'-customizer.php', $atts);

    //Alternate media or card mode ?
    $atts['alternate'] = $template_args['options']['alternate'];
?>

<<?php echo $list_type;?>l class="<?php echo $template_args['classes']['wrapper'];?>">

  <?php $index=0; if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();

      //Set atts for template
      $atts['index']=$index;

      //Partial template search
      wistiti_get_partial($atts);

  $index++; endwhile;?>

  <?php if ($atts['pagination']) : ?>
    <nav class="<?php echo $template_args['post_navigation']['wrapper'];?>">
      <?php echo wistiti_previous_posts_link(__('Previous'), $template_args); ?>
      <?php echo wistiti_next_posts_link(__('Next'), $template_args/*, $grid_query->max_num_pages*/); ?>
    </nav>
  <?php endif;?>

  <?php endif; wp_reset_query();

  unset($template_args);
  unset($partial_args);
  ?>

</<?php echo $list_type;?>l>
