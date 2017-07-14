<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

  //Content
  $theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
  $thecontent = wpautop(get_the_content());

  //Customize
  global $partial_args;

?>

<!--
From
https://www.w3.org/TR/wai-aria-practices/examples/disclosure/disclosure-faq.html
use :https://www.w3.org/TR/wai-aria-practices/examples/disclosure/js/disclosureButton.js
-->

<dt class="<?php echo $partial_args['classes']['wrapper_button'];?>">
  <button class="<?php echo $partial_args['classes']['button'];?>" aria-expanded="false" aria-controls="faq<?php echo $index;?>"><?php echo get_the_title();?></button>
</dt>
<dd class="<?php echo $partial_args['classes']['wrapper_definition'];?>">
  <div id="faq<?php echo $index;?>" class="<?php echo $partial_args['classes']['definition'];?>">
    <?php if (!empty($theexcerpt)):?><p class="<?php echo $partial_args['classes']['excerpt'];?>"><?php echo $theexcerpt;?></p><?php endif; ?>
    <?php echo $thecontent;?>
  </div>
</dd>
