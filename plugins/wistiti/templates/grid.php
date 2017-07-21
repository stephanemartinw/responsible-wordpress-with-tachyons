<?php //Grid

      //https://www.w3.org/TR/wai-aria-practices/examples/grid/LayoutGrids.html

      //Query
      $grid_query = $atts['query'];

      //Default skin
      //Do not add tachyons classes here ! User appropriate customizer !
      global $template_args;
      if (!wistiti_get_template('/customizers/'.$atts['type'].'-grid-customizer.php', $atts))
        wistiti_get_template('/customizers/grid-customizer.php', $atts);

      global $partial_args;
      if (!wistiti_get_template('/partials/customizers/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'-customizer.php', $atts))
        wistiti_get_template('/partials/customizers/'.$atts['type'].'-'.$atts['display'].'-customizer.php', $atts);

      //Columns
      if ((isset($template_args['options']['cols']) && !empty($template_args['options']['cols'])))
        $cols = $template_args['options']['cols'];
        if (!isset ($cols['ns']) || empty($cols['ns'])) $cols['ns']=3;
        if (!isset ($cols['m']) || empty($cols['m'])) $cols['m']=2;
      else
        $cols = array('ns' => 3, 'm' => 2); //default

        if ((isset($template_args['options']['spacings']) && !empty($template_args['options']['spacings'])))
          $spacings = $template_args['options']['spacings'];
          if (!isset ($spacings['ns']) || empty($spacings['ns'])) $spacings['ns']=4;
          if (!isset ($spacings['m']) || empty($spacings['m'])) $spacings['m']=4;
        else
          $spacings = array('ns' => 4, 'm' => 4); //default for now (test)

      $widths = 'w-100';
      $widths .= ' w-'.floor(100/$cols['ns']).'-ns';
      $widths .= ' w-'.floor(100/$cols['m']).'-m';

      $vertical_spacing = 'pa'.$template_args['options']['spacings']['s'].'-half';
      $vertical_spacing .= ' pa'.$template_args['options']['spacings']['ns'].'-half-ns';
      $vertical_spacing .= ' pa'.$template_args['options']['spacings']['m'].'-half-m';
      $template_args['classes']['cell'] .= ' '.$vertical_spacing;

      $datas = 'data-cols-ns='.$cols['ns'];
      $datas .= ' data-cols-m='.$cols['m'];

      //Alternate media or card mode ?
      $atts['alternate'] = 'no';
      if  (isset($template_args['options']['alternate'])) {
        $atts['alternate'] = ($template_args['options']['alternate']=='yes')?true:false;
      }
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
        //1  = partials/type-taxonomy-display.php
        //2  = partials/type-display.php
        //3  = partials/type-media.php (default display)
        if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'.php', $atts)) {
          if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['display'].'.php', $atts))
            wistiti_get_template('/partials/'.$atts['type'].'-media.php', $atts);
        }?>

      </div>

    <?php $index++; endwhile;?>

  </div>

  <?php if ($atts['pagination']) : ?>
    <nav class="<?php echo $template_args['classes']['pagination'];?>">
      <?php echo wistiti_get_previous_posts_link(__('Previous'), array('classes' => $template_args['classes']['pagination_prev_link'])); ?>
      <?php echo wistiti_get_next_posts_link(__('Next'), $grid_query->max_num_pages, array('classes' => $template_args['classes']['pagination_next_link'])); ?>
    </nav>
  <?php endif;?>

  <?php endif; wp_reset_query();

  unset($template_args);
  unset($partial_args);
  unset($atts);

  ?>

</div>
