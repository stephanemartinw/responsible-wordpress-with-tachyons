<?php //Grid

      //https://www.w3.org/TR/wai-aria-practices/examples/grid/LayoutGrids.html

      //Query
      $grid_query = $atts['query'];

      //Default skin
      //Do not add tachyons classes here ! User appropriate customizer !
      global $template_args;
      wistiti_get_customizer($atts);
      //if (!wistiti_get_template('customizers/'.$atts['type'].'-grid-customizer.php', $atts))
      //  wistiti_get_template('customizers/grid-customizer.php', $atts);

      global $partial_args;
      wistiti_get_customizer($atts, true);
      //if (!wistiti_get_template('partials/customizers/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'-customizer.php', $atts))
      //  wistiti_get_template('partials/customizers/'.$atts['type'].'-'.$atts['display'].'-customizer.php', $atts);

      //Columns
      $cols = $template_args['options']['cols'];
      $widths = 'w-100';
      $widths .= ' w-'.floor(100/$cols['ns']).'-ns';
      $widths .= ' w-'.floor(100/$cols['m']).'-m';
      //For future use (js)
      $datas = 'data-cols-ns='.$cols['ns'];
      $datas .= ' data-cols-m='.$cols['m'];

      //Spacings
      $spacings = $template_args['options']['spacings'];
      $vertical_spacing = 'pa'.$template_args['options']['spacings']['s'].'-half';
      $vertical_spacing .= ' pa'.$template_args['options']['spacings']['ns'].'-half-ns';
      $vertical_spacing .= ' pa'.$template_args['options']['spacings']['m'].'-half-m';
      $template_args['classes']['cell'] .= ' '.$vertical_spacing;

      //Alternate media or card mode ?
      $atts['alternate'] = $template_args['options']['alternate'];
?>

<?php
  $aria_label = '';
  $aria_labelledby = '';
  if (isset($template_args['options']['display_title']) && $template_args['attributes']['display_title']) :
    $title_id = $atts['type'].'-'.uniqid();
  ?>
    <h<?php echo $atts['firstheadinghierarchy'];?> id="<?php echo $title_id;?>" class="<?php echo $template_args['title'];?>"><?php echo $atts['title'];?></h<?php echo $atts['firstheadinghierarchy'];?>>
  <?php
    $aria_labelledby = $title_id;
    //Increment next title level....
    $atts['firstheadinghierarchy']+=1;
  ?>
<?php else :
  $aria_label = $atts['title'];
endif; ?>

<div class="<?php echo $template_args['classes']['wrapper'];?>" role="grid" <?php echo $datas;?> aria-label="<?php echo $aria_label;?>" aria-labelledby="<?php echo $aria_labelledby;?>">

  <div class="<?php echo $template_args['classes']['row'];?>" role="row" aria-rowindex="<?php echo $row;?>">

  <?php $index=0; $row=0; if ( $grid_query->have_posts() ) : while ( $grid_query->have_posts() ) : $grid_query->the_post();

        $tabindex=($index==0)?'0':'-1';
        if ($atts['layout']=='grid') $role = "gridcell";
        else $role='';?>

      <div class="overflow-hidden <?php echo $template_args['classes']['cell'];?> <?php echo $widths; ?>"  role="<?php echo $role;?>" tabindex="<?php echo $tabindex;?>">

        <?php

        //Element index
        $atts['index']=$index;

        //Partial template search
        wistiti_get_partial($atts);
        ?>

      </div>

    <?php $index++; endwhile;?>

  </div>

  <?php if ($atts['pagination']) : ?>
    <nav class="<?php echo $template_args['post_navigation']['wrapper'];?>">
      <?php echo wistiti_previous_posts_link(__('Previous'), $template_args); ?>
      <?php echo wistiti_next_posts_link(__('Next'), $template_args); ?>
    </nav>
  <?php endif;?>

  <?php endif; wp_reset_query();

  unset($template_args);
  unset($partial_args);
  unset($atts);

  ?>

</div>
