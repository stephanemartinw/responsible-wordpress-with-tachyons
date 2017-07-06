<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Customize
  global $partial_args;

?>

<div class="js-collapsible <?php echo $partial_args['classes']['wrapper'];?>">
    <div class="js-collapsible-toggle <?php echo $partial_args['classes']['tab'];?>" id="toggle<?php echo $index;?>" tabindex="<?php echo $index;?>" aria-controls="collapse<?php echo $index;?>">
      <h<?php echo $firstheadinghierarchy;?> class="<?php echo $partial_args['classes']['title'];?>"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
    </div>
    <div class="js-collasible-collapse <?php echo $partial_args['classes']['collapse'];?>" id="collapse<?php echo $index;?>" aria-labelledby="toggle<?php echo $index;?>">
      <?php the_content();?>
    </div>
</div>
