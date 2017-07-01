<?php
  //Hierarchy
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Default skin
  //Override this template partial in your wistiti child theme to fit your needs
  $class_title = "js-tab-title db bg-custom-green white ma0 pa1 pointer";
?>

<div class="js-accordion pv2">
    <div class="<?php echo $class_title;?>" id="tab<?php echo $index;?>" tabindex="<?php echo $index;?>" aria-controls="panel<?php echo $index;?>" role="tab">
      <h<?php echo $firstheadinghierarchy;?> class="white"><?php the_title();?></h<?php echo $firstheadinghierarchy;?>>
    </div>
    <div class="js-tab-collapsing dn-js" id="panel<?php echo $index;?>" aria-labelledby="tab<?php echo $index;?>" role="tabpanel">
      <?php the_content();?>
    </div>
</div>
