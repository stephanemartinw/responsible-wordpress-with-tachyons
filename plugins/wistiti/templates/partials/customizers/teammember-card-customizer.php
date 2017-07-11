<?php
//Override this template partial in your wistiti child theme to fit your needs
if (isset($atts['col']) && $atts['col']!=0) {
  if ($atts['col']==1) $width_avatar = 25;
  else $width_avatar=50;
}
else {
  $width_avatar=50;
}

global $partial_args;
$partial_args = array(
    'classes' => array(
    'wrapper' => 'ph4 pb4 tc',
    'thumbnail' => 'w-'.$width_avatar.' h-auto br-100'
  ));
?>
