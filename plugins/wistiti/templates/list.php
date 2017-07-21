<?php //List

    $list_type = 'u'; //unordered list by default
    if (isset($atts['list']['type']) && !empty($atts['list']['type']) )
      $list_type = $atts['list']['type'];

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
    $atts['alternate'] = 'no';
    if  (isset($template_args['options']['alternate'])) {
      $atts['alternate'] = ($template_args['options']['alternate']=='yes')?true:false;
    }
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
    <nav class="<?php echo $template_args['classes']['pagination'];?>">
      <?php echo wistiti_get_previous_posts_link(__('Previous'), array('classes' => $template_args['classes']['pagination_prev_link'])); ?>
      <?php echo wistiti_get_next_posts_link(__('Next'), $grid_query->max_num_pages, array('classes' => $template_args['classes']['pagination_next_link'])); ?>
    </nav>
  <?php endif;?>

  <?php endif; wp_reset_query();

  unset($template_args);
  unset($partial_args);
  ?>

</<?php echo $list_type;?>l>
