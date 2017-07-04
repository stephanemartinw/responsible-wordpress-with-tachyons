<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Default skin
  global $partial_args;
  wistiti_get_template('/partials/customizers/faq-accordion-customizer.php', $atts);

?>

<div class="js-accordion <?php echo $partial_args['classes']['wrapper'];?>">
    <div class="js-tab-title <?php echo $partial_args['classes']['tab'];?>" id="tab<?php echo $index;?>" tabindex="<?php echo $index;?>" aria-controls="panel<?php echo $index;?>" role="tab">
      <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
    </div>
    <div class="js-tab-collapsing <?php echo $partial_args['classes']['panel'];?>" id="panel<?php echo $index;?>" aria-labelledby="tab<?php echo $index;?>" role="tabpanel">
      <?php the_content();?>
    </div>
</div>
