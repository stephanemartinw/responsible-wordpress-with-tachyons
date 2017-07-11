<?php //Grid

      //https://www.w3.org/TR/wai-aria-practices/examples/grid/LayoutGrids.html

      //Query
      $grid_query = $atts['query'];

      //Layout
      $col = $atts['col'];
      if ( $grid_query->post_count<$col) $col=$grid_query->post_count;
      if ($col>0)
        $width = floor(100 / $col);
      else
        $width='100';

      //Default skin
      //Do not add tachyons classes here ! User appropriate customizer !
      global $template_args;
      if (!wistiti_get_template('/customizers/'.$atts['type'].'-grid-customizer.php', $atts))
        wistiti_get_template('/customizers/grid-customizer.php', $atts);

      global $partial_args;
      if (!wistiti_get_template('/partials/customizers/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'-customizer.php', $atts))
        wistiti_get_template('/partials/customizers/'.$atts['type'].'-'.$atts['display'].'-customizer.php', $atts);
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

<div class="<?php echo $template_args['classes']['wrapper'];?>" role="grid" aria-label="<?php echo $aria_label;?>" aria-labelledby="<?php echo $aria_labelledby;?>">

  <?php $index=0; $row=0; if ( $grid_query->have_posts() ) : while ( $grid_query->have_posts() ) : $grid_query->the_post();

      if ($index % $col == 0) :
        $row+=1;
        if ($index>0) : ?></div><?php endif; ?>
        <div class="cf <?php if ($index>0): echo $template_args['classes']['row']; endif;?>" role="row" aria-rowindex="<?php echo $row;?>">
      <?php endif; ?>

      <?php $tabindex=($index==0)?'0':'-1';
        if ($atts['layout']=='grid') $role = "gridcell";
        else $role='';?>

      <div class="fl w-100 w-<?php echo $width; ?>-ns" role="<?php echo $role;?>" tabindex="<?php echo $tabindex;?>">

        <?php

        //Element index
        $atts['index']=$index;

        //Alternate media or card thumb position ?
        $atts["media"]=$template_args['options']['media'];
        $atts["card"]=$template_args['options']['card'];

        if (($index % 2 !== 0) && ($template_args['options']['alternate'])) {
          if ($atts['media']=='left') $atts['media']="right"; else $atts['media']="left";
          if ($atts['card']=='top') $atts['card']="bottom"; else $atts['card']="top";
        }

        //Partial template search
        //1  = partials/type-taxonomy-display.php
        //2  = partials/type-display.php
        //3  = partials/type-media.php (default display)
        if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['tax_value'].'-'.$atts['display'].'.php', $atts)) {
          if (!wistiti_get_template('/partials/'.$atts['type'].'-'.$atts['display'].'.php', $atts))
            wistiti_get_template('/partials/'.$atts['type'].'-media.php', $atts);
        }?>

      </div>

    <?php $index++; endwhile; endif;

    wp_reset_query();

    unset($template_args);
    unset($partial_args);

    ?>

</div>
