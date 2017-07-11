<?php

  //Attributes
  $firstheadinghierarchy = $atts['firstheadinghierarchy'];
  $secondheadinghierachy = $firstheadinghierarchy+1;

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
  <p id="faq<?php echo $index;?>" class="<?php echo $partial_args['classes']['definition'];?>"><?php echo strip_tags(get_the_content());?></p>
</dd>
