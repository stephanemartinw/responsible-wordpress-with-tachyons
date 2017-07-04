<?php
//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
  'classes' => array(
    'wrapper' => 'ph4 pb4 tc',
    'thumbnail' => 'w-100 h-auto',
    'title' => 'f1 f2-l lh-title',
    'excerpt' => 'fw6',
    'label' => 'db',
    'label_link' => 'link underline '.get_theme_mod( 'smew_colors_brand', 'blue' ),
    'source' => '',
    'source_link' => 'link underline '.get_theme_mod( 'smew_colors_brand', 'blue' )
  )
);
?>
