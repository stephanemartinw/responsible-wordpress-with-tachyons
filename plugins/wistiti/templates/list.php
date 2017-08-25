<?php //List

    $list_type = 'u'; //unordered list by default
    $list_item_tag='li'; //by default;
    if (!empty($atts['layout_variant']) )
      $list_type = $atts['layout_variant'];
    //List item the_posts_navigation
    switch ($list_type) {
      case 'd':
      $list_item_tag='';
      break;

      default:
        $list_item_tag='li';
        break;
    }

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

    //Options
    if (isset($template_args['options']['alternate']) && $template_args['options']['alternate']===true) {
      $atts['alternate'] = true;
    }

    //Spacings
    if (isset($template_args['options']['spacings']) && !empty($template_args['options']['spacings'])) {
      $spacings = $template_args['options']['spacings'];
      foreach ($spacings as $key => $spacing) {
        if ($key==='default') $key ='';
        else $key = '-'.$key;
        $vertical_spacing .= ' pb'.$spacing.$key;
      }
      $template_args['classes']['item'] .= ' '.$vertical_spacing;
    }
?>

<<?php echo $list_type;?>l class="db-list <?php echo $template_args['classes']['wrapper'];?>">

  <?php $index=0; if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();

      $tabindex=($index==0)?'0':'-1';
      //to do ???
      $role='';
      ?>

      <?php if (!empty($list_item_tag)):?>
      <<?php echo $list_item_tag; ?> class="overflow-hidden <?php echo $template_args['classes']['item'];?>"  role="<?php echo $role;?>" tabindex="<?php echo $tabindex;?>">
      <?php endif;

        //Set atts for template
        $atts['index']=$index;

        //Partial temp‡late search
        wistiti_get_partial($atts);

      if (!empty($list_item_tag)):?>
      </<?php echo $list_item_tag; ?>>
      <?php endif;?>

  <?php $index++; endwhile;?>

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
